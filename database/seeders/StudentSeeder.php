<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'surname' => 'Student',
            'last_name' => 'Student',
            'email' => 'Student',
            'password' => Hash::make('Student@123'),
            'role' => 'Student',
        ]);
    }
}
