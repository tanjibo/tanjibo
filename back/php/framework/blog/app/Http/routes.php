<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin.login']],function(){


    /**
     * 首页控制器
     */
    Route::group(['prefix'=>'index'],function(){
        Route::get('index','IndexController@index');
        Route::get('info','IndexController@info');
        Route::get('logout',['uses'=>'IndexController@logout']);
        Route::any('chpwd',['uses'=>'IndexController@chPwd']);
        Route::any('remotepwd',['uses'=>'IndexController@remotePwd']);


    });
    /**
     * 分类控制器
     */
    Route::group(['prefix'=>'category'],function(){
        Route::post('changeord',['uses'=>"CategoryController@changeOrd"]);
        // Route::get('create',['uses'=>"CategoryController@create"]);
        // Route::get('show',['uses'=>"CategoryController@show"]);
        // Route::any('store',['uses'=>"CategoryController@store"]);

    });

     Route::resource('category', 'CategoryController');
     Route::resource('article', 'ArticleController');
     Route::resource('links', 'LinksController');
     Route::any('common/upload','CommonController@upload');
    //Route::resource('category','CategoryController') ;
     //Route::get('category/index',['uses'=>'CategoryController@index']);

});


/**
 * 登陆控制器
 */
Route::group(['prefix'=>'admin/login','namespace'=>'Admin'],function(){
    Route::any('','LoginController@index');
    Route::any('index','LoginController@index');
    Route::get('code',['uses'=>'LoginController@code']);
    Route::get('getCode',['uses'=>'LoginController@getCode']);


});
