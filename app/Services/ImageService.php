<?php

namespace App\Services;

use App\Models\User;
use App\Models\Image;
use App\Models\Post;

use App\Http\Requests\RegistrationFormRequest;
use App\Http\Requests\PostValidateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\ImageValidateRequest;


class ImageService
{
    public function storeImage(RegistrationFormRequest $request, User $user)
    {
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image()->create(['url' => $path]);
            return;
        } 
    }

    public function storeImageForPost(PostValidateRequest $request, Post $post)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $post->images()->create([
                    'url' => $path
                ]);
            }
        }
    }

    public function UpdateImageForPost($request, Post $post)
    {
        if ($request->hasFile('images')) {
            $post->images()->delete();
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $post->images()->create([
                    'url' => $path
                ]);
            }
        }
    }
    


    
}