<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午4:50
 */
namespace  Pipeline;
class StartSession implements Middleware
{
    public static function handle($request, Closure $next)
    {
        echo $request . ': Start session of this request.' . PHP_EOL;
        $next($request);
        echo $request . ': Close session of this response.' . PHP_EOL;
    }
}