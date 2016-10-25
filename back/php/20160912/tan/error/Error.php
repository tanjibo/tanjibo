<?php
namespace tan\error;
use tan\log\Log;
class Error{

	public function __construct(){
      error_reporting(0);

	}

	public function boostrap(){
		set_error_handler([$this,'error'],E_ALL);
		set_exception_handler([$this,'exception']);
		register_shutdown_function([$this,'fatalError']);
	}

	public function exception($e){
       var_dump($e->getMessage(),nl2br($e->__toString()));
	}

	public function fatalError(){
	   if(function_exists('error_get_last')){
		   if($e=error_get_last()){
                 $errno=$this->errorType($e['type']);
		   }
	   }
	}

	public function error($errno,$error,$file,$line){
     $msg= $errno.$error . $file . "($line)";

     (new Log)->write($msg,'ERROR');
	}

}
