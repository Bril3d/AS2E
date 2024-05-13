<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['Dashboard View', 'Users CRUD', 'Roles CRUD','Permissions CRUD', 'Appointments CRUD', 'Settings CRUD', 'Projects CRUD', 'Posts CRUD', 'Comments CRUD', 'Expertises CRUD', 'File Explorer CRUD'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
