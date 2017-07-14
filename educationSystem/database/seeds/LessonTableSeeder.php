<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson')->insert([
            ['course_id'=>1,'lesson_name'=>'jquery选择器使用','lesson_desc'=>'灵活的选择器','lesson_duration'=>30,'cover_img'=>''],
            ['course_id'=>1,'lesson_name'=>'jquery事件操作','lesson_desc'=>'诡异的事件','lesson_duration'=>45,'cover_img'=>''],
            ['course_id'=>2,'lesson_name'=>'linux的编辑器vi','lesson_desc'=>'很好强大','lesson_duration'=>25,'cover_img'=>''],
            ['course_id'=>2,'lesson_name'=>'linux的编辑器常用命令','lesson_desc'=>'厉害','lesson_duration'=>17,'cover_img'=>''],
            ['course_id'=>2,'lesson_name'=>'linux安装','lesson_desc'=>'很快','lesson_duration'=>30,'cover_img'=>''],
            ['course_id'=>2,'lesson_name'=>'linux任务调度','lesson_desc'=>'方便','lesson_duration'=>22,'cover_img'=>''],
        ]);
    }
}
