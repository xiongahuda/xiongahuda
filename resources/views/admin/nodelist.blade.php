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
<li class="active">权限管理</li>
<li class="active">权限列表</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">
<div class="table-responsive">
<button><a href="{{url('admin/nodeadd')}}">添加权限</a></button>
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
<th>权限名称</th>
<th>控制器</th>
<th>方法</th>
<th>path路由</th>
<th>操作</th>
</tr>
</thead>
<tbody>
@foreach($nodelist as $v)
<tr>
<td class="center">
<label>
<input type="checkbox" class="ace" />
<span class="lbl"></span>
</label>
</td>
<td>{{$v->id}}</td>
<td>{{$v->node_name}}</td>
<td>{{$v->controller}}</td>
<td>{{$v->action}}</td>
<td>{{$v->path}}</td>
<td><a href="#" class="delete">删除</a></td>
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