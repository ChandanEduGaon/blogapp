<?php

namespace App\Http\Controllers;

use App\Models\PostComments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $users = User::count();
        $posts = Posts::count();
        $comments = PostComments::count();

        $data = [];
        if ($users > 0) {
            $data['users'] = $users;
        }
        if ($posts > 0) {
            $data['posts'] = $posts;
        }
        if ($comments > 0) {
            $data['comments'] = $comments;
        }

        return view('admin.pages.home', $data);
    }
    public function users()
    {
        $users = User::withCount('posts')->get();
        $data = [];
        if ($users) {
            $data['users'] = $users;
        }

        return view('admin.pages.users', $data);
    }
    public function posts()
    {
        $posts = Posts::with('user:id,name')->withCount('post_comments')->get();

        $data = [];
        if ($posts) {
            $data['posts'] = $posts;
        }
        return view('admin.pages.posts', $data);
    }


    public function show(Posts $post)
    {
        

        return response()->json($post->load(['user:id,name,avatar', 'post_comments.user:id,name,avatar']));
    }

    public function edit(Posts $post)
    {
        return response()->json($post);
    }

    public function update(Request $request, Posts $post)
    {
        $post->update($request->only('title', 'content'));
        return response()->json(['message' => 'Post updated successfully']);
    }

    public function destroy(Posts $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
