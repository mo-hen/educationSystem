<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role',function(Blueprint $table){
            $table -> increments('role_id')->comment('主键');
            $table -> string('role_name',20)->comment('角色名称');
            $table -> string('role_auth_ids',128)->nullable()->comment('权限ids,1,2,5');
            $table -> text('role_auth_ac',128)->nullable()->comment('控制器-操作,控制器-操作,控制器-操作');
            $table -> timestamps();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfexists('role');
    }
}
