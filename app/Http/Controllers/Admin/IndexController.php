<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class IndexController extends CommonController
{
    public function index(){
    	return view('admin.index');

    }

    /**
     * [bill module]
     */
    public function billadd(Request $request){  //添加账单
    	$input = $request->input();
    	$true = 1;
    	foreach($input as $val){
    		if($val==''){
    			$true = 0;
    		}
    	}
    	if(!$true){
    		echo json_encode(['err'=>0,'mes'=>'请认真填写']);die;
    	}
    	$input['time'] = date("Y-m-d");
    	$input['admin_id'] = $this->session->get('admin');
    	if(DB::table('bill')->insert($input)){
    		$arr = ['err'=>1,'mes'=>'数据录入'];
    	}else{
    		$arr = ['err'=>0,'mes'=>'操作异常'];
    	}
    	echo json_encode($arr);
    }

    public function getbill(Request $request){ //获取账单
		$input = $request->input();
		$page = 1;
		if(array_key_exists('page',$input)){
			$page = $input['page'];
			if($input['searchbill']!='3'){
				$input['rabge']='some';
			}
		}
		$limit = ($page-1)*10;
		$admin_id = $this->session->get('admin');
		if($input['searchbill']!='3' && $input['rabge']=='some'){ //部分账单
			$timeStart = $input['searchbill'].'-1 00:00:00';
			$date = explode('-',$input['searchbill']);
			$timeEnd = $input['searchbill'].'-'.$this->getDayNum($date[1]).' 23:59:59';
			// ->whereBetween('time',[$timeStart,$timeEnd])
			$data = DB::select("select id,notes,money,pay,time from bill where status='0' and admin_id='$admin_id' and time>='$timeStart' and time<='$timeEnd' order by time desc limit $limit,10");
			$count = DB::select("select count(id) as count from bill where status='0' and admin_id='$admin_id' and time>='$timeStart' and time<='$timeEnd'");
			$pay = DB::table('bill')->where('pay',2)->where('status',0)->where('admin_id',$admin_id)->where('time','>=',$timeStart)->where('time','<=',$timeEnd)->sum('money');
			$income = DB::table('bill')->where('pay',1)->where('status',0)->where('admin_id',$admin_id)->where('time','>=',$timeStart)->where('time','<=',$timeEnd)->sum('money');
		}else{  //全部账单

			$data = DB::select("select id,notes,money,pay,time from bill where status='0' and admin_id='".$admin_id."' order by time desc limit $limit,10");
			$count = DB::select("select count(id) as count from bill where status='0' and admin_id='".$admin_id."'");
			$pay = DB::table('bill')->where('pay',2)->where('status',0)->where('admin_id',$admin_id)->sum('money');
			$income = DB::table('bill')->where('pay',1)->where('status',0)->where('admin_id',$admin_id)->sum('money');
		}
		if($data)
		{
			$total = ceil($count[0]->count/10);  //总页数
			
			echo json_encode(['err'=>1,'data'=>$data,'total'=>$total,'pay'=>$pay,'income'=>$income,'count'=>$count[0]->count,'num'=>$pay+$income,'page'=>$page]);
    	}else{
    		echo json_encode(['err'=>0,'mes'=>'未检测到数据！']);
    	}
    }

    public function getDayNum($month){  //获取月份最后一天日期
    	if($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10){
    		$day = 31;
    	}else if($month==2){
    		$day = 28;
    	}else{
    		$day = 30;
    	}
    	return $day;
    }

    // public function calculateMoney($data){ //计算支出/收入/总共金额
    // 	$moneyArr = ['pay'=>0,'income'=>0];
    // 	foreach($data as $v){
    // 		if($v->pay==2){
    // 			$moneyArr['pay'] = $moneyArr['pay']+$v->money;
    // 		}else{
    // 			$moneyArr['income'] = $moneyArr['income']+$v->money;
    // 		}
    // 	}
    // 	$moneyArr['num'] = $moneyArr['pay']+$moneyArr['income'];
    // 	return $moneyArr;
    // }

    public function delbill(Request $request){  //删除账单
    	$input = $request->input();
    	if(DB::table('bill')->where('id',$input['id'])->update(['status'=>1])){
    		$admin_id = $this->session->get('admin');
    		$limit = ($input['page']-1)*10;  //偏移量
    		if($input['search']=='no'){  //无日期条件
    			$data = DB::select("select id,notes,money,pay,time from bill where status='0' and admin_id='".$admin_id."' order by time desc limit $limit,10");
				$count = DB::select("select count(id) as count from bill where status='0' and admin_id='".$admin_id."'");
				$pay = DB::table('bill')->where('pay',2)->where('status',0)->where('admin_id',$admin_id)->sum('money');
				$income = DB::table('bill')->where('pay',1)->where('status',0)->where('admin_id',$admin_id)->sum('money');
    		}else{
    			$timeStart = $input['hiddenSearchVal'].'-1 00:00:00';
				$date = explode('-',$input['hiddenSearchVal']);
				$timeEnd = $input['searchbill'].'-'.$this->getDayNum($date[1]).' 23:59:59';

				$data = DB::select("select id,notes,money,pay,time from bill where status='0' and admin_id='$admin_id' and time>='$timeStart' and time<='$timeEnd' order by time desc limit $limit,10");
				$count = DB::select("select count(id) as count from bill where status='0' and admin_id='$admin_id' and time>='$timeStart' and time<='$timeEnd'");
    			$pay = DB::table('bill')->where('pay',2)->where('status',0)->where('admin_id',$admin_id)->where('time','>=',$timeStart)->where('time','<=',$timeEnd)->sum('money');
				$income = DB::table('bill')->where('pay',1)->where('status',0)->where('admin_id',$admin_id)->where('time','>=',$timeStart)->where('time','<=',$timeEnd)->sum('money');
    		}
    		$total = ceil($count[0]->count/10);  //总页数
    		$arr = [
				'err'=>1,
				'total'=>$total,
				'pay'=>$pay,
				'income'=>$income,
				'count'=>$count[0]->count,
				'num'=>$pay+$income
			];
    		$arr['data'] = 0;
			//判断是否满足10条数据
	    	if(count($data)>=10){
	    		$arr['data'] = array_pop($data);
	    	}else{
	    		$arr['mes'] = '这是最后一页';
	    	}
			
			
			

    	}else{
    		$arr = ['err'=>0,'mes'=>'操作异常'];
    	}
		//$this->p($arr);
		echo json_encode($arr);
    	
    }

    /**
     * bill module End;
     */
    
    /**
     * notes module
     */
    public function notesadd(Request $request){//添加笔记
    	$input = $request->input();
    	if(DB::table('notes')->insert(['notes_title'=>$input['title'],'notes_text'=>$input['notesVal'],'admin_id'=>$this->session->get('admin')])){
    		$arr = ['err'=>1,'mes'=>'记下了'];
    	}else{
    		$arr = ['err'=>0,'mes'=>'操作异常'];
    	}
    	echo json_encode($arr);
    }

    public function getnotes(Request $request){   	//搜索查询笔记
    	$title = $request->input('title');
    	$page = 1;
    	if($request->input('page')){
    		$page =$request->input('page');
    	}
    	$limit = ($page-1)*10;
    	$admin_id = $this->session->get('admin');
    	$notes = DB::select("select id,notes_title,notes_text from notes where admin_id='$admin_id' and notes_title like '%$title%' limit $limit,10");
    	$count = DB::select("select count(id) as count from notes where admin_id='$admin_id' and notes_title like '%$title%'");
    	foreach($notes as $k=>$v){
    		
    		$notes[$k]->notes_title = str_replace($title,'<font color="red">'.$title.'</font>',$v->notes_title);
    	}
    	if($notes){
    		$arr = ['err'=>1,'mes'=>'梅茂坦','data'=>$notes,'page'=>$page,'count'=>$count[0]->count,'total'=>ceil($count[0]->count/10)];
    	}else{
    		$arr = ['err'=>0,'mes'=>'未检测到数据'];
    	}
    	echo json_encode($arr);
    }
    /**
     * notes module End;
     */
    
    /**
     * blog module
     */
    public function blogadd(Request $request){
    	$input = $request->input();
    	$this->p($input);
    	if(!$this->VerificationFalse($input)){
    		echo json_encode(['err'=>0,'mes'=>'不能为空']);
    	}
    	$this->p($input);
    }
}