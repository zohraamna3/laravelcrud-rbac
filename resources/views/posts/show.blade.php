@extends('layouts.app')
@section('content')

<div class="min-h-screen bg-gray-100 py-8 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold text-blue-900 mb-2">{{ $post->title }}</h1>
        <p class="text-gray-600 mb-1">{{ $post->content }}</p>
        <p class="text-sm text-gray-400 mb-4">By: <span class="font-medium text-gray-600">{{ $post->user->name }}</span></p>

        <h3 class="font-semibold text-gray-700 mb-2">Images</h3>
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($post->images as $image)
                <img src="{{ asset('storage/'.$image->url) }}" width="200"
                    class="rounded-lg border border-gray-200 shadow-sm object-cover">
            @endforeach
        </div>

        @if(auth()->user()->role->name !== 'Viewer')
            <form action="{{ route('images.store', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-2 mb-6">
                @csrf
                <input type="file" name="images[]" multiple required
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-blue-600 file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-white hover:file:text-blue-600 file:transition file:duration-200 cursor-pointer">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-white hover:text-blue-600 border border-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    Upload Image
                </button>
            </form>
        @endif

        <h3 class="font-semibold text-gray-700 mb-2">Comments</h3>
        @foreach($post->comments as $comment)
            <p class="text-sm text-gray-600 bg-gray-50 rounded-lg px-3 py-2 mb-1">{{ $comment->comment }}</p>
        @endforeach

        @if(auth()->user()->role->name == 'Viewer')
            <form action="{{ route('comments.store', $post) }}" method="POST" class="space-y-2 mt-4">
                @csrf
                <textarea name="body" placeholder="Add a comment"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" rows="3"></textarea>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-white hover:text-blue-600 border border-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    Comment
                </button>
            </form>
        @endif

        <a href="{{ route('dashboard') }}" class="block text-center text-blue-600 hover:underline font-medium mt-6">← Back to Posts</a>

    </div>
</div>

@endsection