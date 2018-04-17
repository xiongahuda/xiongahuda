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
							<li class="active">后台管理控制台</li>
						</ul><!-- .breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								控制台
								<small>
									<i class="icon-double-angle-right"></i>
									 权限不足
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button>
									<i class="icon-ok green"></i>
									欢迎使用
									<strong class="green">
										Simple finance 后台系统
									<small>(v1.2)</small>
									</strong>
									&nbsp;&nbsp;&nbsp;&nbsp;,对不起您没有此权限 请联系管理员.	
							  </div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
@stop