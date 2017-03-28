<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午5:59
 */
namespace  DesignPatterns\Creational\AbstractFactroy\Json;

use DesignPatterns\Creational\AbstractFactroy\Text as BaseText;

class Text extends  BaseText{

    public function render ()
    {
       return json_encode(['content'=>$this->text]);
    }
}