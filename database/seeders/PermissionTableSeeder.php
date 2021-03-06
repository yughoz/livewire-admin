<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::create(
            [
                'name' => 'read permission',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'create permission',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'update permission',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'delete permission',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'read role',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'create role',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'update role',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'delete role',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'read user',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'create user',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'update user',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'delete user',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'user management',
                'guard_name' => 'web',
            ]);
    }
}
