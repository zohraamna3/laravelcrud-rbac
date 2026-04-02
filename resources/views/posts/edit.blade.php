@extends('layouts.app')
@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">

        <h1 class="text-2xl font-bold text-blue-900 mb-6 text-center">Edit Post</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{ $post->title }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <br><br>
            @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <textarea name="content" placeholder="{{$post->content}}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" rows="5">{{ $post->content }}</textarea>
            <br><br>
            @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <h4 class="font-semibold text-gray-700">Current Images:</h4>
            @foreach($post->images as $image)
                <img src="{{ asset('storage/'.$image->url) }}" width="100"
                    class="rounded-lg border border-gray-200 shadow-sm object-cover">
            @endforeach

            <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-blue-600 file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-white hover:file:text-blue-600 file:transition file:duration-200 cursor-pointer">
            @foreach ($errors->get('images.*') as $messages)
                @foreach ($messages as $message)
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @endforeach
            @endforeach
            <br><br>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-white hover:text-blue-600 border border-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                Update
            </button>
        </form>

        <a href="{{ route('dashboard') }}" class="block text-center text-blue-600 hover:underline font-medium mt-4">Back to Posts</a>

    </div>
</div>

@endsection