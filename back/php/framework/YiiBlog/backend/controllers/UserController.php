<?php
 namespace backend\controllers;
 use yii\web\Controller;
 use yii;
 use common\models\User;
 use yii\data\Pagination;

 class UserController extends Controller{

   function actionIndex(){
     $model=User::find();
     $pagination=new pagination(['totalCount'=>$model->count(),'pageSize'=>1]);
     $result=User::find()->offset($pagination->offset)->limit($pagination->limit)->all();
     return $this->render('index',['data'=>$result,'p'=>$pagination]);
   }


   function actionAdd(){
     $model=new User;
     if(YII::$app->request->IsPost && $model->load(YII::$app->request->post())&& $model->validate()){
      $model->save();
     }
     return $this->render('add',['model'=>$model]);
   }
 }
