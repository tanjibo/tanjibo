<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午5:52
 */

namespace  DesignPatterns\Creational\AbstractFactroy;

abstract  class Picture implements  MediaInterface{
   protected  $path;

    protected  $name;
    public function __construct ($path,$name)
    {
        $this->name=$name;
        $this->path=$path;
    }
}