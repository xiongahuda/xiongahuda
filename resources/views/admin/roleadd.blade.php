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
<li class="active">角色管理</li>
<li class="active">添加角色</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">

<div class="space-4"></div>
<form class="form-horizontal" role="form" method="post" action="{{url('admin/roleadd_do')}}">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 角色名称 </label>
<div class="col-sm-9">
<input type="text" id="form-field-2" name="role_name" class="col-xs-10 col-sm-5" />
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 角色描述 </label>
<div class="col-sm-9">
	<input type="text" name="desc" id="">
</div>
</div>



<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 分配权限 </label>
<div class="col-sm-9">
<table>
@foreach($nodelist as $val)
	<tr>
		<td><input type="checkbox" class="node quan" name="rolenode[]" id="{{$val['id']}}" value="{{$val['id']}}">{{$val['node_name']}}</td>

		@foreach($val['son'] as $v)
		<td><input type="checkbox" class="nodep quan" name="rolenode[]" pid="{{$v['parent_id']}}" value="{{$v['id']}}">{{$v['node_name']}}</td>
		@endforeach

	</tr>
@endforeach
</table>
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2">  </label>
<div class="col-sm-9">
<input type="button" name="" id="ok" value="全选">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<input type="button" name="" id="no" value="全不选">
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
		$('.node').click(function(){$(this).parent().siblings().find('.nodep').prop("checked",$(this).prop('checked'))})
		$('#ok').click(function(){$('.quan').prop('checked','true')})
		$('#no').click(function(){$('.quan').removeAttr('checked')})
		$('.nodep').click(function(){$(this).parent().siblings().find('.node').prop("checked",$(this).prop('checked'))})
	})
</script>
@stop
