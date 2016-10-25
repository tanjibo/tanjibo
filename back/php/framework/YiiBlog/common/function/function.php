<?php

/**
 * 打印函数
 * @param  [type] $val [description]
 * @return [type]      [description]
 */
function p($val){
   echo '<pre>';
   echo print_r($val,true);
   echo "</pre>";
}
