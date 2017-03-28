<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午6:00
 */

namespace  DesignPatterns\Creational\AbstractFactroy\Html;

use DesignPatterns\Creational\AbstractFactroy\Picture as BasePicture;

class Picture extends  BasePicture{

    public  function render ()
    {
        return sprintf('<img src="%s" title="%s"/>',$this->path,$this->name);
    }
}