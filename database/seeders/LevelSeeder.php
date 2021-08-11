<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            
        ];
        if (DB::table('levels')->get()->count() != 0) {
            DB::table('levels')->delete();
        }
        DB::table('levels')->insert([
            [
                'name' => '100 Level',
                'level' => '1'
            ],
            [
                'name' => '200 Level',
                'level' => '2'
            ],
            [
                'name' => '300 Level',
                'level' => '3'
            ],
            [
                'name' => '400 Level',
                'level' => '4'
            ],
            [
                'name' => '500 Level',
                'level' => '5'
            ]
        ]);
    }
}
