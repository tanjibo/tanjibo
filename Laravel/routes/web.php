<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
// //后台首页
// Route::get('/','IndexController@index');
// //后台首页
// Route::get('index','IndexController@index');
// //后台登陆
// Route::get('login',"IndexController@login");

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('foo',function(){
//	return "hello world";
//});
//
//Route::get('user/{id?}',function($id=100){
//  echo $id;
//})->middleware('checkage');
//Route::get('testPost',function(){
//	$csrf_token=csrf_token();
//	$form=<<<FORM
//	<form action="/hello" method="post">
//
//	<input type="submit" value="test"/>
//	</form>
//FORM;
//return $form;
//});
//Route::post('hello' ,function(){
//
//});
Route::get('now',function(){
    return date('y-m-d H:i:s');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('article','ArticleController');

});