<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->insert([
            ['pro_id'=>3,'course_name'=>'jQuery','course_desc'=>'js封装的功能包'],
            ['pro_id'=>1,'course_name'=>'Linux','course_desc'=>'服务器端操作系统'],
            ['pro_id'=>2,'course_name'=>'面向对象','course_desc'=>'代码的高级封装'],
            ['pro_id'=>1,'course_name'=>'html+css+js','course_desc'=>'前端基础课程'],
            ['pro_id'=>2,'course_name'=>'redis','course_desc'=>'redis入门'],
            ['pro_id'=>1,'course_name'=>'memcache','course_desc'=>'memcache入门'],
            ['pro_id'=>3,'course_name'=>'node.js','course_desc'=>'node.js精英之路'],
        ]);
    }
}
