<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Course;
use App\Http\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            //获取记录总条数
            $count = Lesson::count();
            //获取课时列表信息
            //【实现排序】，获取排序条件
            //获取排序字段的字段序号order[0][column]
            $order_num = $request->input('order.0.column');
            //获取排序字段 比如：columns[1][data]
            $order = $request->input('columns.' . $order_num . '.data');
            //排序方式 order[0][dir]:desc
            $by = $request->input('order.0.dir');
            //【实现分页】
            $offset = $request->input('start');
            $len = $request->input('length');
            //【检索模糊查找】search[value]
            $search = $request->input('search.value');
            //查询数据
            $info = Lesson::orderBy($order, $by)->offset($offset)->limit($len)
                ->where('lesson_name', 'like', "%$search%")
                ->orWhere('lesson_desc', 'like', "%$search%")
                ->with(['course' => function ($c) {
                    //可以进行逻辑处理
                    //$c->where('course_price', '>', 1000);
                    $c->with('profession');
                }])
                ->get();
            //把数据库取出的数据，传递给客户端的datatable使用
            return [
                'draw' => $request->get('draw'),
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $info,
            ];
        }
        return view('admin/lesson/index');
    }

    //课时添加
    public function lesson_add(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'lesson_name' => 'required',
                'course_id' => 'required',
            ];
            $notices = [
                'lesson_name.required' => '课时名称必填',
                'course_id.required' => '课程必选',
            ];
            //制作验证
            $validator = Validator::make($request->all(), $rules, $notices);
            if ($validator->passes()) {
                //数据存储
                Lesson::create($request->all());
                return ['success' => true];
            } else {
                //验证失败，回传错误信息
                $errorinfo = collect($validator->messages())->implode('0', '|');
                return ['success' => false, 'errorinfo' => $errorinfo];
            }
        }
        //获取供选取的"课程"信息
        //$course = Course::get();
        //pluck 方法为给定键获取所有集合值：
        //plunk方法可以把第二个参数的值作为下标（key），第一个参数当成键值（value）
        //生成一一对应的一维关联数组,此时类调用此方法返回的还是一个含有该元素（items=array）的集合对象
        $course = Course::pluck('course_name', 'course_id');
//        dd($course);
//        dd(compact('course'));die();
        //compact方法可以把集合对象里面的元素取出，转化为view方法，参数所要求的一位关联（键值对）数组
        return view('admin/lesson/lessonAdd', compact('course'));
    }

    //课时修改
    public function lesson_edit(Request $request, Lesson $lesson)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'lesson_name' => 'required',
                'course_id' => 'required',
            ];
            $notices = [
                'lesson_name.required' => '课时名称必填',
                'course_id.required' => '课程必选',
            ];
            $validator = Validator::make($request->all(), $rules, $notices);
            if ($validator->passes()) {
                //如果上传新图片，就删除旧图片，判断依据：表单图片路径名与数据库的不一致
                if ($request->input('cover_img') !== $lesson->cover_img) {
                    //---- /storage/lesson/QXr84s3YPeBfrXnKLaY8bB4d8D9lslqj1nUpjM02.png
                    $filename = str_replace('/storage/', '', $lesson->cover_img);
                    Storage::disk('public')->delete($filename);
                }
                //如果上传新视频，就删除旧视频，判断依据：表单视频路径名与数据库的不一致
                if ($request->input('video_address') !== $lesson->video_address) {
                    //--- /storage/video/XEvHkT6fQ5lHGuJ58mpvAUD2Z6g6EiKgnvEk5dop.mp4
                    $filename = str_replace('/storage', '', $lesson->video_address);
                    Storage::disk('public')->delete($filename);
                }
                $lesson->update($request->all());
                return ['success' => true];
            }
        }
        $course = Course::pluck('course_name', 'course_id');
//        dd(compact('lesson','course'));
        return view('admin/lesson/lesson_edit', compact('lesson', 'course'));
    }

    //上传视频
    public function up_video(Request $request)
    {
        //接收附件并存储到服务器上
        $file = $request->file('Filedata');  //文件流
        if ($file->isValid()) {
            $filename = $file->store('video', 'public');
            //dd($rst);//二级目录和图片名字
            echo json_encode(['success' => true, 'filename' => "/storage/" . $filename]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit;//避免后续输出信息
    }

    //上传封面图
    public function up_pic(Request $request)
    {
        $file = $request->file('Filedata');
        if ($file->isValid()) {
            $filename = $file->store('lesson', 'public');
            echo json_encode(['success' => true, 'filename' => "/storage/" . $filename]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit;
    }

    //课时启用、停用
    public function lesson_toggle(Request $request, Lesson $lesson)
    {
        if ($request->isMethod('post')) {
            //给课时做启用、停用操作
            //$flag = 1;  //停用
            //$flag = 2;  //启动
            $flag = $request->input('flag');
            //flag=1 启用 flag=0 停用
            if ($lesson->update(['is_able' => $flag])) {
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        }
    }

    //视频播放
    public function lesson_play(Lesson $lesson)
    {
        return view('admin/lesson/lesson_play', compact('lesson'));
    }

    //课时详情查看
    public function lesson_desc_show(Lesson $lesson)
    {
        return view('admin/lesson/lesson_desc_show', compact('lesson'));
    }

    //删除课时
    public function lesson_del(Lesson $lesson){
        $rst = $lesson->delete();
        if($rst){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }
    //批量删除
    public function groupDel(Request $request)
    {
        $ids = $request->input('ids');
        //dd($ids);die();
        //where id in(1,2)
        //each 方法迭代集合中的数据项并传递每个数据项到给定回调：
        //如果你想要终止对数据项的迭代，可以从回调返回 return false ：
        Lesson::whereIn('lesson_id',$ids)->get()->each(function ($item) {
            $item->delete();
        });
        return ['success' => true];
    }
}
