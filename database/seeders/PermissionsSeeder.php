<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /**_________________________________________________________________________________ */

        // create role
        $role1 = Role::create(['name' => 'Admin', 'guard_name' => 'web']);

        $admin_permissions = Collection::make([
            // Users
            [
                'slug'       => 'users',
                'action'     => 'R',
                'name'       => 'Show User',
                'guard_name' => 'web',
            ],

            [
                'slug'       => 'users',
                'action'     => 'C',
                'name'       => 'Create User',
                'guard_name' => 'web',
            ],

            [
                'slug'       => 'users',
                'action'     => 'U',
                'name'       => 'Update User',
                'guard_name' => 'web',
            ],

            [
                'slug'       => 'users',
                'action'     => 'D',
                'name'       => 'Delete User',
                'guard_name' => 'web',
            ],

            // Tasks
            [
                'slug'       => 'tasks',
                'action'     => 'R',
                'name'       => 'Show Task',
                'guard_name' => 'web',
            ],

            [
                'slug'       => 'tasks',
                'action'     => 'C',
                'name'       => 'Create Task',
                'guard_name' => 'web',
            ],

            [
                'slug'       => 'tasks',
                'action'     => 'U',
                'name'       => 'Update Task',
                'guard_name' => 'web',
            ],

            [
                'slug'       => 'tasks',
                'action'     => 'D',
                'name'       => 'Delete Task',
                'guard_name' => 'web',
            ],
        ]);

        // create permissions
        $admin_permissions->each(function ($data) use ($role1) {
            $permission = Permission::create($data);
            $permission->assignRole($role1);
        });

        /**_________________________________________________________________________________ */

        $role2 = Role::create(['name' => 'Editor', 'guard_name' => 'web']);

        $editor_permissions = [
            'Show User',
            'Update User',
            'Show Task',
            'Update Task',
        ];

        $permissions = Permission::whereIn('name', $editor_permissions)->get();

        $permissions->each(function ($permission) use ($role2) {
            $permission->assignRole($role2);
        });
    }
}
