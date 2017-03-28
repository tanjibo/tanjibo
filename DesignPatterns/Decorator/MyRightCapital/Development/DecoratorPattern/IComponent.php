<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午2:51
 */
namespace MyRightCapital\Development\DecoratorPattern;

interface IComponent extends IMiddleware
{
    public function getRequest();
}