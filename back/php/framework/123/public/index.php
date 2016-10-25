<?php  


require '../vendor/autoload.php';
$klein = new \Klein\Klein();

$klein->respond("GET",'/aa', function() {
         echo 'this also works';
     });
echo 111;exit;
$klein->dispatch();
