<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostCacheService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(PostCacheService $cache)
    {

        $posts = $cache->posts();

        return view('frontend.home', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['author', 'comments.author']);

        return view('frontend.post-show', compact('post'));
    }
}
