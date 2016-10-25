<?php

try {
 $pdo=new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');

} catch (PDOException $e) {
	echo $e->getMessage();
}

$pdo->beginTransaction();
