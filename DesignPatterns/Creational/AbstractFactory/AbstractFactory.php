<?php
namespace DesignPatterns\Creational\AbstractFactroy;

/**
 * Class AbstractFactory
 * 抽象工厂类
 */
abstract  class AbstractFactroy{

    /**
     * 创建文本主键
     */
    abstract  public function createText($content);

    /**
     * @param $path
     * @param string $name
     * 创建文本主键
     */
    abstract  public function createPicture($path,$name='');

}