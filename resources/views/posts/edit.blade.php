<h1>Edit Post</h1>

<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $post->title }}" required>
    <textarea name="content" placeholder="{{$post->content}}" required>{{ $post->content }}</textarea>
    <button type="submit">Update</button>
</form>

<a href="{{ route('dashboard') }}">Back to Posts</a>