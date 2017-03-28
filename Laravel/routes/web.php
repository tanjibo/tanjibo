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
Route::group(['namespace'=>'Front'],function(){
    Route::get('/','IndexController@index');
    Route::get('details/{id}','IndexController@show');
});


Route::group(['namespace'=>'Admin','prefix'=>'admin'],function($router){

    Route::get('login','loginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');

    $router->get('dash', 'DashboardController@index');
});

//
//Route::get('/', function () {
//    app()->bind('HelpSpot\API', function ($app) {
//        echo 111;
//        return new HelpSpot\API($app->make('HttpClient'));
//    });exit;
//    dd(debug_backtrace());exit;
//  $data=[
//    'event'=>'anewMessage',
//      'data'=>[
//          'name'=>'tanjibo'
//      ]
//  ];
//    \Illuminate\Support\Facades\Redis::set('aa','aa');
//});
//
//Route::get('event',function(){
//   $user=\App\User::find(1);
//    dump($user);exit;
//});
//Auth::routes();
//
//Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
