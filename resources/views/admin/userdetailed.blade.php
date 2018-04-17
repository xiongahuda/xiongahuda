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
<li class="active">用户详细信息</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">

<div class="space-4"></div>
<form class="form-horizontal" role="form" method="post">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 用户昵称 </label>
<div class="col-sm-9">
{{$user->nickname}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 头像 </label>
<div class="col-sm-9">
@if($user->face)
<img src="{{$user->face}}" class="header" alt="">
@else
<img src="{{asset('admin/img/header.jpg')}}" class="header" alt="">
@endif
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

@if($if==0)
<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> <font color="red">该用户未实名认证</font> </label>
<div class="col-sm-9">
</div>
</div>
@else
<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 真实姓名 </label>
<div class="col-sm-9">
{{$rea->name}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 身份证号 </label>
<div class="col-sm-9">
{{$rea->idcard}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 第三方支付账号 </label>
<div class="col-sm-9">
{{$rea->three_number}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 性别 </label>
<div class="col-sm-9">
{{$rea->sex}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 籍贯 </label>
<div class="col-sm-9">
{{$rea->old_city}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 现住址 </label>
<div class="col-sm-9">
{{$rea->now_city}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 家庭电话 </label>
<div class="col-sm-9">
{{$rea->mobile}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 工作年限 </label>
<div class="col-sm-9">
{{$rea->work_year}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 职业 </label>
<div class="col-sm-9">
{{$rea->profession}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 月收入 </label>
<div class="col-sm-9">
{{$rea->month_money}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 房贷 </label>
<div class="col-sm-9">
{{$rea->house_loan}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 身份证正面 </label>
<div class="col-sm-9">
{{$rea->card_face}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 身份证反面 </label>
<div class="col-sm-9">
{{$rea->card_back}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 工作证明 </label>
<div class="col-sm-9">
<img src="{{$rea->work_card}}" alt="">
</div>
</div>
@endif

<div class="space-4"></div>
<div class="hr hr-24"></div>
<div class="clearfix form-actions">
<div class="col-md-offset-3 col-md-9">
<input type="button" class="btn btn-info is_lock" id="{{$user->id}}" acc="{{$user->is_lock}}" value="锁定此账号">
<!-- <button class="btn btn-info" type="button">
<i class="icon-ok bigger-110"></i>
确认
</button> -->
&nbsp; &nbsp; &nbsp;
<!-- <button class="btn" type="reset">
<i class="icon-undo bigger-110"></i>
重置
</button> -->
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
		$('.is_lock').click(function(){
			if(confirm('确认要执行此操作？')){
				var id = $(this).attr('id');
				var is_lock = $(this).attr('acc');
				var obj = $(this);
				if(is_lock==1){
					is_lock = 0;
				}else{
					is_lock = 1;
				}
				$.ajax({
					url:"{{url('admin/userlock')}}",
					data:{"id":id,"is_lock":is_lock},
					success:function(res){
						if(res==1){
							if(is_lock==1){
								obj.attr('acc',is_lock)
								obj.val('解锁此账户')
								$('.user_islock').html('此账户已锁定')
							}else{
								obj.attr('acc',is_lock)
								obj.val('锁定此账户')
								$('.user_islock').html('未锁定')
							}
							alert('操作成功')
						}else{
							alert('网络延迟 请稍后操作')
						}
					}
				})
			}
		})
	})
</script>
@stop