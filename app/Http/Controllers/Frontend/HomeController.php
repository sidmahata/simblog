<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')
            ->latest()
            ->paginate(10);

        return view('frontend.home', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['author', 'comments.author']);

        return view('frontend.post-show', compact('post'));
    }
}
