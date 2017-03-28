<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午2:47
 */
namespace  MyRightCapital\Development\DecoratorPattern;
class AddQueuedCookiesToResponse implements IMiddleware{
   private  $middleware;
   public function __construct(IMiddleware $middleware)
   {
       $this->middleware=$middleware;
   }

    public function handle()
    {
        $this->middleware->handle();
        echo 'Add queued cookies to the response' . PHP_EOL;
    }
}