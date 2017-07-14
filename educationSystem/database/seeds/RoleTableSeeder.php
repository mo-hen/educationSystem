<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role_name'=>'超级管理员']);
        Role::create(['role_name'=>'总编']);
        Role::create(['role_name'=>'栏目主编']);
        Role::create(['role_name'=>'栏目编辑']);
    }
}
