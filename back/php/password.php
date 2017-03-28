<?php 

$token='tanjibo';
$password=md5($token);
//echo $password;

//可以传 sha256,sha512,md5,sha1
$password=hash('sha256',$token);
echo $password;


function generateHashWithSalt($password) {
    $intermediateSalt = md5(uniqid(rand(), true));
    $salt = substr($intermediateSalt, 0, 6);
    return hash("sha256", $password . $salt);
}
// Bcrypt 其实就是Blowfish和crypt()函数的结合，我们这里通过CRYPT_BLOWFISH判断Blowfish是否可用，然后像上面一样生成一个盐值，不过这里需要注意的是，crypt()的盐值必须以$2a$或者$2y$开头
function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
    }
}
// password_hash() – 对密码加密.
// password_verify() – 验证已经加密的密码，检验其hash字串是否一致.
// password_needs_rehash() – 给密码重新加密.
// password_get_info() – 返回加密算法的名称和一些相关信息.
// 
// 这里需要注意的是，如果你代码使用的都是PASSWORD_DEFAULT加密方式，那么在数据库的表中，password字段就得设置超过60个字符长度，你也可以使用PASSWORD_BCRYPT，这个时候，加密后字串总是60个字符长度。
$hash=password_hash($token,PASSWORD_DEFAULT);
// $options = [
//     'salt' => custom_function_for_salt(), //write your own code to generate a suitable salt
//     'cost' => 12 // the default cost is 10
// // ];
// echo custom_function_for_salt();exit;
// $hash = password_hash($password, PASSWORD_DEFAULT, $options);
// echo $hash;
if(password_verify($token,$hash)){
	echo 'true';
}