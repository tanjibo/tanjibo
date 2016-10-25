<?php

echo "-------php://input-----<br/>";
var_dump(@file_get_contents('php://input'));
$data=file_get_contents('php://input');
var_dump(json_decode($data ,true));
echo "-------post-----<br/>";
var_dump($_POST);
echo "-------server-----<br/>";
var_dump($_SERVER);
exit;
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,'http://www.baidu.com');
curl_setopt($ch,CURLOPT_HEADER,true);
curl_exec($ch);
curl_close($ch);
