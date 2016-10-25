<?php 
header('content-type:text/html;charset=utf-8');
require 'vendor/autoload.php';
require 'Config.php';
use QL\QueryList;

class Constellation{
	//星座
    private $star=''; 
    //类型 今日运势  本周运势  本月运势
    private $type=""; 
    //根地址
    private $baseUrl="http://www.xzw.com/fortune";
    //地址
    private $url=""; 
    //redis instance 
    private static $redisInstance=null;
    //配置项
    private $config='';


    /**
     *  初始化
     * @param [type] $star [星座类型]
     * @param [type] $type [地址类型]
     */
	public function __construct($star,$type){
     $this->star = isset($star)?$star:'';
     $this->type= isset($type) ? $type : "";
     $this->config=new Config();
     //获取url
     $this->getUrl($this->type);
     //连接redis
     $this->redisInstance();
      
	}

    /**
     * 获取今日运势 本周运势  本月运势 地址
     * 1 : 今天运势
     * 2 : 本周运势
     * 3 : 本月运势
     */
	private  function getUrl($type=''){
        switch ($type) {
        	case '2':
        		$this->url=$this->baseUrl.'/'.$this->star.'/2.html';
        		break;
        	case '3':
        		$this->url=$this->baseUrl.'/'.$this->star.'/3.html';
        		break;
        	default:
        		$this->url= $this->baseUrl.'/'.$this->star.'/';
        		break;
        }
	}

   /**
    * 连接redis
    */
	private function redisInstance(){
        $redisConf=$this->config['redis'];
        try{
 
             if(!self::$redisInstance){

                $redis = new redis();
                $ret = $redis->connect($redisConf['host'],$redisConf['port'],$redisConf['timeout']);
                if(!$ret)
                     throw new Exception('redis 连接错误');

                 self::$redisInstance=$redis;
              }

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
	}
    
    /**
     * 输出十二星座的数据
     */
    public function outConstellationData(){
      $starArr=$this->config['star'];
      $this->vendor('10000','success',$starArr);
    }

    /**
     * 根据日期输出星座
     */
    public function outDateToConsData($date="04/20"){
     $starArr=$this->config['star'];
     foreach ($starArr as $k => $v){

       list($start,$end) = explode('-', $v['time']);
       
        if(date($start) <= date($date) && date($date) <= date($end))
         $this->vendor(10000,'success',$starArr[$k]);
        
    }
     $this->vendor(10001,'error');
    }
   /**
    * 获取数据
    */
   public function outData(){

    $redis=self::$redisInstance;
    //组合redis key
    $key=date('ymd').'_'.$this->star.'_dataType_'.$this->type;
    if($redis->exists($key)){
       $this->vendor(10000,'success',json_decode($redis->get($key),true));
    }else{
       $this->vendor(10000,'success',$this->_getStarData($key));
    
   }
}

   private  function _getStarData($redisKey){

   	$redis=self::$redisInstance;

   $data=QueryList::Query($this->url,array(
    //各项指数
	"exponent"=>array('dl dd ul','html','',function($html){
		//获取html
     $doc= phpQuery::newDocumentHTML($html);
        //获得整个列表
     $lis=pq($doc)->find('li');

     foreach($lis as $key=>$li){
     	//获取标题
     	$title=mb_substr(pq($li)->find('label')->text(),0,-1);

     	$tmp[$title]['title']=$title;
        //获取内容
     	if(pq($li)->find('span')->html()){
     		preg_match('/\d+/',pq($li)->find('span')->html(),$arr);
             $content=$arr[0];

     	}else{
     		pq($li)->find('label')->remove();
     		$content=pq($li)->text();
           
     	}
     	   $tmp[$title]['content']=$content;
     }
        return $tmp;
	}),
    'fortune'=>array('.c_cont p:nth(0) span','text','',function($content){
       return mb_convert_encoding($content,'utf-8','gbk');
    })
	),'.c_main','UTF-8','gbk',true)->getData();
     $returnArr=$data[0]['exponent'];
    $returnArr['title']='fortune';
    $returnArr['content']=$data[0]['fortune'];
  try {
        $is=$redis->setex($redisKey,3600*24,json_encode($returnArr));
        if(!$is) throw new Exception("数据redis写入失败");
     } catch (Exception $e) {
          throw new Exception($e->getMessage());
     }
       return $returnArr;
   }

   /**
    * 输出数据
    */
   private function vendor($status='10000',$message="success",$data=[]){
    header('Content-Type:application/json; charset=utf-8');
     exit(json_encode([
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
        ]));
   }

}

$data=new Constellation('taurus','2');
$data->outDateToConsData();


