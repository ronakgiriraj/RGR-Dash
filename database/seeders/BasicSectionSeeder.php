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
    }
}
