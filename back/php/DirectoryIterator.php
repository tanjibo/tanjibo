<?php
//不显示子目录的文件
$path =new DirectoryIterator(__DIR__);
foreach($path as $file){
	//echo $file.'<br/>';
}

$path=new RecursiveDirectoryIterator(__DIR__);
foreach($path as $file){
	echo $file -> getPathname().'<br/>';
}