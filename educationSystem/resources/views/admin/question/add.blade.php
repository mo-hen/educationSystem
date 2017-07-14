@extends('admin/template/layout')

@section('title','添加试题 - 试题管理 - H-ui.admin v2.4')

@section('content')

<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<article class="page-container">
	<form class="form form-horizontal" id="form-question-add">
		{{ csrf_field() }}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>试题名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" id="qs_name" name="qs_name">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">分数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="number" class="input-text"   id="qs_score" name="qs_score">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">类型：</label>
			<div class="formControls col-xs-8 col-sm-9" id="leixing">
				单选&nbsp;&nbsp;<input type="radio" value="单选" id="qs_type1" name="qs_type" checked="checked">
				多选&nbsp;&nbsp;<input type="radio" value="多选" id="qs_type2" name="qs_type">
			</div>
		</div>
		<div class="row cl" id="daan">
			<label class="form-label col-xs-4 col-sm-3">正确答案：</label>
			<div class="formControls col-xs-8 col-sm-9">
				A：<input type="radio" name="qs_answer[]" value="1" />&nbsp;&nbsp;
				B：<input type="radio" name="qs_answer[]" value="2" />&nbsp;&nbsp;
				C：<input type="radio" name="qs_answer[]" value="4" />&nbsp;&nbsp;
				D：<input type="radio" name="qs_answer[]" value="8" />&nbsp;&nbsp;
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">选项A：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"   id="option_a" name="option_a">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">选项B：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"   id="option_b" name="option_b">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">选项C：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"   id="option_c" name="option_c">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">选项D：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"   id="option_d" name="option_d">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"   id="qs_remark" name="qs_remark">
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
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	//单选、多选切换
    $('#leixing input').click(function(){
        //多选类型答案设置
		/*
		 <label class="form-label col-xs-4 col-sm-3">正确答案：</label>
		 <div class="formControls col-xs-8 col-sm-9">
		 A:<input type="checkbox" name="qs_answer[]" value="1" />&nbsp;&nbsp;
		 B:<input type="checkbox" name="qs_answer[]" value="2" />&nbsp;&nbsp;
		 C:<input type="checkbox" name="qs_answer[]" value="4" />&nbsp;&nbsp;
		 D:<input type="checkbox" name="qs_answer[]" value="8" />&nbsp;&nbsp;
		 </div>*/
        var duo_answer = '<label class="form-label col-xs-4 col-sm-3">正确答案：</label> ' +
            '<div class="formControls col-xs-8 col-sm-9"> ' +
            'A：<input type="checkbox" name="qs_answer[]" value="1" />&nbsp;&nbsp; ' +
            'B：<input type="checkbox" name="qs_answer[]" value="2" />&nbsp;&nbsp; ' +
            'C：<input type="checkbox" name="qs_answer[]" value="4" />&nbsp;&nbsp; ' +
            'D：<input type="checkbox" name="qs_answer[]" value="8" />&nbsp;&nbsp; ' +
            '</div>';

        //单选类型答案设置
		/*
		 <label class="form-label col-xs-4 col-sm-3">正确答案：</label>
		 <div class="formControls col-xs-8 col-sm-9">
		 A:<input type="radio" name="qs_answer[]" value="1" />&nbsp;&nbsp;
		 B:<input type="radio" name="qs_answer[]" value="2" />&nbsp;&nbsp;
		 C:<input type="radio" name="qs_answer[]" value="4" />&nbsp;&nbsp;
		 D:<input type="radio" name="qs_answer[]" value="8" />&nbsp;&nbsp;
		 </div>
		 * */
        var dan_answer = '<label class="form-label col-xs-4 col-sm-3">正确答案：</label> ' +
            '<div class="formControls col-xs-8 col-sm-9"> ' +
            'A：<input type="radio" name="qs_answer[]" value="1" />&nbsp;&nbsp; ' +
            'B：<input type="radio" name="qs_answer[]" value="2" />&nbsp;&nbsp; ' +
            'C：<input type="radio" name="qs_answer[]" value="4" />&nbsp;&nbsp; ' +
            'D：<input type="radio" name="qs_answer[]" value="8" />&nbsp;&nbsp; ' +
            '</div>';

        if($(this).val()=='单选'){
            $('#daan').html(dan_answer);
        }else{
            $('#daan').html(duo_answer);
        }
    });
	//给添加form表单设置submit事件
	$('#form-question-add').submit(function(evt){
	    //ajax方式提交form表单信息给服务器
		evt.preventDefault(); //阻止浏览器form表单提交
		//收集form表单的信息为 username=xxx&password=xxx&mg_email=xxx...
		var data = $(this).serialize();
		//执行ajax
		$.ajax({
			url:'/admin/question/add/'+'{{$paper->paper_id}}',
			data:data,
			dataType:'json',
			type:'post',
			success:function(msg){
			    //alert(msg);  //{'success':true/false}
				if(msg.success === true){
					//a提示成功信息、b关闭当前的添加页、c父级列表页刷新
                    layer.alert('添加成功', function(){
                        parent.window.location.href = parent.window.location.href; //父页面刷新
                        layer_close();  //关闭当前添加页
					});
                }else{
					//a提示失败信息
                    layer.alert('添加失败【'+msg.errorinfo+'】', {icon: 5});  //icon:1/2/3/4/5  设置表情
                }
			}
		});
	});

});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
@endsection