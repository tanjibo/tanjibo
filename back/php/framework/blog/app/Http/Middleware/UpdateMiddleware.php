<?php

namespace App\Http\Middleware;

use Closure;

class UpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * $next: Closure(匿名函数), 该函数把 request 对象传递给后续的 middleware.
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $data=$request->all();
         
        return $next($request);
    }
}
