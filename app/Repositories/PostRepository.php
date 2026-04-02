<?php

namespace App\Repositories;

use App\Models\Post;

use App\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function createPost($data): Post
    {
        return auth()->user()->posts()->create($data);
    }
}