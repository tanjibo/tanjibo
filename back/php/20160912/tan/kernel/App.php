<?php
namespace tan\kernel;
use Exception;
use ReflectionMethod;
use tan\error\Error;

/*
*框架实行类
*/
class App{
   //框架初始化
   function init(){
       (new Error)->boostrap();
       //运行实例
       $this->run();

   }
    public function run(){
     //    array_filter 如果没有提供 callback 函数， 将删除 input 中所有等值为 FALSE 的条目
     //   $entry =[ 0 => 'foo',1 => false,2 => -1,3 => null,4 => ''];
     //   print_r(array_filter($entry));  =>output: [0=>foo,2=>-1]
       $params=array_filter(explode('/',isset($_GET['c'])?$_GET['c']:''));
       switch (count($params)) {
           case 2:
                array_unshift($params,'home');
               break;
          case 1:
                array_unshift($params,'entry');
                array_unshift($params,'home');
            break;
          case 0:
                array_unshift($params,'index');
                array_unshift($params,'entry');
                array_unshift($params,'home');
                break;
       }
     $_GET['c']=implode('/',$params);

     $params[1]                    = preg_replace_callback( '/_([a-z])/', function ( $matches ) {
			return ucfirst( $matches[1] );
		}, $params[1] );

        define("MODULE",$params[0]);
        define("CONTROLLER",ucfirst($params[1]));
        define("ACTION",$params[2]);
        $this->action();


	}

    /**
    *执行动作
    */
    private  function action(){

        $class='app'.'\\'.MODULE.'\\controller\\'.CONTROLLER;
        if(!class_exists($class)){
            throw new Exception("{$class} not exist");
        }
        $action =method_exists($class,ACTION)?ACTION:"__empty";
        try{
            $reflection = new ReflectionMethod ( $class,$action );
            if($reflection->isPublic()){
                $reflection->invoke( new $class );
                //call_user_func_array([ new $class, $action ],[]);
            }

        }catch(ReflectionExtension $e){
             $reflect = new ReflectionMethod( $class ,'__call');
             $reflect -> invokeArgs( $class ,[]);  //带参数
        }

    }
}
