<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'about_avatar' => 'Mr GraceHand',
            'about_name' => 'Mr GraceHand',
            'about_description' => 'Admin',
            'about_avatar' => 'Mr GraceHand',
            'about_name' => 'Mr GraceHand',
            'about_description' => 'Admin',
        ]);
    }
}
