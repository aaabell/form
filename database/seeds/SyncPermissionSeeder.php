<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class SyncPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        // Get all permissions for admin users
        $permissions = Permission::whereIn('permission_type', [1])->pluck('id');
        // Attach permssions to admin role
        $adminRole->permissions()->sync($permissions);

        // Attach admin user with admin role
        $adminUsers = User::where('role_type', 1)->get();
        foreach ($adminUsers as $key => $adminUser) {
           $adminUser->attachRole($adminRole);
        }


        $userRole = Role::where('name', 'user')->first();
        // Get all permissions for user
        $permissions = Permission::whereIn('permission_type', [2])->pluck('id');
        // Attach permission to user role
        $userRole->permissions()->sync($permissions);
    }
}
