<?php

namespace App\Http\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    protected $table = "manager";   //设置表名
    protected $primaryKey = "mg_id";//设置主键
    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['username','password','mg_pic','mg_role_ids','mg_sex','mg_phone','mg_email','mg_isable','mg_remark'];
    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public  function role(){
        return $this->hasOne('App\Http\Models\Role','role_id','mg_role_ids');
    }
}

