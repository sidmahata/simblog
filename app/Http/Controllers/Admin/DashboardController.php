<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'usersCount'    => User::count(),
            'postsCount'    => Post::count(),        // excludes soft deleted
            'commentsCount' => Comment::count(),     // excludes soft deleted
        ]);
    }
}
