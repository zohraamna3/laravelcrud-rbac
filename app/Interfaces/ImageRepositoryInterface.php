<?php

namespace App\Interfaces;

use App\Models\User;

interface ImageRepositoryInterface
{
    public function storeImage(User $user, $path): void;

    // public function storeImageForPost($request, $post);
    // public function UpdateImageForPost($request, $post);
}