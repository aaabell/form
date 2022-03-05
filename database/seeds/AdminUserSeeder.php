<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = [
            [
                'name' => 'Admin',
                'email' => 'admin@formapp.com',
                'role_type' => 1,
                'password' => Hash::make('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Truncate table
        DB::table('users')->truncate();

        // Insert users to table
        foreach ($adminUser as $key => $adminUser) {
            User::create([
                'name' => $adminUser['name'],
                'email' => $adminUser['email'],
                'role_type' => $adminUser['role_type'],
                'password' => $adminUser['password'],
                'created_at' => $adminUser['created_at'],
                'updated_at' => $adminUser['updated_at'],
            ]);
        }
    }
}
