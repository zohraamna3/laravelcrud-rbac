@extends('layouts.app')
@section('content')

<div class="min-h-screen bg-gray-100 py-8 px-4">
    <div class="max-w-4xl mx-auto">

        {{-- Profile Section --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h1 class="text-[42px] font-bold text-blue-900 mb-4">Welcome, {{ $user->name }}</h1>
            <div class="flex flex-row items-center gap-6">
                <div>
                    @if($user->image)
                        <img src="{{ asset('storage/'.$user->image->url) }}" 
                             width="150" height="150" 
                             alt="Profile Image"
                             class="rounded-full border-4 border-blue-500 object-cover shadow-md">
                    @endif
                </div>
                <div class="text-gray-700 space-y-1">
                    <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                    <p><span class="font-semibold">Role:</span> 
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm">{{ $role }}</span>
                    </p>
                </div>
            </div>
        </div>

        <hr class="mb-6 border-gray-300">
        

        {{-- Posts Header --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-[36px] font-bold text-gray-800">All Posts</h2>
            @if($role !== 'Viewer')
                <a href="{{ route('posts.create') }}" 
                   class="bg-blue-600 hover:bg-white hover:text-blue-600 border border-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    + Create New Post
                </a>
            @endif
        </div>
        <livewire:post-search />

        {{-- Posts List --}}
        @foreach($posts as $post)
            <div class="bg-white rounded-2xl shadow-md p-6 mb-4">

                <h3 class="text-lg font-bold text-blue-900 mb-1"><a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">{{ $post->title }}</a></h3>
                <p class="text-gray-600 mb-2">{{ $post->content }}</p>
                <p class="text-sm text-gray-400 mb-4">By: <span class="font-medium text-gray-600">{{ $post->user->name }}</span></p>

                {{-- Images --}}
                <h4 class="font-semibold text-gray-700 mb-2">Images:</h4>
                @if($post->images->count())
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($post->images as $image)
                            <img src="{{ asset('storage/'.$image->url) }}" 
                                 width="120"
                                 class="rounded-lg border border-gray-200 shadow-sm object-cover">
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-400 mb-4">No Image</p>
                @endif

                {{-- Admin/Editor Actions --}}
                @if($role === 'Admin' || $role === 'Editor')
                    <div class="flex gap-2 mb-4">
                        <a href="{{ route('posts.edit', $post) }}" 
                           class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-4 rounded-lg transition duration-200">
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded-lg transition duration-200">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Comments --}}
                <h4 class="font-semibold text-gray-700 mb-2">Comments:</h4>
                @foreach($post->comments as $comment)
                    <p class="text-sm text-gray-600 bg-gray-50 rounded-lg px-3 py-2 mb-1">{{ $comment->comment }}</p>
                @endforeach

                {{-- Viewer Comment Form --}}
                @if($role == 'Viewer')
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
                        @csrf
                        <textarea 
                            name="comment" 
                            placeholder="Add a comment..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                            rows="2"
                        ></textarea>
                        <button type="submit"
                                class="mt-2 bg-blue-600 hover:bg-white hover:text-blue-600 border border-blue-600 text-white font-semibold py-1 px-4 rounded-lg transition duration-200">
                            Comment
                        </button>
                    </form>
                @endif

            </div>
        @endforeach

    </div>
</div>

@endsection