<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
class LoginController extends Controller
{
	public function index(){ //登陆	
			return view('admin.login');	
	}

	public function login(Request $request){
		$data = $request->input();
		//$captcha = Session::get('captcha');
		//echo $captcha;die;
		//if($captcha!=$data['captcha']){
			//echo "<script>alert('验证码有误');location.href='login'</script>";
		//}else{
			$res = DB::table('admin')->where('username',$data['username'])->first();
			if($res->is_lock==0){
				if($res){
					if($res->password==md5($data['password'])){
						unset($res->password);
						session(['admin'=>$res]);
						return redirect('admin/index');
					}else{
						echo "<script>alert('密码错误');location.href='login'</script>";
					}
				}else{
					echo "<script>alert('用户名错误');location.href='login'</script>";
				}
			}else{
				echo "<script>alert('此管理员已被锁定！请联系管理员');location.href='login'</script>";
			}
		//}	
	}

	public function createCaptca() //生成验证码
	{
		//生成验证码图片的Builder对象，配置相应属性
		$builder = new CaptchaBuilder;
		//可以设置图片宽高及字体
		$builder->build($width = 130, $height = 60, $font = null);
		//获取验证码的内容
		$phrase = $builder->getPhrase();
		//Session::put('captcha',$phrase);
		//echo Session::get('captcha');die;
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-Type: image/jpeg');
		$builder->output();
	}

	public function out(){
		echo "<script>location.href='http://www.baidu.com'</script>";
	}
}