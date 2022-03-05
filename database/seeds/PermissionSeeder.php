<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissons = [
            [
                'name' => 'FormController@listFrom',
                'display_name' => 'List From',
                'permission_type' => 1, // Admin
                'description' => 'Forms listing',
            ],
            [
                'name' => 'FormController@addForm',
                'display_name' => 'Add From',
                'permission_type' => 1, // Admin
                'description' => 'Add Forms',
            ],
            [
                'name' => 'FormController@editForm',
                'display_name' => 'Edit From',
                'permission_type' => 1, // Admin
                'description' => 'Edit Forms',
            ],
            [
                'name' => 'FormController@deleteForm',
                'display_name' => 'Delete From',
                'permission_type' => 1, // Admin
                'description' => 'Delete Forms',
            ],
        ];

        // Truncate table
        DB::table('permissions')->truncate();

        // Insert new permissions to table
        foreach ($permissons as $key => $value) {
            Permission::firstOrCreate([
                'name' => $value['name'],
                'display_name' => $value['display_name'],
                'permission_type' => $value['permission_type'],
                'description' => $value['description']
            ]);
        }
    }
}
