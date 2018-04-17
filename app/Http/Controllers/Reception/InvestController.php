<?php 
namespace App\Http\Controllers\Reception;

use DB;
use App\Invest;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class InvestController extends Controller{

    //http://blog.csdn.net/zls986992484/article/details/52824962
    //
	/**
	 * [index 投资页面主页面]
	 * @return [type] [description]
	 */
    public function index()
    {
        $borrow=DB::table('borrow')->paginate(2);
        //每个借款项目已经投资的金额和人数
        foreach($borrow as $k=>$v){
            $id=$v->id;
            $data=DB::table('invest')
            ->join('invest_borrow', 'invest.invest_id', '=', 'invest_borrow.in_id')
            ->where('invest_borrow.bo_id','=',"$id")
            ->get();
            foreach($data as $key=>$value){
                $rows[]=$value->invest_money;
                $u[]=$value->u_id;
            }
            //每个项目有多少人投资
            $sum_people=count(array_unique($u));
            //每个项目投资了多少金额
            $sum_money=array_sum($rows);
            //将此值存入到每个数组中
            //一共有多少用户进行投资
            $borrow[$k]->sum_people=$sum_people;
            //一共投资多少资金
            $borrow[$k]->sum_money=$sum_money;
            //当前项目年利率
            $borrow[$k]->profit=$sum_money/($v->money)*100;
            //此项目还差多少资金
            $borrow[$k]->has_money=$v->money-$sum_money; 
            
            
        }
        return view('reception.invest.index',['borrow'=>$borrow]);
    }

    /**
     * [back ajax求得利息]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function back(Request $request)
    {
        //获取ajax传值
        $bo_id= $request->input('bo_id');
        $invest_money= $request->input('invest_money');
        if(!empty($invest_money))
        {
            $back=DB::table('borrow')
            ->where('borrow.id','=',"$bo_id")            
            ->get();
            $hrange=$back[0]->hrange;
            $rate=$back[0]->rate;
            $profit=$invest_money*($rate/12)*$hrange/10;
            echo round($profit,2);
        }else{
            $profit=0;
            echo $profit;
        }
    }

    /**
     * [tende ajax投资]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
	public function tende(Request $request)
	{
        //借款项目id
		$bo_id= $request->input('bo_id');
        //投资资金
        $invest_money= $request->input('invest_money');
        //模拟数据从cookie中获取   当前登录用户id
		$user_id=1;
        if(!empty($invest_money))
        {
            //求利息
            $back=DB::table('borrow')
            ->where('borrow.id','=',"$bo_id")            
            ->get();
            //借款期限
            $hrange=$back[0]->hrange;
            //借款年利率
            $rate=$back[0]->rate;
            //利息
            $profit=$invest_money*($rate/12)*$hrange;
            //利息+本金
            $out_accrual=$profit+$invest_money;
            $in_id=DB::table('invest')->insertGetId([
                'invest_time' =>$hrange,
                'user_id' =>$user_id,
                'invest_money' =>$invest_money,
                'back_accrual'=>$profit,
                'back_principal'=>$invest_money,
                'out_accrual'=>$out_accrual
            ]);
        }
        //投资成功后，投资用户余额减去相应金额
        DB::table("user")->where('id',"$user_id")->decrement("balance",$invest_money);

        $re=DB::table('invest_borrow')->insert([
            'u_id' =>$user_id,
            'in_id' =>$in_id,
            'bo_id'=>$bo_id
        ]);
        if($re)
        {
        	$arr=array(
        		'status'=>1,
        		'count'=>"添加成功!"
        	);
        }else{
        	$arr=array(
        		'status'=>0,
        		'count'=>"添加失败"
        	);
        }
        echo json_encode($arr);
	}

    /**
     * [market 进入投资详情页面]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function market(Request $request)
    {
        //接收要借款项目的id
        $id=$_GET['id'];
        echo $id;die;
        //查询借款的信息
        $data=DB::table('borrow')
            ->where('borrow.id','=',"$id")            
            ->get();
        $user_id=1;//当前登录用户
        $user_mess=DB::table('user')
            ->where('id','=',"$user_id")            
            ->get();
        $need_money=$data[0]->money;//需要借款的金额
        $has_money=DB::table('invest')
            ->join('invest_borrow', 'invest.invest_id', '=', 'invest_borrow.in_id')
            ->where('invest_borrow.bo_id','=',"$id")            
            ->get(); 
        $row='';
        foreach($has_money as $k=>$v)
        {
            $row[]=$v->invest_money;
        }  
        if(!empty($row))
        {
            
        }
        //已经投资的总金额
        $has_all=array_sum($row);
        if($need_money==$has_money)
        {
            DB::table("borrow")->where('id',"$id")->update(['status'=>2]); 
        }
        $now_money=$need_money-$has_all;
        //echo $now_money;
        //借款项目完成的进度
        $percent=$has_all/$need_money*100;
        //投资完成信息
        $first_time=strtotime($has_money[0]->invest_time);
        $end=array_pop($has_money)->invest_time;
        $end_time=strtotime($end);  
        $t=$first_time-$end_time;
        $time=intval($t/3600);
        //抵押物信息
        $pawn=DB::table('pawn')
            ->where('pawn.bo_id','=',"$id")            
            ->get();
        //当前借款人id    
        $u_id=$pawn[0]->user_id;
        $means=DB::table('means')
            ->where('user_id','=',"$u_id")            
            ->get();
        $str1=$means[0]->name;
        $str2=$means[0]->idcard;
        $name=mb_substr($str1,0,1,'utf-8');       
        $idcard=mb_substr($str2,0,4);
        //查询出借记录
        $invest_log=DB::table('invest_borrow')
            ->join('invest', 'invest.invest_id', '=', 'invest_borrow.in_id')
            ->join('means', 'means.user_id', '=', 'invest_borrow.u_id')
            ->where('invest_borrow.bo_id','=',"$id") 
            ->select("means.name","invest.invest_money","invest.start_time")           
            ->get();
        foreach ($invest_log as $k=>$v) {
            $invest_log[$k]->new_name=mb_substr($v->name,0,1);
        }      
        return view('reception.invest.market',compact('invest_log','name','idcard','id','pawn','time','end','data','user_mess','now_money','percent'));
    }
}