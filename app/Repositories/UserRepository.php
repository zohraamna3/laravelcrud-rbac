<?php

namespace App\Repositories;

use App\Models\User;

use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createUser($data): User
    {
        $user = User::create($data);
        return $user;
    }
}