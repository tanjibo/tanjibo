<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午5:46
 */
  namespace DesignPatterns\Creational\AbstractFactory;

class JsonFactory  extends  AbstractFactory{

    public function createPicture ( $path, $name = '' )
    {
        return new Json\Picture($path,$name);
    }

    public function createText ( $content )
    {
        return new Json\Text($content);
    }
}