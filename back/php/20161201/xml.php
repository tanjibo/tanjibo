<?php 
header('Content-type:text/xml;charset=utf-8');
$data=array('a'=>'1111','b'=>'2222','c'=>'2222');

$xml=new simpleXMLElement('<xml></xml>');
foreach($data as $key=>$v){
 $dom=$xml->addChild($key);
 $node=dom_import_simplexml($dom);
  $cdata=$node->ownerDocument->createCDATASection($v);
  $node->appendChild($cdata);
}

echo $xml->asXML();




