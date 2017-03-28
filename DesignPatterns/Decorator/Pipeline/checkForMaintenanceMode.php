<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午4:48
 */
namespace Pipeline;

class CheckForMaintenanceMode implements Middleware
{
    public static function handle($request, Closure $next)
    {
        echo $request . ': Check if the application is in the maintenance status.' . PHP_EOL;
        $next($request);
    }
}