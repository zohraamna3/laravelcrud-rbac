<h1>{{ $post->title }}</h1>
<p>{{ $post->body }}</p>
<p>By: {{ $post->user->name }}</p>

<h3>Images</h3>
@foreach($post->images as $image)
    <img src="{{ asset('storage/'.$image->url) }}" width="200">
@endforeach

@if(auth()->user()->role->name !== 'Viewer')
    <form action="{{ route('images.store', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload Image</button>
    </form>
@endif

<h3>Comments</h3>
@foreach($post->comments as $comment)
    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}</p>
@endforeach

@if(auth()->user()->role->name !== 'Viewer')
    <form action="{{ route('comments.store', $post) }}" method="POST">
        @csrf
        <textarea name="body" placeholder="Add a comment"></textarea>
        <button type="submit">Comment</button>
    </form>
@endif

<a href="{{ route('posts.index') }}">Back to Posts</a>