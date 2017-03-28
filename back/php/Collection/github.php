<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/15
 * Time: 下午8:52
 */

require 'vendor/autoload.php';

$data=collect(json_decode(file_get_contents('tanjibo.json'),true));

$data->pluck('type')->map(function($type){

    return collect(['aa'=>1])->get($type,1);

});