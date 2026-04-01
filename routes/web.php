<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register',[AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('posts', PostController::class)->middleware('auth');
Route::get('/test', function() {
    return view('test');
})->middleware('auth');
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('posts/{post}/images', [ImageController::class, 'store'])->name('images.store')->middleware('auth');
