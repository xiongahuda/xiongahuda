<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::group(['middleware' => ['web']], function () {
//     //路由放在这里
// });
#高级路由
// Route::get('index',"IndexController@show");
// Route::get('haha',"IndexController@aa");

#Route::get('admin/index',"IndexController@index");

#Route::get('reception/index',"IndexController@index");


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Route::group(['middleware' => ['web']], function () {
//     //
// });

//路由分组

// Route::group(['prefix'=>'reception','namespace'=>'Reception'],function(){

// });
Route::any('/admin/','IndexController@index');//设置默认访问控制器方法名
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

	Route::get('index',"IndexController@index");
	Route::any('getadmin',"AdminController@getadmin");
	Route::any('verification',"AdminController@verification");
	Route::any('billadd',"IndexController@billadd");
	Route::any('getbill',"IndexController@getbill");
	Route::any('delbill',"IndexController@delbill");
	Route::get('loginout',"AdminController@loginout");

});