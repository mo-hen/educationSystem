<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //为manager表，添加数据
        DB::table('manager')->insert([

            'username'=> 'mohen',
            'password'=> bcrypt('123456'),
            'mg_role_ids'=> '0',
            'mg_sex'=> '男 ',
            'mg_phone'=> '13526730151',
            'mg_email'=> 'mohen@qq.com',
            'mg_isable'=> 1,
            'mg_remark'=> 'mohen*****admin'

        ]);
        DB::table('manager')->insert([

            'username'=> 'momo',
            'password'=> bcrypt('123456'),
            'mg_role_ids'=> '1',
            'mg_sex'=> '男 ',
            'mg_phone'=> '13526730151',
            'mg_email'=> 'momo@qq.com',
            'mg_isable'=> 1,
            'mg_remark'=> 'momo*****admin'

        ]);
    }
}
