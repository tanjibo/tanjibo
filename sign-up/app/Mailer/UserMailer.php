<?php

namespace  App\Mailer;

use App\User;

class UserMailer extends  Mailer{


    public function welcome($user){
        $subject="welcom to Laravist";
        $view='email.welcome';
        $data=['name'=>$user->name];
        $this->sendTo($user,$subject,$view,$data);
    }
}