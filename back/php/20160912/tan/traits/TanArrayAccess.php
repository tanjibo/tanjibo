<?php
//tanjibo@gmail.com
namespace tan\traits;

trait TanArrayAccess{

	public function offsetSet($key,$value){
		 $this->data[$key]=$value;
	}

	public function offsetGet($key){
      return  isset($this->data[$key])?$this->data[ $key ]:null;
	}

	public function offsetExists($key){
       return isset($this->data[$key]);
	}

	public function offsetUnset($key){
		if(isset($this->data[$key])){
			unset($this->data[ $key ]);
		}
	}
	\
}
