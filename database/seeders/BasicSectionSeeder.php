<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'id' => 1,
            'name' => 'admin',
            'caption' => 'Core Permission',
            'group_id' => 1
        ]);

        DB::table('sections')->insert([
            'id' => 2,
            'name' => 'admin_general_dashboard',
            'caption' => 'Admin General Dashboard',
            'group_id' => 1
        ]);
        DB::table('sections')->insert([
            'id' => 3,
            'name' => 'admin_general_dashboard_show',
            'caption' => 'General Dashboard Show',
            'group_id' => 2
        ]);

        DB::table('sections')->insert([
            'id' => 4,
            'name' => 'admin_role_permissions',
            'caption' => 'Role & Permissions',
            'group_id' => 1
        ]);
        DB::table('sections')->insert([
            'id' => 5,
            'name' => 'admin_role_permissions_permissions_list',
            'caption' => 'Permissions List',
            'group_id' => 4
        ]);
        DB::table('sections')->insert([
            'id' => 6,
            'name' => 'admin_role_permissions_create_permission',
            'caption' => 'Create Permission',
            'group_id' => 4
        ]);
        DB::table('sections')->insert([
            'id' => 7,
            'name' => 'admin_role_permissions_edit_permissions',
            'caption' => 'Edit Permissions ⚠️ 🛑',
            'group_id' => 4
        ]);
        DB::table('sections')->insert([
            'id' => 8,
            'name' => 'admin_role_permissions_delete_permission',
            'caption' => 'Delete Permission ⚠️ 🛑',
            'group_id' => 4
        ]);
        DB::table('sections')->insert([
            'id' => 9,
            'name' => 'admin_role_permissions_roles_list',
            'caption' => 'Roles List',
            'group_id' => 4
        ]);
        DB::table('sections')->insert([
            'id' => 10,
            'name' => 'admin_role_permissions_create_new_role',
            'caption' => 'Create New Role ⚠️ 🛑',
            'group_id' => 4
        ]);
        DB::table('sections')->insert([
            'id' => 11,
            'name' => 'admin_role_permissions_edit_role',
            'caption' => 'Edit Role ⚠️ 🛑',
            'group_id' => 4
        ]);
        DB::table('sections')->insert([
            'id' => 12,
            'name' => 'admin_role_permissions_delete_role',
            'caption' => 'RoleDelete Role ⚠️ 🛑',
            'group_id' => 4
        ]);

        DB::table('sections')->insert([
            'id' => 13,
            'name' => 'admin_users',
            'caption' => 'Users',
            'group_id' => 1
        ]);
        DB::table('sections')->insert([
            'id' => 14,
            'name' => 'admin_users_create_new_user',
            'caption' => 'Create New User',
            'group_id' => 13
        ]);
        DB::table('sections')->insert([
            'id' => 15,
            'name' => 'admin_users_list',
            'caption' => 'Users List',
            'group_id' => 13
        ]);
        DB::table('sections')->insert([
            'id' => 16,
            'name' => 'admin_users_edit_user',
            'caption' => 'Edit User',
            'group_id' => 13
        ]);
        DB::table('sections')->insert([
            'id' => 17,
            'name' => 'admin_users_delete_user',
            'caption' => 'Delete User',
            'group_id' => 13
        ]);

        DB::table('sections')->insert([
            'id' => 18,
            'name' => 'admin_settings',
            'caption' => 'Settings',
            'group_id' => 1
        ]);
        DB::table('sections')->insert([
            'id' => 19,
            'name' => 'admin_settings_update_app',
            'caption' => 'Update App',
            'group_id' => 18
        ]);

    }
}
