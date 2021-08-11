<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        if (DB::table('semesters')->get()->count() != 0) {
            DB::table('semesters')->delete();
        }
        DB::table('semesters')->insert([
            [
                'name' => 'Frist Semester',
                'semester' => '1'
            ],
            [
                'name' => 'Second Semester',
                'semester' => '2'
            ]
        ]);
    }
}
