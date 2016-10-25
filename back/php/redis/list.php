<?php
require('vendor/autoload.php');
\Predis\Autoloader::register();

$client= new Predis\Client();
$client->set('foo','ddd');
$data=$client->hmset('tanjibo',array('dddd','ddd'));
print_r($data);