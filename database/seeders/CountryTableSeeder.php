<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->delete();

        DB::table('countries')->insert([
            ['id' => 1, 'name' => 'India', 'code' => 'IN'],
            ['id' => 2, 'name' => 'United States', 'code' => 'US'],
            ['id' => 3, 'name' => 'Egypt', 'code' => 'EG'],
        ]);
    }
}
