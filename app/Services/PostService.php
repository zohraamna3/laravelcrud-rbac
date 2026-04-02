<?php

namespace App\Services;

use App\Models\Post;

use App\Interfaces\PostRepositoryInteface;

use App\Http\Requests\PostValidateRequest;
use App\Http\Requests\PostUpdateRequest;

use App\Services\ImageService;

class PostService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function createPost($data, PostValidateRequest $request)
    {
        $post = auth()->user()->posts()->create($data);

        $this->imageService->storeImageForPost($request, $post);

        return $post;
    }

    public function updatePost(Post $post, $data, PostUpdateRequest $request)
    {
        $post->update($data);

        $this->imageService->UpdateImageForPost($request, $post);

        return $post;
    }

    Public function showPost(Post $post)
    {
        $post = Post::findOrFail($post->id);
        return $post;
    }

    public function updateImageOnly($request, $postId)
    {
        $post = Post::findOrFail($postId);
        $this->imageService->UpdateImageForPost($request, $post);
        
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return true;
    }

}