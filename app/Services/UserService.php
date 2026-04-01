<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserService
{
    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        $intialRole = Role::where('name', 'Viewer')->first();
        $data['role_id'] = $intialRole->id;
        
        $user = User::create($data);
        return $user;

    }
}