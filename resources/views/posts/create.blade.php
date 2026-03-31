@extends('layouts.app')
@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">

        <h1 class="text-2xl font-bold text-blue-900 mb-6 text-center">Create Post</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <input 
                    type="text" 
                    name="title" 
                    placeholder="Title"
                    value="{{ old('title') }}" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <textarea 
                    name="content" 
                    placeholder="Body" 
                    value="{{ old('content') }}"
                    required
                    rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                ></textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input 
                    type="file" 
                    name="images[]" 
                    multiple
                    accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-blue-600 file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-white hover:file:text-blue-600 file:transition file:duration-200 cursor-pointer"
                >
                @error('images')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button 
                type="submit"
                class="w-full bg-blue-600 hover:bg-white hover:text-blue-600 border border-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200"
            >
                Create Post
            </button>

        </form>

        <p class="text-center text-sm text-gray-500 mt-4">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline font-medium">
                ← Back to Posts
            </a>
        </p>

    </div>
</div>

@endsection