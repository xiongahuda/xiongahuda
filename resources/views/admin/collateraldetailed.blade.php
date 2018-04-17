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
<li class="active">用户抵押物审核</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12 boxdiv">

<div class="space-4"></div>
<form class="form-horizontal" role="form" method="post">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 抵押物名称 </label>
<div class="col-sm-9">
<input type="text" value="{{$collateraldetailed->pa_name}}" class="col-xs-10 col-sm-5" disabled/>
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 抵押物图片 </label>
<div class="col-sm-9">
	<img src="{{asset($collateraldetailed->pa_img)}}" alt="" class="header">
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 抵押时间 </label>
<div class="col-sm-9">
	{{$collateraldetailed->addtime}}
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 状态 </label>
<div class="col-sm-9 pawnstatus">
<font color="red">
@if($collateraldetailed->status==0)
未审核
@elseif($collateraldetailed->status==1)
审核中
@elseif($collateraldetailed->status==2)
审核通过
@else
未通过
@endif
</font>
</div>
</div>

@if($collateraldetailed->status==1 || $collateraldetailed->status==2)
<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 抵押物价值 </label>
<div class="col-sm-9">
@if($collateraldetailed->status==2)
<input type="text" class="col-xs-10 col-sm-5 pawn_price" disabled value="{{$collateraldetailed->money}}" />
@else
<input type="text" class="col-xs-10 col-sm-5 pawn_price"/>
@endif
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 抵押物可借款上限 </label>
<div class="col-sm-9">
@if($collateraldetailed->status==2)
	<input type="text" class="col-xs-10 col-sm-5 pawn_money" disabled value="{{$collateraldetailed->w_money}}" />
@else
<input type="text" class="col-xs-10 col-sm-5 pawn_money" disabled />
@endif
</div>
</div>
@endif


<div class="space-4 zuihou"></div>
<div class="hr hr-24"></div>
<div class="clearfix form-actions">
<div class="col-md-offset-3 col-md-9">
<input type="button" class="btn btn-info start_inspect" updateid='1' value="开始审核">
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
		$('.start_inspect').click(function(){  //开始审核
			var status = "{{$collateraldetailed->status}}";
			if(status!=0){
				alert('已被审核')
				return false
			}else{
				var updateid = $(this).attr('updateid');
				var data = {
					"pa_id":"{{$collateraldetailed->pa_id}}",
					"updateid":updateid
				};
				ajax(data,"{{url('admin/cauditexecution')}}");
				var str = '';
				str+='<div class="space-4"></div><div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-2">抵押物价值 </label>';
				str+='<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5 pawn_price" /></div></div><div class="space-4"></div>';
				str+='<div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 抵押物可借款上限 </label>';
 				str+='<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5 pawn_money" disabled/></div></div>';
 				$('.zuihou').before(str);
			}
		})

		$('.pass').click(function(){  //不通过
			if(confirm('确定此操作：此抵押物不通过审核')){
			var status = "{{$collateraldetailed->status}}";
			if(status==1){
				var updateid = $(this).attr('updateid');
				var data = {
					"pa_id":"{{$collateraldetailed->pa_id}}",
					"updateid":updateid
				};
				ajax(data,"{{url('admin/cauditexecution')}}");
			}else{
				alert('已被审核')
				return false;
				
			}
			}
		})

		$('.adopt').click(function(){  //通过
			if(confirm('确认此操作：此抵押物通过审核')){


			var status = "{{$collateraldetailed->status}}";
			var obj = $(this);
			if(status==1){
				var money = $('.pawn_price').val();
				if(money==''){
					alert('抵押价钱不能为空')
					return false;
				}else{

					var updateid = obj.attr('updateid');
					var pawn_money = $('.pawn_money').val();
					var data = {
						"pa_id":"{{$collateraldetailed->pa_id}}",
						"updateid":updateid,
						"pawn_price":money,
						"pawn_money":pawn_money
					}

					$('.pawn_price').prop('disabled','true');
					ajax(data,"{{url('admin/cauditexecution')}}");
				}
			
			}else{
				alert('请先开始审核')
				return false;
			}
		}
			
		})

		$(document).on('keyup','.pawn_price',function(){
			var money = $(this).val();
			if(money!=''){
				$('.pawn_money').val(parseInt(money)*0.7);
			}else{
				$('.pawn_money').val('');
			}
			
		})

		function ajax(data,url){  //ajax发送请求
			$.ajax({
				url:url,
				type:"post",
				data:data,
				dataType:'json',
				success:function(res){
					if(res.mes==0){
						alert('网络延迟 请稍后操作')
					}else{
						if(res.status==1){
							$('.pawnstatus').html("<font color='red'>审核中<font>");
						}else if(res.status==2){
							$('.pawnstatus').html("<font color='red'>审核通过<font>");
						}else{
							$('.pawnstatus').html("<font color='red'>不通过<font>");
						}
					}
				}
			})
		}
	})
</script>
@stop
