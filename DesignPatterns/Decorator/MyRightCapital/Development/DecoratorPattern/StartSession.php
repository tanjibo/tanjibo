<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午2:48
 */
namespace MyRightCapital\Development\DecoratorPattern;

class StartSession implements IMiddleware
{
    /**
     * @var \MyRightCapital\Development\DecoratorPattern\IMiddleware
     */
    private $middleware;

    /**
     * StartSession constructor.
     *
     * @param \MyRightCapital\Development\DecoratorPattern\IMiddleware $middleware
     */
    public function __construct(IMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    public function handle()
    {
        echo 'Start session of this request.' . PHP_EOL;
        $this->middleware->handle();
        echo 'Close session of this request.' . PHP_EOL;
    }
}