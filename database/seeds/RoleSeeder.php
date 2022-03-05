<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Site Administratior'
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Site User'
            ],
        ];

        // Truncate table
        DB::table('roles')->truncate();

        // Insert new set of roles
        foreach ($roles as $key => $value) {
            Role::create([
                'name' => $value['name'],
                'display_name' => $value['display_name'],
                'description' => $value['description']
            ]);
        }
    }
}
