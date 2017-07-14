<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前台首页面--首页
Route::get('/', 'Home\IndexController@index');
//前台页面管理
Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
    //前台首页面--学员登录
    Route::match(['get', 'post'], 'student/login', 'StudentController@login');
    //学员管理--退出
    Route::get('student/logout', 'StudentController@logout');

    //前台个人中心--课程展示
    Route::get('person/course', 'PersonController@course');
    //前台个人中心--播放直播课程
    Route::get('video/play/{stream}', 'VideoController@play');
    //课程管理--详情
    Route::get('course/detail/{course}', 'CourseController@detail');

    //超市管理--添加课程到购物车
    Route::get('shop/cart_add/{course}', 'ShopController@cart_add');
    //超市管理--展示购物车信息)
    Route::get('shop/cart_account', 'ShopController@cart_account');
    //超市管理--购物车结算
    Route::get('shop/cart_settlement', 'ShopController@cart_settlement');
    //超市管理--支付完成
    Route::get('shop/cart_complete', 'ShopController@cart_complete');
    /*
     * 答卷管理
    */
    //答卷管理--进行答卷..
    Route::match(['get','post'],'exam/run/{paper}','ExamController@run');
    //答卷管理--查看答题结果
    Route::get('exam/result/{paper}','ExamController@result');

});

//后台管理员
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //后台管理员--登录
    Route::match(['get', 'post'], 'manager/login', 'ManagerController@login')->name('login');

    /*用户登陆检查*/
    Route::group(['middleware' => ['auth:admin']], function () {
        //后台管理员--退出
        Route::get('manager/logout', 'ManagerController@logout');
        //后台--首页面
        Route::get('index/index', 'IndexController@index');
        //后台--首页面(右侧部分)
        Route::get('index/welcome', 'IndexController@welcome');

        /*权限检查*/
        //设置使用“checkpermission”中间件的路由
        Route::group(['middleware' => ['checkpermission']], function () {

            //后台管理员--列表
            Route::get('manager/showlist', 'ManagerController@showlist');
            //后台管理员--添加管理员
            Route::match(['get', 'post'], 'manager/add', 'ManagerController@add');
            //后台管理员--添加管理员头像
            Route::post('manager/up_pic', 'ManagerController@up_pic');
            //后台管理员--修改
            Route::match(['get', 'post'], 'manager/edit/{manager}', 'ManagerController@edit');
            //后台管理员--删除
            Route::post('manager/del/{manager}', 'ManagerController@del');
            //后台管理员--停用
            Route::post('manager/disable/{manager}', 'ManagerController@disable');
            //后台管理员--启用
            Route::post('manager/start/{manager}', 'ManagerController@start');
            //管理员权限管理
            Route::get('manager/permission', 'ManagerController@permission');
            //管理员角色管理
            Route::get('manager/role', 'ManagerController@role');
            /*
             * 课程管理
             * */
            //课时默认列表显示
            Route::match(['get', 'post'], 'lesson/index', 'LessonController@index');
            //课时添加
            Route::match(['get', 'post'], 'lesson/lessonAdd', 'LessonController@lesson_add');
            //课时修改
            Route::match(['get', 'post'], 'lesson/lesson_edit/{lesson}', 'LessonController@lesson_edit');
            //课时封面上传
            Route::post('lesson/up_pic', 'LessonController@up_pic');
            //课时视频上传
            Route::post('lesson/up_video', 'LessonController@up_video');
            //课时启用/停用
            Route::post('lesson/lesson_toggle/{lesson}', 'LessonController@lesson_toggle');
            //视频播放
            Route::get('lesson/lesson_play/{lesson}', 'LessonController@lesson_play');
            //课时详情查看
            Route::get('lesson/lesson_desc_show/{lesson}', 'LessonController@lesson_desc_show');
            //删除课时
            Route::post('lesson/lesson_del/{lesson}', 'LessonController@lesson_del');
            //课时批量删除
            Route::post('lesson/groupDel', 'LessonController@groupDel');
            //直播流--列表显示
            Route::get('stream/index', 'StreamController@index');
            //直播流--添加
            Route::match(['get', 'post'], 'stream/stream_add', 'StreamController@stream_add');
            //直播课程--列表显示
            Route::get('live/index', 'LiveCourseController@index');
            //直播课程--添加
            Route::match(['get', 'post'], 'live/live_add', 'LiveCourseController@live_add');
            /*
            *试卷管理
            */
            //试卷管理--列表展示
            Route::get('paper/index', 'PaperController@index');
            //试题管理--列表展示
            Route::get('question/index/{paper}', 'QuestionController@index');
            //试题管理--添加
            Route::match(['get', 'post'], 'question/add/{paper}', 'QuestionController@add');

            /*
            *角色管理
            */
            //角色管理--列表显示
            Route::get('role/index', 'RoleController@index');
            //角色管理--修改(分配权限)
            Route::match(['get', 'post'], 'role/edit/{role}', 'RoleController@edit');
            /*
             * 权限管理
            */
            //权限管理--列表显示
            Route::get('permission/index', 'PermissionController@index');
            //权限管理--添加
            Route::match(['get', 'post'], 'permission/add', 'PermissionController@add');
            //修改权限
            Route::match(['get', 'post'], 'permission/edit/{permission}', 'PermissionController@edit');

        });
    });

});








