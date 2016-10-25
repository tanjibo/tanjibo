<?php
error_reporting(0);
/**
*致命错误
*/
register_shutdown_function('fataError');
set_exception_handler('exception');

function exception(){
	echo 1111;
}
function fataError(){
    if(function_exists('error_get_last')){
		if($e=error_get_last()){
			print_r($e);
		}
	}
}
の33
