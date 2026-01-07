<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        $comments = $post->comments()->with('author')->latest()->paginate(10);
        return view('admin.comments.index', compact('post', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        $users = User::all();
        return view('admin.comments.create', compact('post','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user_id,
        ]);

        return back()->with('status', 'Comment added successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment->update($request->only('content','user_id'));

        return back()->with('status', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('status', 'Comment deleted successfully');
    }
}
