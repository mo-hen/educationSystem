<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\LiveCourse;
use App\Http\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LiveCourseController extends Controller
{
    public function index(Request $request)
    {
        $info = LiveCourse::with('stream')->get();
//        dd($info);
        return view('admin/live/index',compact('info'));
    }
    public function live_add(Request $request)
    {
        if($request->isMethod('post')){
            //验证
            $rules = [
                'course_name'=>'required',
                'stream_id'=>'required',
                'start_at'=>'required',
                'end_at'=>'required',
            ];
            $notices = [
                'course_name.required'=>'名称不能为空',
                'stream_id.required'=>'直播流必选',
                'start_at.required'=>'直播流必选',
                'end_at.required'=>'直播流必选',
            ];
            //制作
            $validator = Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //存储数据入库
                //格式化时间变为时间戳
                $start = strtotime($request->input('start_at'));
                $end = strtotime($request->input('end_at'));
                LiveCourse::create([
                    'course_name'=>$request->input('course_name'),
                    'stream_id'=>$request->input('stream_id'),
                    'start_at'=>$start,
                    'end_at'=>$end,
                ]);
                return ['success'=>true];
            }else{
                //校验失败
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        //获取直播流
        $stream = Stream::pluck('stream_name','stream_id');
        return view('admin/live/live_add',compact('stream'));
    }
}
