<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    const GUARD = 'web';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $roles = [
            [
                'name' => 'super-admin',
                'guard_name' => self::GUARD
            ],
            [
                'name' => 'admin',
                'guard_name' => self::GUARD
            ],
        ];
        Role::insert($roles);
        $role = Role::findByName('super-admin');
        $role->givePermissionTo(Permission::all());
    }
}
