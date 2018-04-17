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
<li class="active">用户管理</li>
<li class="active">用户借款审核</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12 boxdiv">

<div class="space-4"></div>
<form class="form-horizontal" role="form" method="post">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 用户真实姓名 </label>
<div class="col-sm-9">
{{$v->name}}
</div>
</div>


<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 邮箱 </label>
<div class="col-sm-9">
{{$user->email}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 手机号 </label>
<div class="col-sm-9">
{{$user->phone}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 状态 </label>
<div class="col-sm-9">
<span class="user_islock">
@if($user->is_lock==0)
未锁定
@else
账号已被锁定
@endif
</span>

</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 注册时间 </label>
<div class="col-sm-9">
{{$user->create_at}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 上次登录时间 </label>
<div class="col-sm-9">
{{$user->last_time}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> vip </label>
<div class="col-sm-9">
@if($user->vip==0)
该用户未开通vip
@else
V{{$user->vip}}
@endif
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 用户实名认证信息 </label>
<div class="col-sm-9">
</div>
</div>


<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 身份证号 </label>
<div class="col-sm-9">
{{$v->idcard}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 第三方支付账号 </label>
<div class="col-sm-9">
{{$v->three_number}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 性别 </label>
<div class="col-sm-9">
{{$v->sex}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 籍贯 </label>
<div class="col-sm-9">
{{$v->old_city}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 现住址 </label>
<div class="col-sm-9">
{{$v->now_city}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 家庭电话 </label>
<div class="col-sm-9">
{{$v->mobile}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 工作年限 </label>
<div class="col-sm-9">
{{$v->work_year}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 职业 </label>
<div class="col-sm-9">
{{$v->profession}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 月收入 </label>
<div class="col-sm-9">
{{$v->month_money}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 房贷 </label>
<div class="col-sm-9">
{{$v->house_loan}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 身份证正面 </label>
<div class="col-sm-9">
{{$v->card_face}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 身份证反面 </label>
<div class="col-sm-9">
{{$v->card_back}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 工作证明 </label>
<div class="col-sm-9">
<img src="{{$v->work_card}}" alt="">
</div>
</div>



<div class="space-4"></div>
<div class="hr hr-24"></div>
<div class="clearfix form-actions">
<div class="col-md-offset-3 col-md-9">
<input type="button" class="btn btn-info adopt" updateid='2' value="通过">
<input type="button" class="btn btn-info pass" updateid='3' value="不通过">

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
		
	})
</script>
@stop