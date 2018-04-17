<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        //添加导航
        $data['nav'] = DB::table('nav')->orderBy('nav_sort','asc')->get();
        return view('reception/index',$data);

    }

    public function login()
    {
        return view('reception.login');
    }

    public function reg()
    {
        return view('reception/reg');
    }

    public function jianyi()
    {
        return view('reception/jianyi');
    }

    public function about(){
        $data['nav'] = DB::table('nav')->orderBy('nav_sort','asc')->get();
        return view('reception/about',$data);
    }

    public function borrow(){
        $data['nav'] = DB::table('nav')->orderBy('nav_sort','asc')->get();
        return view('reception/borrow',$data);
    }

    public function agreement(){
        return view('reception/agreement');
    }

    public function help(){
        $data['nav'] = DB::table('nav')->orderBy('nav_sort','asc')->get();

        return view('reception/help',$data);
    }

    public function market(){
        $data['nav'] = DB::table('nav')->orderBy('nav_sort','asc')->get();
        return view('reception/market',$data);
    }

    public function member_info(){
        return view('reception/member_info');
    }

    public function member_tuan(){
        return view('reception/member_tuan');
    }

    public function member_index(){
        return view('reception/member_index');
    }

    public function member_bid_record(){
        return view('reception/member_bid_record');
    }

    public function member_bid_auto(){
        return view('reception/member_bid_auto');
    }

    public function member_trade(){
        return view('reception/member_trade');
    }

    public function member_pay(){
        return view('reception/member_pay');
    }

    public function member_bank(){
        return view('reception/member_bank');
    }

    public function member_invite(){
        return view('reception/member_invite');
    }

    public function chat_client(){
        return view('reception/chat_client');
    }

    public function forget(){
        return view('reception/forget');
    }
}
