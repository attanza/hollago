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
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $roles = ['administrator', 'member'];
        $resources = ['user', 'role', 'permission'];
        $actions = ['read', 'create', 'update', 'delete'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::create(['name' => $action . ' ' . $resource]);
            }
        }
        $user = User::find(1);
        $role = Role::find(1);
        $user->assignRole($role);
        $user = User::find(2);
        $role = Role::find(2);
        $user->assignRole($role);
        $permissions = Permission::all();
        $role->syncPermissions($permissions);
    }
}
