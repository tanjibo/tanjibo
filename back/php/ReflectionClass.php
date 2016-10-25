<?php
class A{
    public $aa="111";
    public $cc = 'dd';
   function __construct(){
   	echo 1112;
   }
}

class_alias('A','B');

$z=new ReflectionClass('B');
echo $z->getName(); //获得类名称

$pro=$z -> getDefaultProperties();
var_dump($pro);
