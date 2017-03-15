<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RolMiddleware
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

        return $next($request);
        return abort('403');
        return $request->all();
        if(Auth::user()->id==2){
            return $next($request);
        }else{
            return redirect('/');
        }

    }
}
