<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatKechengTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //专业表
        Schema::create('profession',function (Blueprint $table){
            $table->increments('pro_id')->comment('专业主键');
            $table->string('pro_name',64)->unique()->comment('专业名称');
            $table->string('teacher_ids',60)->nullable()->comment('讲师ids');
            $table->text('pro_desc')->nullable()->comment('专业简介');
            $table->char('cover_img',100)->nullable()->comment('封面图片');
            $table->text('carousel_imgs')->nullable()->comment('轮播图');
            $table->timestamps();
            $table->softDeletes();
        });
        //课程表
        Schema::create('course',function (Blueprint $table){
            $table->increments('course_id')->comment('课程主键');
            $table->integer('pro_id')->comment('专业id');
            $table->string('course_name',64)->unique()->comment('课程名称');
            $table->decimal('course_price',7,2)->default('0.00')->comment('课程价格');
            $table->text('course_desc')->nullable()->comment('课程描述');
            $table->string('cover_img',128)->nullable()->comment('封面图');
            $table->timestamps();
            $table->softDeletes();
        });
        //课时表
        Schema::create('lesson',function (Blueprint $table){
            $table->increments('lesson_id')->comment('课时主键');
            $table->integer('course_id')->comment('课程id');
            $table->string('lesson_name',64)->unique()->comment('课时名称');
            $table->string('cover_img',128)->comment('封面图');
            $table->string('video_address',128)->nullable()->comment('视频地址');
            $table->text('lesson_desc')->nullable()->comment('课时描述');
            $table->integer('lesson_duration')->default(0)->comment('视频时长');
            $table->string('teacher_ids',128)->nullable()->comment('讲师');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profession');
        Schema::dropIfExists('course');
        Schema::dropIfExists('lesson');
    }
}
