<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午5:48
 */

namespace DesignPatterns\Creational\AbstractFactroy;

class HtmlFactory extends  AbstractFactory{

    public function createText ( $content )
    {
        return new Html\Text($content);
    }

    public function createPicture ( $path, $name = '' )
    {
        return new Html\Picture($path,$name);
    }

}