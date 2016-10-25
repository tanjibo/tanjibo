<?php  

class Config implements ArrayAccess{
	  //配置项
     protected static $config =array();
	function __construct(){

	}
	public function offsetGet($key){
      if(empty(self::$config[$key])){
      	$file_path='./config/'.$key.'.php';
      	$config=require_once($file_path);
      	self::$config[$key]=$config;
      }
      return self::$config[$key];
	}
	public function offsetSet($key,$value){
       return self::$config[$key]=$value;
	}
	public function offsetExists($key){
      return isset(self::$config[$key]);
	}
    public function offsetUnset($key){
      unset(self::$config[$key]);
    }
}