<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
use Symfony\Component\HttpFoundation\Session\Session;
class CommonController extends Controller
{
	protected $session;

	public function __construct(){
		$sess = new Session();
		$this->session = $sess;
	}
	//$url= \Route::current()->getActionName();//获取到当前控制器/方法


	public function p($val){
		echo '<pre>';
		print_r($val);
		die;
	}


	public function getArray($val){  //获取数组
		return json_decode(json_encode($val), true);
	}
}