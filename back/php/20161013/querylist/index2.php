<?php 
$astroDir = './';
$astroArray = array (
		'白羊座' => array('aries', '03/21-04/19'),
		'金牛座' => array('taurus', '04/20-05/20'),
		'双子座' => array('gemini', '05/21-06/21'),
		'巨蟹座' => array('cancer', '06/22-07/22'),
		'狮子座' => array('leo', '07/23-08/22'),
		'处女座' => array('virgo', '08/23-09/22'),
		'天秤座' => array('libra', '09/23-10/23'),
		'天蝎座' => array('scorpio', '10/24-11/22'),
		'射手座' => array('sagittarius', '11/23-12/21'),
		'魔羯座' => array('capricorn', '12/22-01/19'),
		'水瓶座' => array('aquarius', '01/20-02/18'),
		'双鱼座' => array('pisces', '02/19-03/20')
);

function generateAstro(){
	global $astroDir, $astroArray;
	$fileLog = $astroDir.'.log';
	$log = is_file($fileLog) ? json_decode(file_get_contents($fileLog)) : false;
	if(!isset($log->latestTime) || $log->latestTime < date('Y-m-d')){
		foreach($astroArray as $astro){
			preg_match('/<span>(.*?)<em>(.*?)<\/em><\/span>.*?有效日期:(.*?)综合运势(.*?)爱情运势(.*?)工作状况(.*?)理财投资(.*?)健康指数(.*?)商谈指数(.*?)幸运颜色(.*?)幸运数字(.*?)速配星座(.*?)<div class="lotconts">(.*?)<\/div>/isu', curl('http://vip.astro.sina.com.cn/astro/view/'.$astro[0].'/day/', $astro[0]), $matches);
			file_put_contents($astroDir.$astro[0].'.dat', json_encode(array($matches[1], $matches[2], html2txt($matches[3]), substr_count($matches[4], '<img'), substr_count($matches[5], '<img'), substr_count($matches[6], '<img'), substr_count($matches[7], '<img'), html2txt($matches[8]), html2txt($matches[9]), html2txt($matches[10]), html2txt($matches[11]), html2txt($matches[12]), $matches[13])));
		}
		file_put_contents($fileLog, json_encode(array('latestTime' => html2txt($matches[3]))));
		unset($matches);
	}
}

function getAstroByDate($date){
	global $astroArray;
	foreach ($astroArray as $k => $v){
		$value = explode('-', $v[1]);
		if(date($value[0]) <= date($date) && date($date) <= date($value[1])){
			return $k;
		}
	}
	return '魔羯座';
}

function html2txt($document){
	$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
			'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
			'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
			'@<![\s\S]*?--[ \t\n\r]*>@',         // Strip multi-line comments including CDATA
			'@\s+|&nbsp;@'
	);
	$text = preg_replace($search, '', $document);
	return $text;
}

function curl($url, $type){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, 'http://astro.sina.com.cn/fate/astro_'.$type.'.html?prourl=0');
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/'.mt_rand(2, 9).'.0 (Windows NT 6.1; WOW64; rv:'.mt_rand(10, 30).'.0) Gecko/'.mt_rand(2000, 2014).'0101 Firefox/'.mt_rand(10, 30).'.0');
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function isBirthDate($date)
{
	if (empty($date) || $date == '0000-00-00')
		return false;
	if (preg_match('/^([0-9]{4})-((?:0?[1-9])|(?:1[0-2]))-((?:0?[1-9])|(?:[1-2][0-9])|(?:3[01]))([0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $date, $birth_date))
	{
		return ($birth_date[1].'-'.$birth_date[2].'-'.$birth_date[3] <= date('Y-m-d'));
	}
	return false;
}


//http://my.oschina.net/cart/
var_dump(isBirthDate('2012-02-05'));//验证生日是否真实有效
var_dump(getAstroByDate('02-05'));//根据日期获得星座名称

generateAstro();//每天只采集1次星座数据
var_dump(json_decode(file_get_contents($astroDir.'.log')));//获得当前星座内容的时间
//http://my.oschina.net/cart/
$string = "我是PHP程序员：ssbbcc";
$ff = explode("：",$string);
echo '<pre>';
print_r($ff);
echo '</pre>';exit;
header('content-type:text/html;charset=utf-8');
require 'vendor/autoload.php';
use QL\QueryList;
$hj = QueryList::Query('http://www.xzw.com/fortune/leo/2.html',array(
	"one"=>array('.p1','text'),
	"two"=>array('.p1 + span','text'),
	"one1"=>array('.p2','html'),
	"two1"=>array('.p2 + span','text'),
	
	
	),'.c_box','utf-8','gbk',true);
$data = $hj->getData(function($x){
   return $x;
});
echo "<pre>";
print_r($data);