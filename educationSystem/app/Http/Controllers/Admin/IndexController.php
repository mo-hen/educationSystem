<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 后台首页面
     */
    public function index()
    {
        //获取当前登陆系统管理员对应的全部权限信息
        $mg_id = \Auth::guard('admin')->user()->mg_id;
        //获取角色的信息
        $roles = \DB::table('manager as m')
            ->join('role as r', 'm.mg_role_ids', '=', 'r.role_id')
            ->select('role_permission_ids')
            ->where('m.mg_id', $mg_id)
            ->first();
        if ($mg_id == 2) {
            //① 超级管理员[全部权限]
            //一级的
            $topA = \DB::table('permission')->where('ps_level', '0')->get();
            //二级的
            $topB = \DB::table('permission')->where('ps_level', '1')->get();
            //dd($topA);
        } else {
            try {
                //③ 有正确分配角色的普通管理员
                $permission_ids = explode(',', $roles->role_permission_ids);
                //dd($permission_ids);
                //根据$permission_ids获得全部的权限信息
                //一级的
                $topA = \DB::table('permission')
                    ->whereIn('ps_id', $permission_ids)
                    ->where('ps_level', '0')
                    ->get();
                //二级的
                $topB = \DB::table('permission')
                    ->whereIn('ps_id', $permission_ids)
                    ->where('ps_level', '1')
                    ->get();
                //dd($topA);
            } catch (\Exception $e) {

                //② 未分配角色的普通管理员[0个权限]
                $topA = [];
                $topB = [];
            }
        }

        //dd($mg_id);
        return view('admin/index/index', compact('topA', 'topB'));
    }

    /**
     * 后台首页面-右侧部分
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('admin/index/welcome');
    }
}
