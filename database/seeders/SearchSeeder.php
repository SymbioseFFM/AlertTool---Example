<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('searches')->insert([
            [
                'name' => 'E-Mail',
            ],
            [
                'name' => 'Betreff',
            ],
            [
                'name' => 'Inhalt',
            ]
        ]);
    }
}
