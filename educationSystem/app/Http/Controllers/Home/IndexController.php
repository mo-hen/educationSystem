<?php

//声明命名空间
namespace App\Http\Controllers\Home;

//use:做空间类元素引入
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Course;

class IndexController extends Controller
{
    public function index()
    {
        $course = Course::with('lesson')->get();

        return view('home.index.index', compact('course'));
    }
}
