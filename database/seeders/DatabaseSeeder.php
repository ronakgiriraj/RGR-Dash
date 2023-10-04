<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('settings')->insert([
            'page' => 'core',
            'name' => 'core',
            'value' => json_encode([
                'site_name' => 'RGR Dash',
                'site_favicon' => '/assets/admin/img/favicon/favicon.png',
                'admin_url' => 'admin',
                'site_url' => 'http://127.0.0.1:8000/',
            ]),
        ]);
    }
}
