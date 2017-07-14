<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*CREATE TABLE `edu_manager` (
              `mg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
              `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
              `password` char(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
              `mg_role_ids` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色id',
              `mg_sex` enum('男','女') COLLATE utf8_unicode_ci NOT NULL COMMENT '性别',
              `mg_phone` char(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机号',
              `mg_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
              `mg_remark` text COLLATE utf8_unicode_ci COMMENT '备注',
              `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
              `deleted_at` timestamp NULL DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`mg_id`),
              UNIQUE KEY `manager_username_unique` (`username`)
            ) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        */

        //利用php实现数据表的创建
        //$table必须使用Blueprint声明，代表其是对象，并可以调用成员
        Schema::create('manager', function (Blueprint $table) {
            $table->increments('mg_id')->comment('主键');
            $table->string('username',64)->unique()->comment('用户名');
            $table->char('password',60)->comment('密码');
            $table->string('mg_role_ids',100)->comment('角色id');
            $table->enum('mg_sex',['男','女'])->comment('性别');
            $table->char('mg_phone',11)->comment('手机号');
            $table->string('mg_email',64)->comment('邮箱');
//            $table->enum('mg_isable',['1','0'])->comment('是否禁用');
            $table->text('mg_remark')->nullable()->comment('备注');
            $table->rememberToken();# 生成记住登录的字段
            $table->softDeletes();
            $table->timestamps();# 创建时间、修改时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除数据表
        Schema::dropIfExists('manager');
    }
}
