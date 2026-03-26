<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Role::where('name', 'Admin')->first();
        $editor=Role::where('name', 'Editor')->first();
        $viewer=Role::where('name', 'Viewer')->first();

        $admin->permissions()->attach(Permission::pluck('id'));
        $editor->permissions()->attach(Permission::whereIn('name', ['create-posts', 'edit-posts', 'view-posts'])->pluck('id'));
        $viewer->permissions()->attach(Permission::whereIn('name', ['view-posts'])->pluck('id'));
    }
}
