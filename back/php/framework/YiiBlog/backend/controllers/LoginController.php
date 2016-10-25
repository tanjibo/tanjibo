<?php
 namespace  backend\controllers;
 use yii\web\Controller;
 use backend\models\LoginForm;
 use yii;

 class LoginController extends Controller{


   function actions(){
    return [
      'captcha'=>[
        'class'=>'yii\captcha\CaptchaAction',
        'height'=>30,
        'width'=>80,
        //'backColor'=>'0xdedede',
        'minLength'=>5,
        'maxLength'=>5
      ]
    ];
  }

   function accessRules(){
      return [

      ];
   }

   /**
    * 登陆控制器
    */
   function actionIndex(){
    $model=new LoginForm;
     $req=YII::$app->request;
     if($req->IsPost && $model->load($req->post())){

       //获取验证码
       // $this->createAction('captcha')->getVerifyCode();
      if($model->validate()&& $model->login()){
          $this->redirect(['index/index']);
      }else{
      
        p($model->errors);exit;
      }


     }else{

       return $this->renderPartial('index',['model'=>$model]);
   }
 }

 }
