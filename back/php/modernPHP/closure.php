<?php

        $con='activity';
       $method = 'add';
       $_token="chuchujie_activity";
       $token = sha1($con.date('Y-m-d',time()).$_token.$method);
       echo $token;exit;
function httpPost($url,$params = array(), $build_query =false,$referer=''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPGET, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if( !empty($params) ) {
        if( $build_query ) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);                //文件上传时不能用build_query
        }
    }
//        $password = md5('atraXCskRmj2Nqt6');
//        $cookie = 'user_name=culiu_huodong_7362;user_passwd='.$password.';';
//        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    $ret = curl_exec($ch);
    var_dump($ret);
    curl_close($ch);

    return $ret;
}
$data=[
    'user_id'=>1,
    'order_info'=>[
         [
        'order_sn'=>111,
        'product_info'=>'11111#11,22222#11'
         ],
         [
        'order_sn'=>111,
        'product_info'=>'11111#11,22222#11'
         ],

],
];
echo count($data,true);exit;
$url="http://huodong-dev.chuchujie.com/activity/callback.php?c=Activity&m=add&token=b1ec9515f302cc9955ac6e183d57a64adad27569";
httpPost($url,json_encode($data));
exit;
$_tmp=array();
$_data=array();
$productTotalNum=0;
foreach($data['order_info'] as $k=>$v){
    $product_info=explode(',', $v['product_info']);
    foreach($product_info as $_k=>$_v){
        $_tmp[$k][$_k]['user_id']=$data['user_id'];
        $_tmp[$k][$_k]['order_sn']=$v['order_sn'];
        list($_tmp[$k][$_k]['product_id'],$_tmp[$k][$_k]['product_num'])=explode('#',$_v);
      $_data[]=$_tmp[$k][$_k];
      $productTotalNum+=$_tmp[$k][$_k]['product_num'];
    }
}
print_r($productTotalNum);

exit;
$controller='activity';
$method="add";
$prefix="chuchujie_activity"; #固定参数
$token=sha1($controller.date('Y-m-d',time()).$prefix.$method);
echo $token;exit;
$mystring='tanjibo';
$findme='ta';
$pos=strpos($mystring,$findme);
//0 == false  true
//0 === false false
//这个函数会返回0，所以检查的时候要用全等
if($pos === false){
    echo 11;
}


exit;












/**
 * @param $name
 * @return Closure
 * php 闭包必须在结尾处加一个;
 */
echo phpinfo();exit;
function encloseperson($name){
    return function ($docommand) use ($name){
        return sprintf('%s,%s',$name,$docommand);
    };
}
exit;
$func = function(){
    exit('Hello world!!');
};//这里必须要有;结尾
$func();
var_dump($func);


function makeRange($len){
    for($i=0;$i<$len;$i++){
        yield($i);
    }
}

foreach(makeRange(10) as $v){
    echo $v;
}
