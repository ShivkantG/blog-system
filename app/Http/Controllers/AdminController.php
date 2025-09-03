<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {

        $users = User::where('is_admin', false)->get();

        return view('admin.users', compact('users'));
    }
    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function toggleUser(User $user)
    {
        //dd($user->is_blocked);
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return back()->with('success', 'User status updated.');
    }
    public function posts()
    {
        $posts = Post::with(['user', 'reactions'])->latest()->get();
        return view('admin.posts', compact('posts'));
    }


    public function destroyPost(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }

    public function editPost(Post $post)
    {
        return view('admin.edit-post', compact('post'));
    }

    public function updatePost(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->image = $path;
            $post->save();
        }

        return redirect()->route('admin.posts')->with('success', 'Post updated successfully.');
    }

}
