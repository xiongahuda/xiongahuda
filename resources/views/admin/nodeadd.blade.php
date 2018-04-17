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
<li class="active">权限管理</li>
<li class="active">添加权限</li>
</ul><!-- .breadcrumb -->
</div>
<div class="page-content">
<div class="row">
<div class="col-xs-12">

<div class="space-4"></div>
<form class="form-horizontal" role="form" method="post" action="{{url('admin/nodeadd_do')}}">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 权限名称 </label>
<div class="col-sm-9">
<input type="text" id="form-field-2"  class="col-xs-10 col-sm-5" />
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Controller </label>
<div class="col-sm-9">
<input type="text" id="form-field-2"  class="col-xs-10 col-sm-5" />
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Action </label>
<div class="col-sm-9">
<input type="text" id="form-field-2"  class="col-xs-10 col-sm-5" />
</div>
</div>

<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Path路由 </label>
<div class="col-sm-9">
<input type="text" id="form-field-2"  class="col-xs-10 col-sm-5" />
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
@stop