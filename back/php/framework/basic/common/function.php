<?php

/**
 * 打印函数
 * @param  [type] $var [description]
 * @return [type]      [description]
 */
function p($var){
  echo "<pre>";
  echo print_r($var,true);
  echo "</pre>";
}
