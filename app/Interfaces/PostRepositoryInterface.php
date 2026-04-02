<?php

namespace App\Interfaces;

use App\Models\Post;

Interface PostRepositoryInteface
{
    public function createPost($data): Post;

}