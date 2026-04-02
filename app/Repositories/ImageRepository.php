<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Image;

use App\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function storeImage(User $user, $path): void
    {
        $user->image()->create(['url' => $path]);
        
    }
}