<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }

    /**
     *ajax 验证密码
     */
    public function remotePwd(Request $request)
    {
        if ($data = $request->except('_token')) {
            $user = User::find(session('user_id'));

            echo  Crypt::decrypt($user->password) == $data['password_o'] ?
          'true'
         :
          'false';

            exit;
        } else {
            echo '参数错误';
        }
    }
    /**
     * 修改密码
     */
    public function chPwd()
    {
        if ($input = Input::all()) {
            $data = User::find(session('user_id'));
            User::update();
            $data->password = Crypt::encrypt($input['password']);

            return $data->save() ? ['status' => 1, 'msg' => '更新密码成功'] : ['status' => 0, 'msg' => '更新密码失败'];
        //   $url=[
        //     'password'=>'required|between:8,12',
        // 	'password_o'=>"required",
          //
        //   ];
        //   $validator = Validator::make($input, $rules, $messages);
        //   if($validator->fails()){
          //
        //   }else{
        //
        //   }
        } else {
            return view('admin.pass');
        }
    }

    public function info()
    {
        //		dd($_SERVER);
        return view('admin.info');
    }

    public function logout(Request  $request)
    {
        $request->session()->flush();

        return redirect('admin/login/index');
    }
}
