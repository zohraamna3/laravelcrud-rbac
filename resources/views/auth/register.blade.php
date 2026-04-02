@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
            
            <h1 class="text-[42px] font-bold text-blue-900 mb-6 text-center">Register</h1>

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Name" 
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password"
                        class="w-full px-4 py-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Confirm Password"
                        class="w-full px-4 py-2 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input 
                        type="file" 
                        name="image"
                        required
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-white hover:file:text-blue-600 file:border file:border-blue-600 file:transition file:duration-200 cursor-pointer"
                    >
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-200 hover:text-green-900 cursor-pointer animate-bounce text-white font-semibold py-2 px-4 rounded-lg transition duration-200"
                >
                    Register
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-4">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">
                    Login
                </a> 
            </p>
        </div>
    </div>
@endsection