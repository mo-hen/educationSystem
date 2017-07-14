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
    <script type="text/javascript" src="/admin/lib/html5.js"></script>
    <script type="text/javascript" src="/admin/lib/respond.min.js"></script>
    <script type="text/javascript" src="/admin/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>品牌列表</title>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span> 品牌管理
    <span class="c-gray en">&gt;</span> 品牌列表
    <a id="refresh" class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin"
               class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax"
               class="input-text Wdate" style="width:120px;">
        <input type="text" name="" id="name" placeholder=" 品牌名称" style="width:250px" class="input-text">
        <button name="" id="search" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜品牌
        </button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="javascript:;" id="batchDelete" class="btn btn-danger radius">
                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
            </a>
            <a class="btn btn-primary radius" data-title="添加品牌" _href="article-add.html" id="addBrand"
               href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加品牌
            </a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="80">标题</th>
                <th width="80">网址</th>
                <th width="80">描述</th>
                <th width="120">更新时间</th>
                <th width="75">修改时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $table = $('.table-sort').dataTable({
        "lengthMenu": [[2, 10, 25, 50, -1], [2, 10, 25, 50, "All"]],
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "searching": false,
        "processing": true,
        "serverSide": true,
        "createdRow": function (row, data) {
            var $row = $(row);
            $row.find('td:eq(0)').html("<input type='checkbox' name='id' value='" + data.id + "' />");
            $row.find('td:eq(7)').html('<a style="text-decoration:none" class="ml-5" onClick="article_edit(\'资讯编辑\',\'article-add.html\',\'10001\')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,\'10001\')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>');
        },
        "ajax": {
            "url": "/admin/brand",
            "type": "post",
            "data": function (data) {
                // 每页显示在数据在数据量
                data.pageSize = data.length;
                // 当前是那一页
                data.page = data.start >= data.length ? Math.ceil(data.start / data.length) + 1 : 1;
                // 添加laravel在token
                data._token = "{{csrf_token()}}";
                // 开始时间、结束时间、搜索标题
                data.startAt = $('#logmin').val();
                data.endAt = $('#logmax').val();
                data.name = $('#name').val();
            }
        },
        'columns': [
            {'data': 'a', 'defaultContent': ''},
            {'data': 'id'},
            {'data': 'name'},
            {'data': 'site'},
            {'data': 'description'},
            {'data': 'updated_at'},
            {'data': 'created_at'},
            {'data': 'b', 'defaultContent': ''}
        ],
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable": false, "aTargets": [0, 7]}// 不参与排序的列
        ]
    });

    /*品牌-添加*/
    function article_add(title, url, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*品牌-编辑*/
    function article_edit(title, url, id, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*品牌-删除*/
    function article_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }

    $('#search').click(function () {
        $table.api().ajax.reload();// 刷新表格
    });

    $('#batchDelete').click(function () {
        layer.confirm("你是真的要删除吗？", function (i) {
            // 获取已经被选中的input输入框
            var ids = [];
            $('input:checked').each(function () {
                ids.push($(this).val());
            });
            if (ids.length == 0) {
                layer.alert("请选中至少一行。");
                return;
            }
            $.ajax({
                'url': '/admin/brand/delete',
                'type': 'post',
                'dataType': 'json',
                'data': {ids: ids, _token: "{{csrf_token()}}"},
                'success': function (data) {
                    if (data.status) {
                        $table.api().ajax.reload();// 刷新表格
                    } else {
                        layer.alert('删除失败。');
                    }
                }
            });
            layer.close(i);
        });
    });

    $('#addBrand').click(function () {
        layer_show("添加品牌", "/admin/brand/add");
    });
</script>
</body>
</html>