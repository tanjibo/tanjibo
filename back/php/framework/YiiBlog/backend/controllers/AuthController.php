<?php

namespace backend\controllers;
 use yii;
use  yii\web\Controller;

class AuthController extends Controller{

  function init(){
     parent::init();
    $session=Yii::$app->session;

    if(!$session->has('user_id')){
      
      Yii::$app->response->redirect(['login/index']);
    }
  }
}
