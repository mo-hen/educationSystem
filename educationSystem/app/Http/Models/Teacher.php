<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    protected $table = "teacher";   //设置表名
    protected $primaryKey = "teacher_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['teacher_name','teacher_phone','teacher_email','teacher_pic','teacher_desc','is_able'];

    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
