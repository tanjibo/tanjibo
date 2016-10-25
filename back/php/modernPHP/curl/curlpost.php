<?php
function curl_post($url, $data){
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		 'Content-Type:application/json;charset=utf-8',
		 'Content-Length:'.strlen($data)
	 ));
     $output = curl_exec($ch);
     curl_close($ch);
     return $output;
}

$params = array();
$params['username'] = 'ben';
$params['password'] = 'lalala';
print_r(curl_post('http://localhost/modernPHP/curl/curl.php',json_encode($params)));
exit;
$params = array();
$params['username'] = urlencode('ben');
$params['password'] = urlencode('lalala');
$paramsStr = "username={$params['username']}&password={$params['password']}";
print_r(curl_post('http://localhost/modernPHP/curl/curl.php', $paramsStr));
