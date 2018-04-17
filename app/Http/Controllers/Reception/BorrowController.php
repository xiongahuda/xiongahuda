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
                //$data['user_id'] = $this->getUserid;
                $data['user_id'] = 1;
                $data['pa_img'] = public_path().'/uploads'.$fileName;
                $data['addtime'] = time();
  
                $id = DB::table('pawn')->insert($data);
                if($id){
                    echo '<script>alert("抵押物信息已经提交，审核时间为1-2个工作日...");location.href="http://www.demo.com/easy/public/reception/member_info";</script>';
                }
            }else{
                echo  '上传错误';
            }
                    
        }else{        
            //判断是否存在抵押物通审核
            //$user_id = $this->getUserid();
            $user_id= 1;
            $data  = DB::table('pawn')->where(['user_id'=>$user_id])->orderBy('pa_id','desc')->limit(1)->first();
            if($data){
                $data = $this->obj2arr($data);
                if($data['bo_id']!=0){
                    return view('reception.borrow');//跳转到抵押物页面
                }
                if($data['status'] == 0){
                    echo '<script>alert("抵押物信息已经提交，审核时间为1-2个工作日...");</script>';
                    return view('reception.member_info');//跳转到抵押物页面
                }else if($data['status'] == 1){
                    echo '<script>alert("正在审核中，请耐心等待");</script>';
                    return view('reception.member_info');//跳转到抵押物页面
                }else if($data['status'] == 3){
                    echo '<script>alert("审核未通过，请重新填写抵押物信息..");</script>';
                    return view('reception.borrow');//跳转到抵押物页面
                }else{
                    return redirect('reception/borrow_money');//跳转到借款页面
                }
            }else{
                return view('reception.borrow');//跳转到抵押物页面
            }
            
        }    
    	
    }


    //借款页面
    public function borrow(Request $request){
        if($request->isMethod('POST')){
            //接受借款的数据
            $data = $request->input();
            //$data['user_id'] = $this->getUserid();
            $user_id = 1;
            $data['user_id'] = 1 ; 
            //$userInfo = $request->session()->get('userInfo');
            //$data['phone'] = $userInfo['phone'];
            $data['phone'] = 17601614094;
            DB::beginTransaction();
            $borrow_id = DB::table('borrow')->insertGetId($data);   
            $row = DB::table('pawn')->where(['user_id'=>$user_id,'status'=>2,'bo_id'=>0])->orderBy('pa_id','desc')->limit(1)->update(['bo_id'=>$borrow_id]);
            if($borrow_id != 0 && $row != 0){
                DB::commit();
                echo '成功';
            }else{
                DB::rollback();
                echo '失败';
            }  
        }else{
            return view('reception.borrow_money');
        }
    }

    //获得用户的ID
    function getUserid(){
            //判断是否存在抵押物通审核
            $userInfo = $request->session()->get('userInfo');//获得sesion中用户的数据
            return $userInfo['id'];
    }



    function obj2arr ($obj){
        return json_decode(json_encode($obj),true);
    }

    //验证借款金额是否超标
    public function  checkMoney(Request $request){
        $money = $request->money;
        //$user_id = $this->getUserid();
        $user_id = 1;
        //获得最大借款额度
        $w_money = DB::table('pawn')->where(['user_id'=>$user_id])->orderBy('pa_id','desc')->limit(1)->value('w_money');
        $data = [];
        if($money > $w_money){
            $data['error'] = 0;
            $data['msg'] = '你最高的借款金额为：'.$w_money.'元';
        }else{
            $data['error'] = 1;
            $data['msg'] = '可以借款';
        }
        $data['money'] = ceil($money/100)*100;
        echo json_encode($data);     
    }


    public function checkHrange(Request $request){
        $money = $request->money;
        $hrange= $request->hrange;
        $rase = DB::table('rase')->where('min_money','<=',$money)->orderBy('min_money','desc')->limit(1)->value('in_rase');
        if($rase){
            $data['money'] = ceil((($money*($rase/100))/12)*$hrange)+$money;
            $data['rase'] = $rase;
        }else{
            $data['money'] = 0;
            $data['rase'] = 0;
        }
        echo json_encode($data);
    }

    /**
     * 展示用户还款的项目
     */
    public function repayment(Request $Request){
        //$user_id = $this->getUserid();
        $user_id = 1;
        $data = DB::table('borrow')->where(['user_id'=>$user_id,'status'=>2])->orderBy('id','desc')->limit(1)->first();
        return view('repayment',$data);
    }


  
}
