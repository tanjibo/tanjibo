<?php
  namespace App\Http\Controllers\Admin;
  use App\Http\Controllers\Controller;
  use App\Libs\Code\Code;
  use Illuminate\Support\Facades\Input;
  use App\Http\Model\User;
  use DB;
  use Crypt;
  /**
   * 登陆控制器
   */
class LoginController extends Controller{

	function  index(){
		if($data=Input::all()){

		// if(strtoupper($_SESSION['code'])!=strtoupper($data['code'])){
		// 	return back()->with('msg','验证码错误');
		// }
		if(!($data['username']&& $data['password'])){
			return back()->with('msg','用户名或密码不能为空');
		}
    //
		$info=User::where(['username'=>$data['username']])->first();

    if((!$info && $data['password']==Crypt::decrypt($info['password']))){
       return back()->with('msg','用户名或密码错误');

    }

     session(['user_id'=>$info->user_id,'username'=>$info->username]);
       return redirect('admin/index/index');


      //$model= User::find(1);
      //$arr=['username'=>'admin','password'=>Crypt::encrypt('admin888')];
      // dd(Crypt::encrypt('admin'));
      //$data=DB::table('user')->insertGetId($arr);
      //dd($data);


		}else{
            if(session('user_id')) return redirect('admin/index/index');
		 return view('admin.login');

		}
	}

	function code(){
		$code=new Code();
		$code->make();
	}



}
