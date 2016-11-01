<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
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
//         dump($request->input('user'));
//        dump($request);
//         if($request->input('')<=200){
////             return redirect('foo');
//         }
        return $next($request);
    }
}
