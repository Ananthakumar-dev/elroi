<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qualifications')->delete();

        DB::table('qualifications')->insert([
            [ 'id' => 1, 'label' => 'Grade 10' ],
            [ 'id' => 2, 'label' => 'Grade 12' ],
            [ 'id' => 3, 'label' => 'UG' ],
            [ 'id' => 4, 'label' => 'PG' ],
            [ 'id' => 5, 'label' => 'Ph.D' ],
        ]);
    }
}
