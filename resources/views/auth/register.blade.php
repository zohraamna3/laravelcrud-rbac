
<h1>Register</h1>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
    <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control mb-2" required>

    <button type="submit" class="btn btn-success">Register</button>
</form>
<a href="{{ route('login') }}">Login</a>
