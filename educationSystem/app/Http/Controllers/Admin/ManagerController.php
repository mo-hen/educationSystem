<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    /**
     * @return string
     * 管理员登录
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')){

            # 接收用户名、密码、验证码、是否保持登录
//            $obj = new Manager();
//            $obj -> username = $request->input('username');
//            $obj -> password = $request->input('password');
//            $obj -> verify_code = $request->input('captcha');
//            $obj -> online = $request->input('online');

            // 验证
            $rules = [
                'username' => 'required',
                'password' => 'required',
                'verify_code' => 'required|captcha',
            ];
            $notices = [
                'username.required' => '用户名必填',
                'password.required' => '密码必填',
                'verify_code.required' => '验证码必填',
                'verify_code.captcha' => '验证码不正确',
            ];

            $validator = Validator::make($request->all() ,$rules,$notices);

            if($validator->passes()){
                //去数据库校验用户名和密码
                $name = $request->input('username');
                $pwd  = $request->input('password');
                //Auth限定使用的guard，并调用attempt()方法校验用户名和密码
                if(Auth::guard('admin')->attempt(['username'=>$name,'password'=>$pwd])){
                    return redirect('admin/index/index');
                }else{
                    return redirect('admin/manager/login')
                        ->withErrors(['errorinfo'=>'用户名或密码错误'])
                        ->withInput();
                }
            }else{
                //调回到之前的login登录页面，同时把相关的错误信息 和 用户输入信息返回
                return redirect('admin/manager/login')
                    ->withErrors($validator)
                    ->withInput();
            }

        }else{
            return view('admin/manager/login');
        }

    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/manager/login');
    }
    /**
     * @return string
     * 管理员列表
     */
    public function showlist()
    {
        //获取管理员列表
        //Manager::get(); //全部数据
        //Manager::first();//获得一条数据
        //Manager::find(数字/数组);//根据主键为条件获得纪录
        $info = Manager::with('role')->paginate(3);
        //$info = Manager::first();
//        dd(Auth::check());
//        dd(Auth::user());
//        dd($info);
        return view('admin/manager/showlist',['info'=>$info]);
    }
    /**
     * @return string
     * 管理员添加
     * 两个作用：① 展示添加表单 ②
     */
    public function add(Request $request)
    {
        if($request->isMethod('post')) {
            $rules = [
                'username' => 'required | min:4 | max:20 | unique:manager,username',
                'password' => 'required | min:6 | max:20 | confirmed',
                'mg_email' => 'required | email',
                'mg_phone'=>['required','regex:/^1[35]\d{9}$/'],
            ];
            $notices = [
                'username.required' =>'用户名必须填写',
                'username.unique' =>'用户名被占用',
                'username.min' =>'用户名长度不能小于4个字符',
                'username.max' =>'用户名长度不能大于20个字符',
                'password.required' => '密码必须填写',
                'password.confirmed' => '两次输入密码必须一致',
                'mg_email.required' => '邮箱必须填写',
                'mg_email.email' => '邮箱格式不正确',
                'mg_phone.required' => '手机号码必须填写',
                'mg_phone.regex' => '手机号码格式不正确',
            ];
            $validator = Validator::make($request->all(), $rules, $notices);
            if ($validator->passes()) {
                $data = $request->all();
                $data['password'] = bcrypt($data['password']);//加密处理
                Manager::create($data);
                return ['success' => true];  //array()  会返回json格式，自动json转化
            } else {
                $errorinfo = collect($validator->messages())->implode('0', '|');
                return ['success' => false, 'errorinfo' => $errorinfo];  //array()
            }

        }else{
            //展示添加管理员的表单效果
            return view('admin/manager/add');
        }
    }
    //管理员添加头像
    public function up_pic(Request $request)
    {
        //接收附件并存储到服务器上
        $file = $request->file('Filedata');  //文件流
        if($file->isValid()){
            $filename = $file -> store('manager','public');
            //dd($rst);//二级目录和图片名字
            echo json_encode(['success'=>true,'filename'=>"/storage/".$filename]);
        }else{
            echo json_encode(['success'=>false]);
        }
        exit;//避免后续输出信息
    }
    /**
     * 实现管理员数据修改
     * @param Request $request
     * @param Manager $manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function edit(Request $request,Manager $manager){
        if($request->isMethod('post')){
            //收集数据，存储入库
            $info = $request -> all();
            $rst = $manager -> update($info);  //会返回boolean值代表是否成功
            if($rst){
                return ['success'=>true];
            }else{
                return ['success'=>false];
            }
         }

        //修改表单展示
        return view('admin/manager/edit',['manager'=>$manager]);
    }
    //删除管理员
    function del(Manager $manager){
        $rst = $manager->delete();
        if($rst){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }
    //禁用管理员
    function disable(Manager $manager){
//        dd($manager);die();
        $rst = $manager->update(['mg_isable'=> 0]);
        if($rst){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }
    //启用管理员
    //禁用管理员
    function start(Manager $manager){
        $rst = $manager->update(['mg_isable'=> 1]);
        if($rst){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }
    //管理员权限管理
    public function permission(){
        echo '1234';
        return view('admin/manager/permission');
    }
    public function role(){
        return view('admin/manager/role');
    }
}

