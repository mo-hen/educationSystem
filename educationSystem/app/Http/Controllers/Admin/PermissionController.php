<?php

namespace App\Http\Controllers\Admin;


use App\Http\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        //获得权限的数据，并转为二维数组
        $info = Permission::get()->toArray();

        $info = generateTree($info);  //给权限数据做上下级排序

        return view('admin/permission/index',compact('info'));
    }
    public function add(Request $request)
    {
        if($request->isMethod('post')){
            //检验数据
            $rules = [
                'ps_name' => 'required',
            ];
            $notices = [
                'ps_name.required' => '权限名称必填',
            ];
            $validator = \Validator::make($request->all(),$rules,$notices);
            if($validator->passes()){
                //处理ps_level等级(0/1)
                $data = $request->all();
                $data['ps_level'] = $data['ps_pid']==0 ? '0' : '1';
                Permission::create($data);
                return ['success'=>true];
            }else{
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }
        //获得可供选取的父权限
        $permissionA = Permission::where('ps_level','0')->pluck('ps_name','ps_id');
        return view('admin/permission/add',compact('permissionA'));
    }

    public function edit(Request $request,Permission $permission)
    {
        if($request->isMethod('post')){

            $rules = [
                'ps_name'=>'required|unique:permission,ps_name,'.$permission->ps_id .',ps_id',
            ];
            $notices = [
                'ps_name.required'=>'名称必填',
                'ps_name.unique'=>'名称重复',
            ];
            //制作校验
            //使用门面的时候，可以用别名的方式调用（类名前加反斜杠），这样可以不做引入
            $validator = \Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //处理ps_level等级(0/1)
                $data = $request->all();
                $data['ps_level'] = $data['ps_pid']==0 ? '0' : '1';
                $permission->update($data);
                return ['success'=>true];

            }else{
                //获取校验的错误信息
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        //获得用于分配的真实的权限信息，一级、二级分别获取
        $permissionA = Permission::where('ps_level','0')->pluck('ps_name','ps_id');
        return view('admin/permission/edit',compact('permission','permissionA'));

    }
}
