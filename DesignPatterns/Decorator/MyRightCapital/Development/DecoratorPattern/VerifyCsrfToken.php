<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午2:50
 */
namespace MyRightCapital\Development\DecoratorPattern;

class VerifyCsrfToken implements IMiddleware
{
    /**
     * @var \MyRightCapital\Development\DecoratorPattern\IMiddleware
     */
    private $middleware;

    /**
     * VerifyCsrfToken constructor.
     *
     * @param \MyRightCapital\Development\DecoratorPattern\IMiddleware $middleware
     */
    public function __construct(IMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    public function handle()
    {
        echo 'Verify csrf token when post request.' . PHP_EOL;
        $this->middleware->handle();
    }
}