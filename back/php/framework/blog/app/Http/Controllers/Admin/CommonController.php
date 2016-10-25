<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CommonController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('Filedata');

        if ($file->isValid()) {
            $des = 'uploads/images/'.date('Ymd');
             //获取文件的大小
             $size = $file->getClientSize();

            if ($size >= 3000000) {
                return ['status' => 0, 'msg' => '上传文件过大'];
            }
             //获取文件的扩展名称
             $ext = $file->getClientOriginalExtension();

            is_dir($des) or mkdir($des, 0777, true);

            $fileName = str_random(15).'.'.$ext;

            $allow_ext = ['png', 'jpg', 'gif'];

            if ($ext && !in_array($ext, $allow_ext)) {
                return ['status' => 0, 'msg' => '请上传jpg,png,gif图片'];
            }
            $data = $file->move($des, $fileName);

            return
                  [
                      'status' => 1,
                      'data' => asset($des.'/'.$fileName),
                  ]
             ;
        }
    }
}
