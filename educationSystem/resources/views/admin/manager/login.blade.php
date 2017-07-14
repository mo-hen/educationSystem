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
    <link href="/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    {{--<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>--}}
    <title>后台登录 - H-ui.admin v3.0</title>
    <meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value=""/>
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox" style="position: relative;">
            @if(count($errors)>0)
                <div style="height:30px; position: absolute; background-color: pink; top: 10px;width: 100%;opacity: 0.8; text-align: center;" id="warnings" >
                    @foreach ($errors->all() as $error)
                        <span>|&nbsp;{{ $error }}&nbsp;|</span>
                    @endforeach
                </div>
            @endif
        <form class="form form-horizontal" id="log_form" method="post" action="{{url('admin/manager/login')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="username" value="{{old('username')}}" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="password" value="{{old('password')}}" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input id="captcha" name="verify_code" class="input-text size-L" type="text" placeholder="验证码"
                            style="width:150px; font-size: 14px;" >
                    <img id="_captcha" src="{{captcha_src()}}" style="cursor: pointer;" onclick="this.src=this.src+'?'+Math.random();" title="点击换一张" >
                    <a id="kanbuq" onclick="$('#_captcha')[0].src='{{captcha_src()}}'+Math.random();" href="javascript:;">看不清，换一张</a>
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <label for="online">
                        <input type="checkbox" name="online" id="online" value="">
                        使我保持登录状态</label>
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input id="logbtn" type="submit" class="btn btn-success radius size-L"
                           value="&nbsp;登&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L"
                           value="&nbsp;取&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin v3.0</div>

<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript">
    $('#captcha').on('blur',function () {
       if(this.value==''){ this.value='请输入验证码:' }
    });
    $('#captcha').on('focus',function () {
        if(this.value=='请输入验证码:'){ this.value=''; }
    });
    //登陆验证 发送ajax方式
    /*
    $('#log_form').submit(function (evt) {
        evt.preventDefault();
        var info = $(this).serialize();
        $.ajax({
            url:'/admin/manager/login',
            type:'post',
            data:info,
            dataType:'json',
            success:function (msg) {
                if(msg.success===true){
                    window.location.href = '/admin/index/index';
                }else{
                    layer.alert('登录失败', {icon: 5});
                }
            }
        })
    })
    */
</script>
<!--此乃百度统计代码，请自行删除-->
<script>
    /*
     var _hmt = _hmt || [];
     (function() {
     var hm = document.createElement("script");
     hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
     var s = document.getElementsByTagName("script")[0];
     s.parentNode.insertBefore(hm, s);
     })();
     */
</script>
<!--/此乃百度统计代码，请自行删除
</body>
</html>