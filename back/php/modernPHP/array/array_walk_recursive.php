<?php


$data=['dddd','ddd','dddd'];

array_walk_recursive($data,  function($value,$key){

	 var_dump($value);
	  var_dump($key);
});
