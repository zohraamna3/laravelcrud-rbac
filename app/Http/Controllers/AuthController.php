<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\image;

use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\LoginFormRequest;

use App\Services\AuthService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        $credentials = $request->validated();

        $isLoggedIn = $this->authService->login($credentials, $request);


        if ($isLoggedIn) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function registerView()
    {
        return view('auth.register');
    }
    public function register(RegisterFormRequest $request)
    {
        $data = $request->validated();

        $user = $this->authService->register($data, $request);
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
