<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;

use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PostValidateRequest;


use App\Services\PostService;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostValidateRequest $request)
    {
        $data = $request->validated();

        $post = $this->postService->createPost($data, $request);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $this->postService->showPost($post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $this->postService->updatePost($post, $data, $request);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->postService->deletePost($id)) {
            return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
        }
        
    }
}
