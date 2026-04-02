<?php

namespace App\Repositories;

use App\Models\Role;

use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getViewerRoleId()
    {
        $role = Role::where('name','Viewer')->first();
        return $role->id;
    }
}