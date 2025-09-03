<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::with(['user', 'reactions'])->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Show single post by slug
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['user', 'reactions'])->firstOrFail();
        return view('posts.show', compact('post'));
    }

    // Store post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        //dd($request);
        // $post->save(); 
        $slug = Str::slug($request->title) . '-' . time();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Edit post (only own)
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }

    // Update post (only own)
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete post (only own)
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }


    public function like($id)
    {
        $post = Post::findOrFail($id);

        // Prevent liking own post
        if ($post->user_id == auth()->id()) {
            return response()->json(['error' => 'You cannot like your own post'], 403);
        }

        // Remove old reaction if exists
        $post->reactions()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['reaction' => 1]
        );

        return response()->json([
            'likes' => $post->reactions()->where('reaction', 1)->count(),
            'dislikes' => $post->reactions()->where('reaction', -1)->count()
        ]);
    }

    public function dislike($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id == auth()->id()) {
            return response()->json(['error' => 'You cannot dislike your own post'], 403);
        }

        $post->reactions()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['reaction' => -1]
        );

        return response()->json([
            'likes' => $post->reactions()->where('reaction', 1)->count(),
            'dislikes' => $post->reactions()->where('reaction', -1)->count()
        ]);
    }


}
