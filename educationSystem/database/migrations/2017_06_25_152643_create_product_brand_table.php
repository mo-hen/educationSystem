<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_brand', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->notNull()->unique();
            $table->string('logo', 255)->notNull()->default('');
            $table->string('site', 255)->notNull()->default('');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();# 假删除字段、deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_brand');
    }
}
