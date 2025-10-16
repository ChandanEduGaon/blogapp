<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        $data = [];
        if ($user) {
            $post_count = Posts::where('user_id', $user->id)->count();
            $deleted_post_count = Posts::where('user_id', $user->id)->onlyTrashed()->count();
            $data['posts'] = $post_count;
            $data['deleted_posts'] = $deleted_post_count;
        }


        return view('user.pages.home', $data);
    }
}
