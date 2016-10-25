<?php

namespace app\controllers;
use yii\web\Controller;
use vendor\animal\Mouse;
use vendor\animal\Cat;
use vendor\animal\Dog;
use yii\base\Event;
use app\behaviors\Behavior1;

 class AnimalController extends Controller{


   function actionIndex(){
  
  //   $cat=new Cat;
  //   $mouse=new Mouse;
//  $dog=new Dog;
  //  //绑定miao事件，一旦触发，也触发mouse 类的run方法
  //   $cat->on('miao',[$mouse,'run']);
  //   $cat->on('miao',[$dog,'look']);
  //   //cat 类执行shout时候，触发miao事件，miao事件上有绑定mouse 类的run方法
  //   //取消绑定
  //   $cat->off('miao',[$dog,'look']);
  //   //类级别的事件绑定，这样的话，实例化多个cat类，不用像上面一个一个的绑定
  //   Event::on(Cat::className(),'miao',[$mouse,'run']);
  //   //后面也可以是匿名函数
  //   Event::on(Cat::className(),'miao',function(){
  //     echo 'dddd';
  //   });
   //
  //   $cat->shout();
  $behaviors=new Behavior1();
  $dog->attachBehavior('beh1',$behaviors);// 对象方式添加行为
  $dog->detachBehavior('beh1');  //移除对象添加的行为
   $dog=new Dog;
   $dog->trigger('wang');
   }
 }
