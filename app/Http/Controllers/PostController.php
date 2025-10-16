<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\PostComments;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class PostController extends Controller
{
    //
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $post = Posts::create([
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);

        session()->flash('success', 'Post created successfully!');

        $eventData = [
            "title" => $request->title,
            "user" => Auth::user()->name
        ];

        event(new PostCreated($eventData));


        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'post'    => $post
        ]);
    }


    public function list()
    {
        $cacheKey = 'posts_with_users';
        $ttl = 600; // seconds (10 minutes)

        // $posts = Cache::remember($cacheKey, $ttl, function () {
        //     return Posts::with('user:id,name')->latest()->get();
        // });
        $posts = Posts::with('user:id,name')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Posts fetched successfully',
            'data' => $posts
        ]);
    }


    public function detail(Request $request)
    {
        $post_id = $request->query('post_id');
        $post = Posts::with(['user:id,name,avatar', 'post_comments' => function ($query) {
            $query->with('user:id,name,avatar')->latest();
        }])->find($post_id);

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post fetched successfully',
                'data'    => $post
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post not found',
                'data'    => []
            ]);
        }
    }
    public function delete(Request $request)
    {
        $post_id = $request->query('post_id');

        $post = Posts::find($post_id);

        if ($post->user_id !== Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can`t delete post',
            ], 404);
        }

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found',
            ], 404);
        }

        // $post->post_comments()->delete();

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
            'data'    => []
        ]);
    }
    public function delete_comment(Request $request)
    {
        $comment_id = $request->query('comment_id');

        $comment = PostComments::find($comment_id);

        if ($comment->user_id !== Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can`t delete comment',
            ], 404);
        }

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully',
            'data' => ['post_id' => $comment->post_id]
        ]);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id'   => 'required',
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $post = Posts::find($request->post_id);

        if ($post->user_id !== Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can`t update post',
            ], 404);
        }

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data'    => []
        ]);
    }
    public function create_comment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $comment = PostComments::create([
            "comment" => $request->comment,
            "post_id" => $request->post_id,
            "user_id" => Auth::user()->id,
        ]);

        if ($comment) {
            return response()->json([
                'success' => true,
                'message' => 'Commented successfully',
                'data'    => ['post_id' => $comment->post_id]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed',
                'data'    => []
            ]);
        }
    }
}
