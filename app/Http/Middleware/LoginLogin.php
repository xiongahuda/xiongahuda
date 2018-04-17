<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class LoginLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!session('user_id')){
           // echo 'asdasdad ';
            return redirect('/admin/login');    
        }
       // return $next($request);
            //echo '请先登录';
            
    }
}
