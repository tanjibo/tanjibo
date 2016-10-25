<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Admin\CommonController;

use App\Http\Model\Category;

use App\Http\Model\Article;

class ArticleController extends CommonController
{
    /**
     * method:GET|HEAD
     * url:admin/article
     */
    function index(){


  }
    /**
     * method :POST
     * url:admin/article
     */
    function store(Request $request){
      $data=$request->all();
      $article=new Article;
     $data['create_time']=time();
      $article->fill($data)->save();


    }
    /**
     *method: GET|HEAD
     * url:admin/article/create
     */

    function create(){
      $data=(new Category)->getList();

      return view('admin.article.add',['data'=>$data]);
    }

    /**
    *GET|HEAD
    *admin/article/{article}
    */

    function show(){

    }

    /**
     *DELETE
     *admin/article/{article}
     */
    function destroy(){

    }

    /**
     * PUT|PATCH
     *admin/article/{article}
     */
    function update(){

    }

    /**
     * GET|HEAD
     * admin/article/{article}/edit
     */
    function edit(){

    }

}
