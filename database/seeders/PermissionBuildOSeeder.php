<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionBuildOSeeder extends Seeder
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
                'name' => 'read service_menus',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'create service_menus',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'update service_menus',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'delete service_menus',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'read homes',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'create homes',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'update homes',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'delete homes',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'read transactions',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'create transactions',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'update transactions',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'delete transactions',
                'guard_name' => 'web',
            ]);
         Permission::create([
                'name' => 'cms',
                'guard_name' => 'web',
            ]);
    }
}
