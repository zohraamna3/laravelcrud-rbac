<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Image;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
            UserSeeder::class,
        ]);

        User::factory(10)->create()->each(function ($user) {
            Image::factory()->create(['imageable_id' => $user->id, 'imageable_type' => User::class]);
        });

        Post::factory(20)->create()->each(function ($post) {
            Comment::factory(3)->create(['post_id' => $post->id]);
            Image::factory(2)->create(['imageable_id' => $post->id, 'imageable_type' => Post::class]);
        });

        
    }
}
