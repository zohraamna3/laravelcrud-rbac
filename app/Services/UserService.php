<?php

namespace App\Services;

use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserService
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    
    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        // $intialRole = Role::where('name', 'Viewer')->first();
        $intialRoleId = $this->roleRepository->getViewerRoleId();
        $data['role_id'] = $intialRoleId;
        
        $user = $this->userRepository->createUser($data);
        return $user;

    }
}