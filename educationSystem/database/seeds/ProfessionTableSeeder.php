<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profession')->insert([
            ['pro_name'=>'全栈'],
            ['pro_name'=>'PHP'],
            ['pro_name'=>'前端'],
            ['pro_name'=>'Java'],
            ['pro_name'=>'C++'],
            ['pro_name'=>'Python'],
            ['pro_name'=>'UI'],
            ['pro_name'=>'IOS'],
            ['pro_name'=>'Android'],
        ]);
    }
}
