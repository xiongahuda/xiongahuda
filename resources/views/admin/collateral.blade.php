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
<li class="active">用户管理</li>
<li class="active">用户抵押物审核</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">
<div class="table-responsive">

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
<th>用户id</th>
<th>借款项目id</th>
<th>抵押物名称</th>
<th>状态</th>
<th>抵押时间</th>
<th>操作</th>
</tr>
</thead>
<tbody>
@foreach($collateral as $v)
<tr>
<td class="center">
<label>
<input type="checkbox" class="ace" />
<span class="lbl"></span>
</label>
</td>
<td>{{$v->pa_id}}</td>
<td>{{$v->user_id}}</td>
<td>{{$v->bo_id}}</td>
<td>{{$v->pa_name}}</td>
<td>
	@if($v->status==0)
	未审核
	@elseif($v->status==1)
	审核中
	@elseif($v->status==2)
	审核通过
	@else
	不通过
	@endif
</td>
<td>{{$v->addtime}}</td>
<td><a href="{{url('admin/collateraldetailed?pa_id='.$v->pa_id)}}">进入查看</a></td>
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