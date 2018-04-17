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
<li class="active">用户借款审核</li>
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
<th>借款人ID</th>
<th>借款金额</th>
<th>联系手机</th>
<th>还款期限</th>
<th>借款年利率</th>
<th>操作</th>
</tr>
</thead>
<tbody>
@foreach($examine as $v)
<tr>
<td class="center">
<label>
<input type="checkbox" class="ace" />
<span class="lbl"></span>
</label>
</td>
<td>{{$v->id}}</td>
<td>{{$v->jie_id}}</td>
<td>{{$v->money}}</td>
<td>{{$v->phone}}</td>
<td>{{$v->hrange}}</td>
<td>{{$v->bo_rase}}</td>

<td><a href="{{url('admin/examinedetailed?id='.$v->id)}}">进入查看</a></td>
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