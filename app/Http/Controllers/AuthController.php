<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\image;

use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\LoginFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
    }
    public function registerView()
    {
        return view('auth.register');
    }
    public function register(RegisterFormRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        $intialRole = Role::where('name', 'Viewer')->first();
        $data['role_id'] = $intialRole->id;
        
        $user = User::create($data);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image()->create(['url' => $path]);
        }

        auth()->login($user);

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
