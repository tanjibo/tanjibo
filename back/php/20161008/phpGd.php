<?php
$url = 'http://www.baidu.com/'; //抓取百度
echo snapshot($url);  //输出结果为图片地址
echo snapshot($url, './baidu.png'); //将图片保存至本地baidu.png, 输出内容图片大小

/**
 * 生成网页快照
 * @param   string  $site   目标地址
 * @param   string  $path   保存地址, 为空则不保存
 * @param   integer $dealy  延迟
 * @return  mixed   根据参数返回
 */
function snapshot($site, $path = '', $dealy = 0)
{
    $url   = 'http://ppt.cc/yo2/catch.php';
    $query = 'url=' . $site . '&delay=' . $dealy . '&rnd=' . mt_rand(1, 9);
    $ch    = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);


    if (strlen($data) != 32) {
        exit('无效网址');
    }


    $file = $data{0} . '/' . $data{1} . '/' . $data{2} . '/';
    $file = 'http://cache.ppt.cc/' . $file . 'src_' . $data . '.png';


    if (!empty($path)) {
        $data = file_get_contents($file);
        return file_put_contents($path, $data);
    }
    return $file;
}