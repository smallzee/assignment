<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'surname' => 'Teacher',
            'last_name' => 'Teacher',
            'email' => 'Teacher',
            'password' => Hash::make('Teacher@123'),
            'role' => 'Teacher',
        ]);
    }
}
