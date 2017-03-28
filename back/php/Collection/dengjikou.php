<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/15
 * Time: 下午8:30
 */

require 'vendor/autoload.php';

$gates=[

    'baiyun_a_a17',
    'bj_j7',
    'shang_k203',
    'ha_a157',
    'a2',
    'by_b_b230'
];

$aa=collect($gates)->map(function($i){
//    $data=explode('_',$i);
//    return end($data);
    return collect(explode('_',$i))->last();
});
var_dump($aa);