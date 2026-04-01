<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $userService;
    protected $imageService;
    public function __construct(UserService $userService, ImageService $imageService)
    {
        $this->userService = $userService;
        $this->imageService = $imageService;
    }
    public function login($credentials, $request)
    {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return true;
        }
        return false;
    }

    public function register($data, $request)
    {
        $user = $this->userService->createUser($data);
        $this->imageService->storeImage($request, $user);
        Auth::login($user);
        return $user;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}