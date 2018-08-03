<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create roles and assign created permissions
        $role = Role::create(['name' => 'super-admin', 'gate' => 'web']);
        $role->givePermissionTo(Permission::all());
    }
}
