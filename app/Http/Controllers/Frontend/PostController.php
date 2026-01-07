<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('frontend.posts.create');
    }

    public function store(Request $request)
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

        return redirect()->route('home')->with('status', 'Post published!');
    }
}
