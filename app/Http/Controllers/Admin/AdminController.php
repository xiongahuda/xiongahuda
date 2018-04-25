<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Session\Session;
class AdminController extends CommonController

{

    public function getadmin(){ //验证session
        $value = $this->session->get('admin');
        if($value){
            echo 1;die;
        }else{
            echo 2;die;
        }

    }

    public function verification(Request $request){
        $input = $request->input();
        $admin_name = $input['admin_name'];
        $result = DB::table('admin')->where('admin_name',$admin_name)->select('admin_name','id')->first();
        //$ip = $request->getClientIp();
        if($result){
            $this->session->set('admin',$result->id);
            $arr = ['err'=>1,'mes'=>'身份确认'];
        }else{
            $arr = ['err'=>0,'mes'=>'账号不存在'];
        }
        echo json_encode($arr);
    }

    public function loginout(){
        $this->session->set('admin','');
        echo "<script>location.href='htttp://www.baidu.com'</script>";
    }
}