<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/14
 * Time: 下午9:02
 */
namespace App\Mailer;

class Mailer{


    public function sendTo($user,$subject,$view,$data=[]){
        \Mail::queue($view,$data,function($message) use ($user,$subject){

            $message->to($user->email)->subject($subject);
        });
    }
}