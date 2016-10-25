<?php 

if(is_readable('.env') && is_file('.env')){
	ini_set('auto_detect_line_endings',true);
	var_dump(file('.env',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}