<?php 
// function getRange($max=10){
// 	$arr=[];
// 	for($i=0;$i<=$max;$i++){
// 		$arr[$i]=$i;
// 	}
// 	return $arr;
// }

// foreach(getRange(15) as $range){
// 	echo "Dataset {$range}<br/>";
// }


echo "Generators==================";
function  getRange($max=100){
	$arr=[];
	for($i=0;$i<=$max;$i++){
		$injected= yield $i =>($i*mt_rand());
		if($injected==='stop') return;
	}
}
 $get=getRange(PHP_INT_MAX);
foreach($get as $key=>$range){
      if($key==1000){
      	$get->send('stop');
      }
	echo "dataset {$key}===>{$range}<br/>";
}