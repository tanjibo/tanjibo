<?php
/**
 * 数据库操作类
 */
 $username="root";
 $pass='';
 $dbh=new PDO('mysql:host=localhost;dbname=test',$username,$pass,[PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8']);
 $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $sth=$dbh->prepare('select * from activity_draw  where user_id = :user_id and product_id = :product_id');
 $user_id=1;
 $product_id='11111';
 $sth->bindParam(':user_id',$user_id,PDO::PARAM_INT);
 $sth->bindParam(':product_id',$product_id,PDO::PARAM_STR);
 $sth->execute();
 print_r($sth->fetchAll()?:[]);
