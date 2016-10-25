<?php
namespace backend\controllers;

use backend\controllers\AuthController;

class IndexController extends AuthController{

  function actionIndex(){
    return $this->renderPartial('index');
  }

  function actionMain(){

  }
}
