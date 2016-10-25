<?php
$arr=[
	'tanjibo'=>
	[
		'bar'=>'dtdd',
		'name'=>"谈际波",
		'aaa'=>['ch'=>"份额访问到十点多"]
	]
];
echo json_encode($arr,JSON_UNESCAPED_UNICODE);exit;
array_walk_recursive($arr, function(&$value){
	$value=urlencode($value);
});
echo  urldecode(json_encode($arr));
