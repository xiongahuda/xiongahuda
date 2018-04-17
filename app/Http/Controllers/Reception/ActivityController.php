<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    //活动导航
    public function activity(){
        $data['nav'] = DB::table('nav')->orderBy('nav_sort','asc')->get();
        return view('reception/activity',$data);
    }


}
