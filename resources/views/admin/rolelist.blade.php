@extends('header')
@section('content')
<div class="main-content">
<div class="breadcrumbs" id="breadcrumbs">
<script type="text/javascript">
try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
</script>
<ul class="breadcrumb">
<li>
<i class="icon-home home-icon"></i>
<a href="{{url('admin/index')}}">首页</a>
</li>
<li class="active">角色管理</li>
<li class="active">角色列表</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">
<div class="table-responsive">
<button><a href="{{url('admin/roleadd')}}">添加角色</a></button>
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="center">
<label>
<input type="checkbox" class="ace" />
<span class="lbl"></span>
</label>
</th>
<th>编号</th>
<th>角色名称</th>
<th>角色描述</th>
<th>角色权限</th>
<th>操作</th>
</tr>
</thead>
<tbody>
@foreach($rolelist as $v)
<tr>
<td class="center">
<label>
<input type="checkbox" class="ace" />
<span class="lbl"></span>
</label>
</td>
<td>{{$v->id}}</td>
<td>{{$v->role_name}}</td>
<td>{{$v->role_desc}}</td>
<td>{{$v->node_name}}</td>
<td><a href="#" class="delete">删除</a>&nbsp;&nbsp;&nbsp;<a href="#" class="delete">修改</a></td>
</tr>
@endforeach
</tbody>
</table>
</div><!-- /.table-responsive -->
</div><!-- /span -->
</div><!-- /row -->
</div><!-- /.page-content -->
</div><!-- /.main-content -->
@stop