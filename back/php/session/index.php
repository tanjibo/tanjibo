<?php

class sessionHanderFile
{

    public  $path='';

    public function db()
    {
        $user = 'root';
        $pass = '';
        try {
            $dbh = new PDO( 'mysql: host=localhost;dbname=hd', $user, $pass, [
                PDO::ATTR_PERSISTENT => true,// 持久化连接
            ] );

            return $dbh;
        } catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }


    /**
     * @return bool  相当于一个构造函数，session_start 第一个调用的函数
     */
    function open( $path, $sessionName )
    {
        $this->path = $path;
        is_dir( $this->path ) or mkdir( $this->path, 0777, true );

        return true;
    }

    /**
     * 类似于析构函数
     */
    function close()
    {
        return true;
    }

    function read( $id )
    {
        if(!is_file($this->path."/sess_$id")) return false;
        return file_get_contents( $this->path . "/sess_$id" );
    }

    function write( $id, $data )
    {
        return file_put_contents( $this->path . "/sess_$id", $data ) === false ? false : true;
    }

    function destroy( $id )
    {
        $file = $this->path . "/sess_$id";
        if (is_file( $file )) {
            unlink( $file );
        }

        return true;
    }

    function gc( $lifetime )
    {
        foreach(glob($this->path.'/sess_*') as $file){
            if(filemtime($file)+$lifetime<time() && file_exists($file)) unlink($file);
        }
        return true;
    }

    function create_sid(){
        return substr(sha1(microtime(true).mt_rand(0,1000)),0,5);
    }
}
 $handle=new sessionHanderFile();
session_save_path( '/Users/tanjibo/Desktop/learnGit' );
session_set_save_handler(
    [$handle,'open'],
    [$handle,'close'],
    [$handle,'read'],
    [$handle,'write'],
    [$handle,'destroy'],
    [$handle,'gc'],
    [$handle,'create_sid']
);
ini_set('session.gc_divisor',1);
ini_set('session.gc_maxlifetime',1);

//下面这行代码可以防止使用对象为会话保存管理器时可能引发的非预期行为
register_shutdown_function('session_write_close');

//ini_set("session.use_cookies", 0);
//ini_set("session.use_trans_sid", 1);
session_start();
setcookie(session_name(),session_id(),3600,'/');
//if (isset($_SESSION["foo"])) {
//    echo "Foo: " . $_SESSION["foo"];
//} else {
//    $_SESSION["foo"] = "Bar";
//    echo "<a href=?" . session_name() . "=" . session_id() . ">Begin test</a>";
//}
//$_SESSION['a']='tanjibo';
//var_dump($_SESSION['a']);
// session_destroy();
