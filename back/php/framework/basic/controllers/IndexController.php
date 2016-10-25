<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\Test;

/**
 * 首页控制器.
 */
class IndexController extends Controller
{
    public $layout = 'home';

    function init(){
      echo 'fdsfs<br/>';
    }

    function actions(){
      echo 'ddd';
    }

    /**
     * 首页控制器
     */
    public function actionIndex()
    {

        // return $this->render('index');
    }

    function actionPage(){
     $model=new Test;
    //$data=$model::find()->orderBy('create_time desc')->asArray()->all();
    //$data=$model::find()->count();
     $this->render('index');

    }

    // public function actionAbout()
    // {
    //   $this->render('about');
    // }
    // /**
    //  * 获得子模块
    //  * @return [type] [description]
    //  */
    // function actionAa(){
    //   //获取子模块 根据模块id
    //  $comment= \YII::$app->getModule('comment');
    //  p($comment);
    //   //调用子模块的操作
    //   $comment->runAction('default/index');
    // }
}
