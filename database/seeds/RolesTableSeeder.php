<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        Permission::truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $roles = ['superuser', 'administrator', 'member'];
        $resources = ['user', 'role', 'permission'];
        $actions = ['read', 'create', 'update', 'delete'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::create(['name' => $action . '-' . $resource]);
            }
        }

        for ($i = 1; $i < 4; $i++) {
            $user = User::find($i);
            $role = Role::find($i);
            $user->assignRole($role);
        }
        $role = Role::first();
        $permissions = Permission::all();
        $role->syncPermissions($permissions);
    }
}
