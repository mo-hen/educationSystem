<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Teacher;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //利用Faker实现大量数据模拟
        $faker = \Faker\Factory::create('zh_CN'); //创建一个faker对象
        for ($i = 0; $i < 50; $i++) {
            Teacher::create([
                'teacher_name' => $faker->name,
                'teacher_phone' => $faker->phoneNumber,
                'teacher_city' => $faker->city,
                'teacher_address' => $faker->address,
                'teacher_company' => $faker->company,
                'teacher_email' => $faker->email,
                'teacher_pic' => $faker->imageUrl(),
                'teacher_desc' => $faker->catchPhrase,
            ]);
        }

    }
}
