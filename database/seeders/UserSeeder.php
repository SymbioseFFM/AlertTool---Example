<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'NETPERFORMERS',
                'last_name' => 'Administrator',
                'email' => 'daniel@heymanns.email',
                'password' => Hash::make('Start#123!', ['rounds' => 12]),
            ]
        ]);
    }
}
