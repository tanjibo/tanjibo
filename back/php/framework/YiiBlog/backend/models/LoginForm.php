<?php

namespace  backend\models;

use yii;
use yii\base\Model;
use yii\captcha\CaptchaAction;
use common\models\User;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $code;
    public $remember;

    public function rules()
    {
        return [

        ['username', 'checkAccount', 'skipOnEmpty' => false],
        ['password', 'required', 'message' => '密码不能为空'],

      // ['username','checkAccount'],
      //['code','captcha','captchaAction'=>'login/captcha','message'=>'验证码错误']
    ];
    }

  /**
   * 验证账号.
   */
  public function checkAccount($attribute, $params)
  {
      if (!$this->$attribute) {
          $this->addError($attribute, '用户名称不能为空');
          return false;
      }
      if (!preg_match('/^[\w]{2,30}$/', $this->$attribute)) {
          $this->addError($attribute, '用户名称只能为2-30');
          return false;
      }
      return true;
  }

    public function login()
    {
        //$data=(new \yii\db\Query())->select(['id','username'])->from('s_user')->one();
    //p($data);
 $info = User::find()->where(['username' => $this->username, 'password' => md5($this->password)])->select(['user_id' => 'id', 'username'])->asArray()->one();
        if ($info) {
           $this->createSession($info);

           if($this->remember==1){

           }
        }else{
          $this->addError('username','用户名或密码错误');
          return false;
        }
    }

  /**
   * 创建用户登录session.
   */
  private function createSession($data)
  {
      $session = Yii::$app->session;
      $session->set('user_id', $data['user_id']);
      $session->set('username', $data['username']);
  }

  /**
   * 记住密码的时候
   */
  private function setCookies(){
   $cookie=Yii::$app->response->cookies;
  }
}
