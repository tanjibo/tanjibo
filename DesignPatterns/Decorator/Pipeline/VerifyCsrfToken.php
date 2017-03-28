<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午4:51
 */
namespace  Pipeline;
class VerifyCsrfToken implements Middleware
{
    public static function handle($request, Closure $next)
    {
        echo $request . ': Verify csrf token when post request.' . PHP_EOL;
        $next($request);
    }
}