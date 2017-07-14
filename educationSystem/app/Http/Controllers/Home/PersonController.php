<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\LiveCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    public function course()
    {
        //展示直播课程信息
        $lives = LiveCourse::get();

        $lives->each(function($v, $k){
            //$v->access=1;
            $v->access = $v->is_play_by_time();
        });
        //dd($live);

        return view('home/person/course',compact('lives'));
    }
}
