<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午2:40
 */
namespace MyRightCapital\Development\DecoratorPattern;

interface  IMiddleware{
    public function handle();
}