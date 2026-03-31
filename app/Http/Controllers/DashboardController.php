<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load('image');
        $role = $user->role->name;
        $posts = Post::with('comments', 'images','user')->get();
        
        return view('dashboard', compact('user', 'role', 'posts'));
    }
}
