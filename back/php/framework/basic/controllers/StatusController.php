<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\Status;
class StatusController extends Controller{

  function actionCreate(){
  $model=new Status;
   return  $this->render('create',['model'=>$model]);
  }
}
