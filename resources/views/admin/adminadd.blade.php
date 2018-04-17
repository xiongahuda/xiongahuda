@extends('header')
@section('content')
<div class="main-content">
<div class="breadcrumbs" id="breadcrumbs">
<script type="text/javascript">
try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
</script>
<ul class="breadcrumb">
<li>
<li class="active"><a href="{{url('admin/index')}}">首页</a></li>
<li class="active">管理员管理</li>
<li class="active">添加管理员</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">

<div class="space-4"></div>
<form class="form-horizontal" class="formadd" role="form" method="post" action="{{url('admin/adminadd_do')}}">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 管理员名称 </label>
<div class="col-sm-9">
<input type="text" id="form-field-2" name="username" class="col-xs-10 col-sm-5" />
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 密码 </label>
<div class="col-sm-9">
	<input type="password" name="password" id="one">
	<span id="onepwd"></span>
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 确认密码 </label>
<div class="col-sm-9">
	<input type="password" name="passwordok" id="two">
	<span id="twopwd"></span>
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 角色分配 </label>
<div class="col-sm-9">
<table>
	@foreach($rolelist as $v)
	<tr>
		<td><input type="checkbox" name="role_id[]" value="{{$v->id}}"></td><td>{{$v->role_name}}</td>
		<td>角色描述:</td> <td>{{$v->role_desc}}</td>
		<td>角色拥有权限:</td> <td>{{$v->node_name}}</td>
	</tr>
	@endforeach
	</table>
</div>
</div>



<div class="space-4"></div>
<div class="hr hr-24"></div>
<div class="clearfix form-actions">
<div class="col-md-offset-3 col-md-9">
<input type="submit" class="btn btn-info" value="确认">
<!-- <button class="btn btn-info" type="button">
<i class="icon-ok bigger-110"></i>
确认
</button> -->
&nbsp; &nbsp; &nbsp;
<button class="btn" type="reset">
<i class="icon-undo bigger-110"></i>
重置
</button>
<!-- <input type="reset" value="重置"> -->
</div>
</div>
</form>
</div><!-- /span -->
</div><!-- /row -->
</div><!-- /.page-content -->
</div><!-- /.main-content -->
<script type="text/javascript" src="{{asset('admin/js/hu.js')}}"></script>
<script type="text/javascript">
	$(function(){
		$('#one').blur(function(){var one = $(this).val();if(one==''){$('#onepwd').html('不能为空').css('color','red');}else{$('#onepwd').html('√').css('color','green');}})
		$('#two').blur(function(){var two = $(this).val();if(two==''){$('#twopwd').html('不能为空').css('color','red');}else{var one = $('#one').val();if(two==one){$('#twopwd').html('√').css('color','green');}else{$('#twopwd').html('两次密码不一致').css('color','red');}}})
	})
</script>
@stop
