<h1>Create Post</h1>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Title" required>
    <br><br>

    <textarea name="content" placeholder="Body" required></textarea>
    <br><br>

    <!-- Image upload -->
    <input type="file" name="image">
    <br><br>

    <button type="submit">Create</button>
</form>

<a href="{{ route('dashboard') }}">Back to Posts</a>