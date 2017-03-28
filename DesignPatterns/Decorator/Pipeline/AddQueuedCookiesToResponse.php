<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午4:49
 */
namespace Pipeline;
class AddQueuedCookiesToResponse implements Middleware
{
    public static function handle($request, Closure $next)
    {
        $next($request);
        echo $request . ': Add queued cookies to the response.' . PHP_EOL;
    }
}