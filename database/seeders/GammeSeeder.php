<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class GammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('gammes')->insert([
        ['type' => 'LAS', 'display_name' => 'Laser Files'],
        ['type' => 'STR', 'display_name' => 'Structural Files'],
        ['type' => 'CTR', 'display_name' => 'Control Files'],
    ]);
}
}
