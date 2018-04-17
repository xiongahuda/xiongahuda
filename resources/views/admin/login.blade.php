<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Login</title>

<!-- Bootstrap Core CSS -->
<link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />

<!-- MetisMenu CSS -->
<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{asset('admin/css//sb-admin-2.css')}}" rel="stylesheet">

<!-- Custom Fonts -->
<link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}" />


</head>

<body>

<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="login-panel panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">简易金融后台管理系统</h3>
</div>
<div class="panel-body">
<form role="form" action="{{url('admin/login_do')}}" method="post">
<fieldset>
<div class="form-group">
<input class="form-control" placeholder="大名" name="username">
</div>
<div class="form-group">
<input class="form-control" placeholder="密码" name="password" type="password" value="">
</div>
<div class="form-group">
<input class="form-control" placeholder="验证码" name="captcha" type="text" value="">
</div>
<div class="form-group">
<img src="{{url('admin/createCaptca')}}" alt="刷新验证码" class="captchaimg">
<a href="javascript:;" class="captcha">看不清，换一张</a>
</div>
<!-- Change this to a button or input when using this as a form -->
<input type="submit" class="btn btn-lg btn-success btn-block" value="登录" />
<div style="text-align:right;">
</div>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="{{asset('admin/js/hu.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('.captcha').click(function(){
            window.location.reload()
            // var url = "{{url('admin/createCaptca/')}}";
            // url = url+'/'+Math.random();
            // $('.captchaimg').attr('src',url);
            
        })
    })
</script>