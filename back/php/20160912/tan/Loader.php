<?php
namespace Tan;
/**
 * 自动加载类
 */
class Loader{
   protected static $alias = [];
   /**
    * psr-4 规范加载文件
    */
   public  function register(){
     spl_autoload_register([$this,'loadClass']);
   }

   public function loadClass($class){

    $file=str_replace('\\',DS,$class) . '.php';

    require_once(ROOT_PATH.DS.$file);

   }
}
