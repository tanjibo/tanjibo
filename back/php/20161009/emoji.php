<?php 

//吧emoji数据存入数据库中
function p($var){
  echo "<pre>";
  print_r($var);	
}
 mb_internal_encoding('gbk');
 echo mb_strlen("😁😭😍都是对的😄");exit;

try{
$user="root";
$pass='';
$dbh = new PDO('mysql:host=localhost;dbname=local', $user, $pass);
//$sql= "INSERT INTO emoji (`username`) values (?)";
$sql ='select unhex(username) from emoji';
$stm=$dbh->prepare($sql);
$stm->execute();
$result=$stm->fetchAll(PDO::FETCH_COLUMN,0);
p($result);

}catch(PDOException $e){
	echo $e->getMessage();
}
