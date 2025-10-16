<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    // Show user details for AJAX
    public function show(User $user)
    {
        $user->load('posts'); // load all posts
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'avatar' => $user->avatar,
            'created_at' => $user->created_at->format('d M Y'),
            'posts' => $user->posts->map(function ($post) {
                return ['id' => $post->id, 'title' => $post->title, 'created_at' => $post->created_at->format('d M Y')];
            }),
        ]);
    }

    // Edit user info (AJAX)
    public function edit(User $user)
    {
        return response()->json($user);
    }

    // Update user info
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,user',
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return response()->json(['message' => 'User updated successfully']);
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
