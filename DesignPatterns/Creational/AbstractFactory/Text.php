<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午5:52
 */

namespace  DesignPatterns\Creational\AbstractFactroy;


abstract  class Text implements  MediaInterface{
    
    protected  $text;
    
    public function __construct ($text)
    {
        $this->text=$text;
    }
}