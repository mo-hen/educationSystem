<!--_meta 作为公共模版分离出去-->
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
    <link rel="stylesheet" type="text/css" href="/uploadify/uploadify.css">
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script src="/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title>添加用户 - H-ui.admin v3.0</title>
    <meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-lesson-add">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$lesson->lesson_name}}" id="lesson_name" name="lesson_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>对应课程：</label>
            <div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
				<select class="select" size="1" name="course_id">
					<option value="">--请选择对应课程--</option>
                    @foreach($course as $k => $v)
                        @if($lesson->course_id === $k)
                            <option value="{{$k}}" selected="selected">{{$v}}</option>
                        @else
                            <option value="{{$k}}">{{$v}}</option>
                        @endif
                    @endforeach
				</select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input type="radio" value="1" name="is_able" @if($lesson->is_able==1)checked="checked" @endif >
                    <label for="lesson_start">启用</label>
                </div>
                <div class="radio-box">
                    <input type="radio" value="0" name="is_able" @if($lesson->is_able==0)checked="checked" @endif >
                    <label for="lesson_stop">停用</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>讲师：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="teacher_ids" name="teacher_ids">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">时长：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{$lesson->lesson_duration}}" class="input-text" placeholder="分钟" name="lesson_duration" id="lesson_duration">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">视频：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" multiple name="lesson_video" id="lesson_video" class="input-file">
                <input class="input-text upload-url" type="text" name="video_address" readonly value="{{ $lesson->video_address }}"
                       nullmsg="请添加视频！" style="width:500px">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">封面图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="cover_pic" id="cover_pic" class="input-text">
                <p><img id="show_pic" src="" alt="头像" style="display: none;" width="150" height="100"/></p>
                <input class="input-text upload-url" type="text" name="cover_img" readonly value="{{ $lesson->cover_img }}"
                       nullmsg="请添加封面！" style="width:500px;">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">课程简介：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="beizhu" cols="" rows="" class="textarea" placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)">
                    {{$lesson->lesson_desc}}
                </textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
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
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function () {
        //上传视频
        $('#lesson_video').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                '_token': '{{csrf_token()}}'
            },
            'swf': '/uploadify/uploadify.swf',
            //服务器端处理上传附件的地址
            'uploader': '{{ url("admin/lesson/up_video") }}',
            //上传成功回调函数处理
            'onUploadSuccess': function (file, data, response) {
                //response:true/false
                //file上传附件名字
                //data:接收服务器端返回的信息
                //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                var obj = JSON.parse(data);
                if (obj.success === true) {
                    //显示上传好附件
                    //把附件的名字赋予给当前form表单input框mg_pic
                    $('[name=video_address]').val(obj.filename);
                }
            }
        });
        //上传图片
        $('#cover_pic').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                '_token': '{{csrf_token()}}'
            },
            'swf': '/uploadify/uploadify.swf',
            'uploader': '{{ url("admin/lesson/up_pic") }}',
            'onUploadSuccess': function (file, data, response) {
                var obj = JSON.parse(data);
                if (obj.success === true) {
                    $('#show_pic').css('display','block');
                    $('#show_pic').attr('src', obj.filename);
                    $('[name=cover_img]').val(obj.filename);
                }
            }
        });

        //修改课时
        //添加表单提交动作
        $('#form-lesson-add').submit(function(evt){
            //阻止浏览器自己的submit
            evt.preventDefault();
            //收集form表单信息为字符串：name=xx&title=xx&email=xx
            var data = $(this).serialize();
            //ajax提交
            $.ajax({
                url:'{{url("admin/lesson/lesson_edit")}}'+'/'+'{{$lesson->lesson_id}}',
                data:data,
                dataType:'json',
                type:'post',
                success:function(msg){
                    if(msg.success===true){
                        layer.alert('修改课时成功', function(index){
                            //刷新父页面,即刷新datatable
                            parent.mydatatable.api().ajax.reload();
                            layer_close();//关闭当前弹出层
                        });
                    }else{
                        layer.alert('修改课时失败【'+msg.errorinfo+'】',{icon:5});
                    }
                }
            });
        });

         $('.skin-minimal input').iCheck({
             checkboxClass: 'icheckbox-blue',
             radioClass: 'iradio-blue',
             increaseArea: '20%'
         });

         $("#form-member-add").validate({
             rules: {
                 lesson_name: {
                 required: true,
                 minlength: 2,
                 maxlength: 16
             },
         },
         onkeyup: false,
         focusCleanup: true,
         success: "valid",
         submitHandler: function (form) {
            //$(form).ajaxSubmit();
            var index = parent.layer.getFrameIndex(window.name);
            //parent.$('.btn-refresh').click();
            parent.layer.close(index);
         }
         });

    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>