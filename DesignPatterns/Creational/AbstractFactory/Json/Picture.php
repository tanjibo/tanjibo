<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午5:56
 */
namespace  DesignPatterns\Creational\AbstractFactroy\Json;

use DesignPatterns\Creational\AbstractFactroy\Picture as BasePicture;


class Picture extends  BasePicture{

    public function render(){
      return json_encode(array('title'=>$this->name,'path'=>$this->path));
    }
}