<?php  

if($_SERVER['HTTP_HOST'] =="localhost"){
	return [
                 'host'=>'localhost',
			     'port'=>'6379',
			     'timeout'=>1,

	     ];
}else{
	return [
                 'host'=>'m15396.redis.internal.chuchujie.com',
			     'port'=>'15396',
			     'timeout'=>1,
	];
}