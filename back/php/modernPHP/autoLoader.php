<?php
use curl\Tan;
include(__DIR__.'/AutoLoader.class.php');
modernPHP\AutoLoader::register(true);
new Tan();exit;
trait SayWorld {
    public function sayHello() {
      echo __TRAIT__;
    }
}

class a{
	use SayWorld;
	function ass(){

	}
}
(new a)->sayHello();
