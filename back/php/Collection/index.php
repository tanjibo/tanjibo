<?php 
require 'vendor/autoload.php';
$data=[
 [
 'aaa_a',
 'bbb_a_d',
 'A2',
 'order_product'=>[
   ['order_id'=>1,'price'=>333],
   ['order_id'=>2,'price'=>555]
 ]],
     [
         'aaa_a',
         'bbb_a_d',
         'A2',
         'order_product'=>[
             ['order_id'=>1,'price'=>333],
             ['order_id'=>2,'price'=>555],
         ]
 ]
];

$total=collect($data)->pluck('order_product')->flatten(1)->sum('price');
echo $total;