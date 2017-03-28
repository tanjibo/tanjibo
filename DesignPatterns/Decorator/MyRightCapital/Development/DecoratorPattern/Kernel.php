<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午3:28
 */
namespace MyRightCapital\Development\DecoratorPattern;

class Kernel implements IKernel
{
    public function handle()
    {
        echo 'Kernel handle the request, and send the response.' . PHP_EOL;
    }
}
