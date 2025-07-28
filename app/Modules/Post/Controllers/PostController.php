<?php

namespace App\Modules\Post\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Post\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('Post::index', compact('posts'));
    }

    public function create()
    {
        return view('Post::create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'content' => 'required']);
        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post Created');
    }

    public function edit(Post $post)
    {
        return view('Post::edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate(['title' => 'required', 'content' => 'required']);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post Updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post Deleted');
    }
}
