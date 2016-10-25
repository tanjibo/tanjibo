<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Event;
use App\Events\BlogView;


/**
 * 分类控制器.
 */
class CategoryController extends CommonController
{

    function __construct(){
        $this->middleware('create', ['only' => ['store']]);
        $this->middleware('update', ['only' => ['update']]);
    }
    public function index()
    {
    }
    //post
  public function store(Request $request)
  {

      $data = $request->all();
      //Event::fire(new BlogView($data));
      $data['create_time']=time(); //添加创建时间
      $rule = [
         'cate_name' => 'bail|required|unique:category|max:255',
     ];
      $msg = [
         'cate_name.required' => '分类名不能为空',
         'cate_name.unique'=>'分类名被占用,请重新填写'
     ];

      $validator = Validator::make($data, $rule, $msg);

      if ($validator->fails()) {
          return  back()->withErrors($validator);
      }

      //$category = new Category;

      //$category->fill($data)->save();
      $info=Category::create($data);
      if($info){
          return redirect('admin/category/show')->with('errors','添加成功');
      }else{
          return back()->with('errors','添加失败');
      }
  }
  //get/head
  public function create()
  {
      $cate = (new Category())->getList();

      return view('admin.category.add', ['data' => $cate]);
  }
  //get/head
  public function show()
  {
      $category = (new Category())->getList();

      return view('admin.category.categorylist', ['data' => $category]);
  }

    public function changeOrd(Request $request)
    {
        if ($request->has('id') && $request->ord_id && is_numeric($request->ord_id)) {
            $data = Category::find($request->id);
            $data->update_time = time();
            $data->cate_order = $request->ord_id;

            return $data->save() ? ['status' => 1, 'msg' => '排序成功'] : ['status' => 0, 'msg' => '排序失败'];
        }
    }

 //put patch
  public function update(Request $request,$id)
  {
       $data=$request->except('_method','_token');
      $data['update_time']=time();
      $cate=Category::where('c_id',$id)->update($data);
      if($cate){
          return redirect('admin/category/show');
      }else{
          return  back()->with('errors','更新失败');
      }

  }
  //delete
  public function destroy(Request $request,$id)
  {
     if($request->all()){
        //  $info=Category::where('c_id',$id)->delete();
        //  Category::where('pid',$id)->update(['pid'=>0]);
         if(1){
            return $data=[
                 'status'=>1,
                 'msg'=>'删除成功'
             ];

         }else{
             return $data=[
                'status'=>0,
                'msg'=>'删除失败'
             ];
         }

     }

  }
  //get /head
  public function edit($id)
  {
       $data = (new Category())->getList();
       $field=Category::find($id);

      return view('admin.category.edit',compact('data',"field"));
  }
}
