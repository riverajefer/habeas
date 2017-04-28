<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\HElpers\MyFuncs;

class RolePermisosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guest()) {
            return redirect($urlOfYourLoginPage);
        }

        $puede = MyFuncs::usuarioRolPuede($permission);
        if(!$puede){
            abort(403);
        }


        /*
        if (! $request->user()->hasRole($role)) {
        abort(403);
        }
        
        
        if (! $request->user()->can($permission)) {
        abort(403);
        }
        */

        return $next($request);
    }
}
