<?php
namespace tan\log;

class Log{
    //日志信息
	public  $log = [];

	public function __construct(){
		$this->dir='system'.DS.'log';
		is_dir( $this->dir ) or mkdir( $this->dir, 0755, TRUE );
	}

   //记录日志内容
	public function record( $message, $level = self::ERROR ){
		$this->log[] = date( '[ c ]' ) . "{$level}: {$message}".PHP_EOL;
	}

	public function save() {
		if ( $this->log ) {
			$file = $this->dir . '/' . date('d') .'log';
			error_log( implode( "", $this->log ), 3, $file, NULL);
		}
	}

   public function write($message, $level = self::ERROR ){
	$file = $this->dir . DS . date( 'Y_m_d' ) . '.log';
     error_log( date( "[ c ]" ) . "{$level}: {$message}" . PHP_EOL, 3, $file, NULL );
   }
}
