<?php
header('content-type:text/html;charset=utf-8');
//根目录
define('ROOT_PATH',__DIR__);
//分割线
define('DS',DIRECTORY_SEPARATOR);

require(ROOT_PATH.'/tan/Loader.php');

$loader= new \tan\Loader;

$loader->register();

(new \tan\kernel\App)->init();
