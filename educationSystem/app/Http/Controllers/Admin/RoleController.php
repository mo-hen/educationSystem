<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Permission;
use App\Http\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $info = Role::get();
        return view('admin/role/index',compact('info'));
    }

    public function edit(Request $request,Role $role)
    {
        if($request->isMethod('post')){
            //角色名称校验:必填、不能重复
            //当限定角色名称唯一的时候，应该排除id为自己的情况，默认匹配主键字段为id
            //因为角色主键为role_id，所以需要，添加最后一个参数，表示主键role_id的值
            //为$role->role_id时，可以使用该角色名称
            $rules = [
                'role_name'=>'required|unique:role,role_name,'.$role->role_id.',role_id',
            ];
            $notices = [
                'role_name.required'=>'名称必填',
                'role_name.unique'=>'名称重复',
            ];
            //制作校验
            //使用门面的时候，可以用别名的方式调用（类名前加反斜杠），这样可以不做引入
            $validator = \Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //给角色修改信息：角色名称、权限的ids、权限的ac
                $role_name = $request->input('role_name');
                //拼接权限字符串
                $role_permission_ids = implode(',',$request->input('quanxian'));
                $role_permission_ac = Permission::whereIn('ps_id',$request->input('quanxian'))
                    ->select(\DB::raw('concat(ps_c,"-",ps_a) as ac'))
                    ->where('ps_level','1')
                    ->pluck('ac');  //collection(arr[c-a,c-a,c-a..])

                //把收集的控制器-操作方法 变为字符串信息
                //collection(arr[c-a,c-a,c-a..])-->c-a,c-a,c-a...
                $permission_ac = implode(',',$role_permission_ac->toArray());

                $role->update([
                    'role_name'=>$role_name,
                    'role_permission_ids'=>$role_permission_ids,
                    'role_permission_ac'=>$permission_ac,
                ]);
                return ['success'=>true];
            }else{
                //获取校验的错误信息
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        //获得用于分配的真实的权限信息，一级、二级分别获取
        $permissionA = Permission::where('ps_level','0')->get();
        $permissionB = Permission::where('ps_level','1')->get();

        return view('admin/role/edit',compact('role','permissionA','permissionB'));
    }
}
