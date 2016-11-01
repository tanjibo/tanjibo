<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    function index(){
        return view('admin.article.index')->withArticles(Article::all());
    }

    /**
     * 新增视图
     */
    function create(){
       return view('admin.article.create');
    }

    /**
     * 新增保存
     */
    function store(Request $request){

         $this->validate($request,[
             'title'=>'required|unique:articles|max:255',//必填、在 articles 表中唯一、最大长度 255
             'body'=>'required'
         ]);
        $article=new Article;
        $article->title=$request->get('title');
        $article->body=$request->get('body');
        $article->user_id=$request->user()->id;
        if($article->save()){
            return redirect('admin/article');
        }else{
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function show(){

    }

    function edit(){

    }
    //put/patch
    function update(){

    }

    //delete
    function destroy($id){
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功');
    }
}
