<?php  

require 'vendor/autoload.php';
 use Qiniu\Auth;
  use Qiniu\Storage\BucketManager;

  $accessKey = 'lFAiqxZLRzVcgtfGzAEXx34BwOKKqzkNYa0mtZ42';
  $secretKey = '0cNv5OJtI5dfh7T3tIpnX08AvQ07FBzPaDl37Cn8';
  $auth = new Auth($accessKey, $secretKey);
$bucketMgr = new BucketManager($auth);
  // 空间名  http://developer.qiniu.com/docs/v6/api/overview/concepts.html#bucket
  $bucket = 'githubimg';

  // 要列取的空间名称
// $bucket = 'Bucket_Name';

// 要列取文件的公共前缀
$prefix = '';

$marker = '';
$limit = 3;

list($iterms, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
if ($err !== null) {
    echo "\n====> list file err: \n";
    var_dump($err);
} else {
    echo "Marker: $marker\n";
    echo "\nList Iterms====>\n";
    var_dump($iterms);
}


