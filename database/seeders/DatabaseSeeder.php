<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // make seeder for inbuilt site data & flexibility 
        $this->call(CountryTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(QualificationSeeder::class);
    }
}
