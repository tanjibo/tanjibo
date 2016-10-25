<?php

namespace App\Http\Middleware;

use Closure;

class CreateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         $data=$request->all();
        
         $data['create_time']=time();
        return $next($request);
    }
}
