<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RBAC App</title>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <a href="{{ route('dashboard') }}">Home</a>

        @auth
            <span>Hi, {{ auth()->user()->name }} ({{ auth()->user()->role->name }})</span>

            @if(auth()->user()->role->name === 'Admin')
                <a href="{{ route('users.index') }}">Manage Users</a>
            @endif

            @if(auth()->user()->role->name === 'Editor')
                <a href="{{ route('posts.index') }}">Manage Posts</a>
            @endif

            @if(auth()->user()->role->name === 'Viewer')
                <a href="{{ route('posts.index') }}">View Posts</a>
            @endif

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <hr>

    <!-- Flash Messages -->
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        @yield('content')
    </div>

</body>
</html>