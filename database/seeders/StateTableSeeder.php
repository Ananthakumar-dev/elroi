<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->delete();

        DB::table('states')->insert([
            ['country_id' => 1, 'name' => 'Tamilnadu'],
            ['country_id' => 1, 'name' => 'Kerala'],
            ['country_id' => 1, 'name' => 'Karnataka'],
            ['country_id' => 1, 'name' => 'Andra'],
            ['country_id' => 2, 'name' => 'New York'],
            ['country_id' => 2, 'name' => 'New Jersey'],
            ['country_id' => 2, 'name' => 'Phoenix'],
            ['country_id' => 2, 'name' => 'Los Angels'],
            ['country_id' => 2, 'name' => 'Phoenix'],
            ['country_id' => 3, 'name' => 'Al Buhayrah'],
            ['country_id' => 3, 'name' => 'Al Fayyum'],
            ['country_id' => 3, 'name' => 'Al Jizah'],
        ]);
    }
}
