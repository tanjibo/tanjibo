<?php  
$dirpath=__DIR__;
globDir($dirpath);

/**
 * 遍历目录
 */
function globDir( $dirpath ){
  foreach( glob($dirpath.'/*')  as  $v ){
    if(is_dir($v)){
    	globDir($v);
    } else{
    	echo $v.'<br/>';
    	echo "<pre>";
    	var_dump(pathinfo($v)['filename']);
    }
  }
}
