<?php
//class A{
//    public $aa="111";
//    public $cc = 'dd';
//   function __construct(){
//   	echo 1112;
//   }
//}
//
//class_alias('A','B');
//
//$z=new ReflectionClass('B');
//echo $z->getName(); //获得类名称
//
//$pro=$z -> getDefaultProperties();
//var_dump($pro);

class Student
{
    public $id;

    public $name;
    const MAX_AGE = 200;
    public static $likes = [];
    public function __construct($id, $name = 'li')
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function study()
    {
        echo 'learning...';
    }
    private function _foo()
    {
        echo 'foo';
    }
    protected function bar($to, $from = 'zh')
    {
        echo 'bar';
    }
}

$class= new ReflectionClass('Student');

if($class->isInstantiable()){

}
$attr=$class->getProperties();
foreach($attr as $key=>$v){
    echo $v->getName();
}