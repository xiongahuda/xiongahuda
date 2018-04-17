<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class BorrowController extends Controller
{
    //抵押物页面
    public function index(Request $request){
        if($request->isMethod('POST')){
            $file = $request->file('img');
            //文件是否上传成功
            if($file->isValid()){   //判断文件是否上传成功
                $entension = $file -> getClientOriginalExtension(); //文件的后缀名
                $fileName = date('YmdHis').mt_rand(100,999).'.'.$entension;//文件的名字
                $file->move(public_path().'/uploads',$fileName);  //将文件移动到对应的目录
                
                $data['pa_name'] = $request->input('pa_name');
                //$userInfo = $request->session()->get('userInfo');//获得sesion中用户的数据
                //$data['user_id'] = $userInfo['id'];
                $data['user_id'] = 1;
                $data['pa_img'] = public_path().'/uploads'.$fileName;
                $data['addtime'] = time();
  
                $id = DB::table('pawn')->insert($data);
                if($id){
                    echo '<script>alert("抵押物信息已经提交，审核时间为1-2个工作日...");location.href="http://www.demo.com/easy/public/reception/me";</script>';
                }
            }else{
                echo  '上传错误';
            }
                    
        }else{
            return view('reception.borrow.borrow');die;
            //判断是否存在抵押物通审核
            //$userInfo = $request->session()->get('userInfo');//获得sesion中用户的数据
            //$user_id = $userInfo['id'];
            $user_id= 1;
            $data  = DB::table('pawn')->where(['user_id'=>$user_id])->orderBy('pa_id','desc')->limit(1)->first();
            if($data){
                $data = $this->obj2arr($data);
                if($data['bo_id']!=0){
                    return view('reception.borrow.borrow');//跳转到抵押物页面
                }
                if($data['status'] == 0){
                    echo '<script>alert("抵押物信息已经提交，审核时间为1-2个工作日...");</script>';
                    return view('reception.borrow.borrow');//跳转到抵押物页面
                }else if($data['status'] == 1){
                    echo '<script>alert("正在审核中，请耐心等待");</script>';
                    return view('reception.borrow.borrow');//跳转到抵押物页面
                }else if($data['status'] == 3){
                    echo '<script>alert("审核未通过，请重新填写抵押物信息..");</script>';
                    return view('reception.borrow.borrow');//跳转到抵押物页面
                }else{
                    return view('reception.borrow.borrow_money');//跳转到借款页面
                }
            }else{
                return view('reception.borrow.borrow');//跳转到抵押物页面
            }
            
        }    
    	
    }

    function obj2arr ($obj){
        return json_decode(json_encode($obj),true);
    }



  
}
