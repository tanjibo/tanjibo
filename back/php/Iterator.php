<?php  

class sample implements Iterator{

	private $data=array(1,2,3,4,5,6,7);
	public function __construct () {

	}

	public function rewind () {
		return reset($this->data);
	}

	public function current () {
		return current($this->data);
	}

	public function key () {
		return key($this->data);
	}

	public function next () {
		return next($this->data);
	}

	public function valid(){
		return current($this->data);
	}
}
$sa=new sample();
foreach($sa as $key=>$val){
	echo $val;
}