<?php
 namespace tan\traits;

 trait TanIterator{

	 public function current(){
       return current($this->data);
	 }

	 public function key(){
          return key($this->data);
	 }

	 public function next(){
          return next($this->data);
	 }
	 public function rewind(){
          reset($this->data);
	 }

	 public function valid(){
        return current($this->data);
	 }
 }
