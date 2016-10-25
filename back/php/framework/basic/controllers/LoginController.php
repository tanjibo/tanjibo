<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use yii;

/**
 * 登陆控制器.
 */
class  LoginController extends Controller
{
    public $layout = 'home';

    public function actions()
    {
        echo 'this is Test';
    }

    

    public function actionIndex()
    {
        $model = new User();
        $s = \YII::$app->request;
        if ($s->isPost) {
            $model = new User();
            echo $model->id;
            $f = $model::find()->where(['username' => 'admin', 'password' => 'admin'])->asArray()->one();
            p($f);
        } else {
            p(Yii::$app->defaultRoute);
            exit;
      // $data=$this->render('index');
        }
    }
}
