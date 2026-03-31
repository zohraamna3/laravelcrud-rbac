<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;

use App\Http\Requests\PostUpdateRequest;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('comments', 'images')->get();
        return view('posts.index', compact('posts'));
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'content' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post = auth()->user()->posts()->create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $post->images()->create([
                    'url' => $path
                ]);
            }
        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::findOrFail($post->id);
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
        $post->update($data);
        if($request->hasFile('images')){
            foreach($request->file('images') as $file){
                $path = $file->store('images', 'public');
                $post->images()->create([
                    'url' => $path
                ]);

            }
        }

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('dashboard');
    }
}
