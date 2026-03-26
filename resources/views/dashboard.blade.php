<h1>Welcome, {{ $user->name }} ({{ $role }})</h1>
<hr>

<h2>All Posts</h2>

@if($role !== 'Viewer')
    <a href="{{ route('posts.create') }}">Create New Post</a>
@endif

@foreach($posts as $post)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <p>By: {{ $post->user->name }}</p>

        @if($role === 'Admin' || $role === 'Editor')
            <a href="{{ route('posts.edit', $post) }}">Edit</a>

            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>

        @endif

        <!-- All comments for all roles -->
        <h4>Comments:</h4>
        @foreach($post->comments as $comment)
            <p>{{ $comment->comment }}</p>
        @endforeach
    </div>
@endforeach