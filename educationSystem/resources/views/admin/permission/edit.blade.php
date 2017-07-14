<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
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
    <title>角色列表</title>
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-permission-edit">
        {{ csrf_field() }}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{$permission->ps_name}}" class="input-text" id="ps_name" name="ps_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">上级：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width:150px;">
                    <select class="select" name="ps_pid">
                        <option value="0">-请选择-</option>
                        @foreach($permissionA as $k => $v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">控制器：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$permission->ps_c}}"  id="ps_c" name="ps_c">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">操作方法：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$permission->ps_a}}" id="ps_a" name="ps_a">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">路由：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$permission->address}}" id="address" name="address">
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function () {

        //form表单提交数据存储
        $('#form-permission-edit').submit(function (evt) {
            //ajax方式提交form表单信息给服务器
            evt.preventDefault(); //阻止浏览器form表单提交
            //收集form表单的信息为 username=xxx&password=xxx&mg_email=xxx...
            var data = $(this).serialize();
            //执行ajax
            $.ajax({
                url:'/admin/permission/edit/{{$permission->ps_id}}',
                data:data,
                dataType:'json',
                type:'post',
                success:function(msg){
                    //alert(msg);  //{'success':true/false}
                    if(msg.success === true){
                        //a提示成功信息、b关闭当前的添加页、c父级列表页刷新
                        layer.alert('修改成功', function(){
                            parent.window.location.href = parent.window.location.href; //父页面刷新
                            layer_close();  //关闭当前添加页
                        });
                    }else{
                        //a提示失败信息
                        layer.alert('修改失败【'+msg.errorinfo+'】', {icon: 5});  //icon:1/2/3/4/5  设置表情
                    }
                }
            });
        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>