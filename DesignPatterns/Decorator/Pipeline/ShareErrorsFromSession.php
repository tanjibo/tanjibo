<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午4:50
 */
namespace  Pipeline;
class ShareErrorsFromSession implements Middleware
{
    public static function handle($request, Closure $next)
    {
        $next($request);
        echo $request . ': Share the errors variable from response to the views.' . PHP_EOL;
    }
}