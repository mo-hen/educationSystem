<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>品牌管理</title>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span> 课程列表
    <span class="c-gray en">&gt;</span> 课程管理
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin"
               class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax"
               class="input-text Wdate" style="width:120px;">
        <input type="text" class="input-text" style="width:250px" placeholder="输入课时、课程、专业名称、描述" id="" name="">
        <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜课程
        </button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="javascript:;" onclick="groupDel()" class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除
			</a>
			<a href="javascript:;" onclick="lesson_add('添加用户','/admin/lesson/lessonAdd','','510')"
               class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe600;</i> 添加课时
			</a>
		</span>
        {{--<span class="r">共有数据：<strong>88</strong> 条</span>--}}
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="4%"><input type="checkbox" name="" value=""></th>
                <th width="6%">ID</th>
                <th width="14%">课时名称</th>
                <th width="10%">对应课程</th>
                <th width="8%">所属专业</th>
                <th width="6%">视频</th>
                <th width="8%">授课老师</th>
                <th width="8%">售价</th>
                <th width="14%">创建时间</th>
                <th width="6%">描述</th>
                <th width="8%">状态</th>
                <th width="*">操作</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    $(function () {
        //datatable 列表显示
        mydatatable = $('.table-sort').dataTable({
            "order": [[1, "asc"]],
            "stateSave": false,//状态保存
            "columnDefs": [
                {"targets": [0, 9], "orderable": false}// 制定列不参与排序
            ],

            "lengthMenu": [4, 8, 16, 32],
            "paging": true,
            "info": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('admin/lesson/index') }}",
                "type": "POST",
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },

            //给各个"td"填充内容
            "columns": [
                {'data': 'a', "defaultContent": "<input type='checkbox'>"},
                {'data': 'lesson_id'},
                {'data': 'lesson_name'},
                {'data': 'course.course_name'},
                {'data': 'course.profession.pro_name'},
//                {'data': 'video_address'},
                {"defaultContent": ""},
                {'data': 'teacher_ids'},
                {'data': 'course.course_price'},
                {'data': 'created_at'},
//                {'data': 'lesson_desc'},
                {"defaultContent": ""},
                {'data': 'is_able'},
                {'data': 'b', "defaultContent": "", 'className': 'td-manager'},
            ],
            "createdRow": function (row, data, dataIndex) {
                //该方法会"遍历"每个新生成的tr
                //此处，可以对生成好的tr、td进行二次优化，改造
                //row:就是生成的tr的dom对象，设置为$(row)就变为jquery对象
                //data:服务器端传递回来的每条 数据记录
                //dataIndex:是tr的下标索引号码
                //$(row).find('td>input:eq(0)').attr('value',data.lesson_id);
                $(row).find('td:eq(0)>input').val(data.lesson_id);
                //设置播放按钮
                var str_play = '<a title="点击播放" onclick="lesson_play(\'播放视频\',\'/admin/lesson/lesson_play/' + data.lesson_id + '\',\'\',510)" style="font-size: 16px; text-decoration: none"><i class="Hui-iconfont">&#xe6e6;</i></a>';
                $(row).find('td:eq(5)').html(str_play);
                //设置查看按钮
                var str_desc = '<a title="点击查看" onclick="lesson_show(\'查看详情\',\'/admin/lesson/lesson_desc_show/' + data.lesson_id + '\',400,540)" style="font-size: 18px; text-decoration: none"><i class="Hui-iconfont">&#xe720;</i></a>';
                $(row).find('td:eq(9)').html(str_desc);
                //① 给最后两列td设置功能按钮
                if (data.is_able == 1) {
                    btn = '<span class="label label-success radius">已启用</span>';
                    str = '<a style="text-decoration:none" onClick="lesson_stop(this,' + data.lesson_id + ')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>';

                } else {
                    btn = '<span class="label label-defaunt radius">已停用</span>';
                    str = '<a style="text-decoration:none" onClick="lesson_start(this,' + data.lesson_id + ')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>';
                }
                str += '&nbsp;<a title="编辑" href="javascript:;" onclick="lesson_edit(\'编辑\',\'/admin/lesson/lesson_edit/' + data.lesson_id + '\',800,510)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>';
                str += '&nbsp;<a title="删除" href="javascript:;" onclick="lesson_del(this,' + data.lesson_id + ')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>';
                //添加启用、停用按钮
                $(row).find('td:eq(10)').html(btn);
                //添加操作按钮
                $(row).find('td:eq(11)').html(str);

                //② 给tr设置class属性
                $(row).addClass('text-c');
                $(row).find('td:eq(11)').css('font-size', '16px');


            },
        });

    });
    /*课时-添加*/
    function lesson_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*课时-播放视频*/
    function lesson_play(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*课时-停用*/
    function lesson_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '/admin/lesson/lesson_toggle/' + id,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {'flag': 0},
                success: function (msg) {
                    if (msg.success === true) {
                        $(obj).parents("tr").find('td:eq(11)').prepend('<a onClick="lesson_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                        $(obj).parents("tr").find('td:eq(10)').html('<span class="label label-default radius">已禁用</span>');
                        $(obj).remove();
                        layer.msg('已停用!', {icon: 5, time: 1000});
                    } else {
                        layer.msg('禁用失败!', {icon: 1, time: 1000});
                    }
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }
    /*课时-启用*/
    function lesson_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '/admin/lesson/lesson_toggle/' + id,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {'flag': 1},
                success: function (msg) {
                    if (msg.success === true) {
                        $(obj).parents("tr").find('td:eq(11)').prepend('<a onClick="lesson_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                        $(obj).parents("tr").find('td:eq(10)').html('<span class="label label-success radius">已启用</span>');
                        $(obj).remove();
                        layer.msg('已启用!', {icon: 6, time: 1000});
                    } else {
                        layer.msg('启用失败!', {icon: 1, time: 1000});
                    }
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }
    /*课时-编辑*/
    function lesson_edit(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*课时-查看*/
    function lesson_show(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-删除*/
    function lesson_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '/admin/lesson/lesson_del/'+id ,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (msg) {
                    if(msg.success){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    }else{
                        layer.msg('删除失败!', {icon: 5, time: 1000});
                    }

                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }
    /*批量删除*/
    function groupDel() {
        layer.confirm('你是真的要删除么？', function () {
            var ids = [];
            $('input:checked').each(function () {
                ids.push($(this).val());
            });
//            console.log(ids);
            if (ids.length == 0) {
                layer.alert('请至少选中一行');
                return;
            }
            $.ajax({
                url: '/admin/lesson/groupDel',
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data:{'ids':ids} ,
                success: function (msg) {
                    if(msg.success){
                        $('input:checked').each(function (obj) {
                            $(obj).parents("tr").remove();
                        });
                        //parent.mydatatable.api().ajax.reload();
                        mydatatable.api().ajax.reload();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    }else{
                        layer.msg('删除失败!', {icon: 5, time: 1000});
                    }
                }
            })
        })
    }

</script>
</body>
</html>
