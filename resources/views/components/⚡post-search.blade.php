<?php

use Livewire\Component;
use App\Models\Post;

new class extends Component
{
    public $search = '';

    public function getPostsProperty()
    {
        if (!$this->search) {
            return [];
        }

        $posts = Post::all();

        return $posts->filter(function ($post) {
            $title = strtolower($post->title);
            $search = strtolower($this->search);

            if (str_contains($title, $search)) {
                return true;
            }

            similar_text($title, $search, $percent);
            return $percent > 40;
        });
    }
};
?>

<div class="relative space-y-4">

    <input 
        type="text"
        wire:model.live.debounce.400ms="search"
        placeholder="Search posts by title"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
    >

    {{-- Dropdown --}}
    @if($search)
        <div class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1">
            @forelse($this->posts as $post)
                <a href="{{ route('posts.show', $post) }}" 
                   class="flex flex-col px-4 py-3 hover:bg-blue-50 border-b border-gray-100 last:border-0 transition duration-150">
                    <span class="font-semibold text-blue-900">{{ $post->title }}</span>
                    <span class="text-gray-500 text-sm truncate">{{ $post->content }}</span>
                </a>
            @empty
                <div class="px-4 py-3 text-gray-500 text-sm">No similar results found</div>
            @endforelse
        </div>
    @endif

</div>