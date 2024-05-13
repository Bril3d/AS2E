<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(["name" => "admin"])->syncPermissions(['Dashboard View', 'Users CRUD', 'Roles CRUD', 'Appointments CRUD', 'Settings CRUD', 'Projects CRUD', 'Posts CRUD', 'Comments CRUD', 'Expertises CRUD', 'File Explorer CRUD']);
        Role::create(["name" => "moderator"])->syncPermissions(['Dashboard View', 'Appointments CRUD', 'Projects CRUD', 'Posts CRUD', 'Comments CRUD', 'Expertises CRUD']);
        Role::create(["name" => "user"])->syncPermissions(['Dashboard View', 'Posts CRUD', 'Comments CRUD']);;
    }
}
