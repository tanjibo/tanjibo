<?php

namespace backend\controllers;
use yii\web\Controller;

class TestController extends Controller{

    function actionIndex(){

      return $this->render('index');

    }
}
