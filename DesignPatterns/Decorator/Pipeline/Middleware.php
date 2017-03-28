<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午4:47
 */
namespace  Pipeline;
interface Middleware
{
    public static function handle($request, Closure $closure);
}
