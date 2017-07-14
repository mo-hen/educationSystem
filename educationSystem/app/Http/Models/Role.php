<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";   //设置表名
    protected $primaryKey = "role_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['role_name','role_permission_ids','role_permission_ac'];

    public function manager(){
        return $this->hasMany('App\Http\Models\Manager','mg_role_ids','role_id');
    }

}
