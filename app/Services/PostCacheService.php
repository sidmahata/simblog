<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostCacheService
{
    public function posts(int $perPage = 10)
    {
        return Cache::remember(
            "posts.page." . request('page', 1),
            now()->addMinutes(10),
            fn () => Post::with('author')->latest()->paginate($perPage)
        );
    }

    public function post(Post $post)
    {
        return Cache::remember(
            "post.{$post->id}",
            now()->addMinutes(30),
            fn () => $post->load('author')
        );
    }

    public function comments(Post $post)
    {
        return Cache::remember(
            "post.{$post->id}.comments",
            now()->addMinutes(30),
            fn () => $post->comments()->latest()->get()
        );
    }

    public function clearPost(Post $post): void
    {
        Cache::forget("post.{$post->id}");
        Cache::forget("post.{$post->id}.comments");
    }

    public function clearPostList(): void
    {
        Cache::flush(); // or use tags (recommended below)
    }
}
