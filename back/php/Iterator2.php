<?php 
 // class TestIterator{

 // 	public $name="PHP";
 // 	protected $sex='man';
 // 	private $age=20;
 // }

 // $testIterator=new TestIterator();
 // foreach($testIterator as $key=>$v){
 // 	echo $key.':'.$v.PHP_EOL;
 // }
 // 
 class TestCollection implements IteratorAggregate{
 	private $composerPackage;
 	public function __construct($composerPackage=[]){
 		$this->composerPackage=$composerPackage;
 	}
 	public function getIterator(){
 		return new ArrayIterator($this->composerPackage);
 	}
 }
 	$test=new TestCollection([
        'symfony/http-foundation',
        'symfony/http-kernel',
        'guzzle/guzzle',
        'monolog/monolog',
 		]);
 	foreach($test as $key=>$value){
 		echo $key.':'.$value.PHP_EOL;
 	}
 