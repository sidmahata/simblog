<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostCacheService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function create()
    {
        return view('frontend.posts.create');
    }

    public function store(Request $request, PostCacheService $cache)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(), // author
        ]);

        $cache->clearPostList();

        return redirect()->route('home')->with('status', 'Post published!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('frontend.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $post)->with('status', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('home')->with('status', 'Post deleted successfully!');
    }
}
