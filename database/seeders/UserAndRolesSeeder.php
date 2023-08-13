<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        DB::table('roles')->insert([
            'name' => 'admin',
            'caption' => 'Admin',
            'is_admin' => '1',
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'caption' => 'User',
            'is_admin' => '0',
        ]);

        // Add User to Tankaar Channel Partner
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@demo.com',
            'role_id' => '1',
            'avatar' => '/assets/admin/img/avatars/default-avatar.png',
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@demo.com',
            'role_id' => '2',
            'avatar' => '/assets/admin/img/avatars/default-avatar.png',
            'password' => Hash::make('user'),
        ]);
    }
}
