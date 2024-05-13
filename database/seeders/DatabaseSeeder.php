<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(PermissionSeeder::class);

        $this->call(RoleSeeder::class);

        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });;
        $this->call(AdminSeeder::class);
        Post::factory()->count(30)->create();
        $this->call(SettingsTableSeeder::class);
    }
}
