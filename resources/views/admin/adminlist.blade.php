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
<li class="active">管理员管理</li>
<li class="active">管理员列表</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">
<div class="table-responsive">
<button><a href="{{url('admin/adminadd')}}">添加管理员</a></button>
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
<th>管理员名称</th>
<th>拥有的角色</th>
<th>头像</th>
<th>是否锁定</th>
<th>操作</th>
</tr>
</thead>
<tbody>
@foreach($adminlist as $v)
<tr>
<td class="center">
<label>
<input type="checkbox" class="ace" />
<span class="lbl"></span>
</label>
</td>
<td>{{$v->id}}</td>
<td>{{$v->username}}</td>
<td><?php if($v->role_name==''){echo '还没有角色';}else{echo $v->role_name;}?></td>
<td></td>
<td><?php if($v->is_lock==1){echo '锁定状态';}else{echo '未锁定';}?></td>
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