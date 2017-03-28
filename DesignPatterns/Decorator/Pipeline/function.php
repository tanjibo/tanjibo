<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午4:52
 */
function getSlice()
{
    return function ($stack, $pipe) {
        return function ($passable) use ($stack, $pipe) {
            /**
             * @var Middleware $pipe
             */
            return call_user_func_array([$pipe, 'handle'], [$passable, $stack]);
        };
    };
}

function dispatchToRouter()
{
    return function ($request){
        echo $request . ': Send Request to the Kernel, and Return Response.' . PHP_EOL;
    };
}
