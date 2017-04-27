<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RolePermisosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission)
    {
        if (Auth::guest()) {
            return redirect($urlOfYourLoginPage);
        }

        $user = $request->user();
        $roles = $user->roles;
        $permisos = [];
        $pasa = false;
        foreach($roles as $rol){
            $permisos[] =  $rol->permissions;
            if(count($rol->permissions) >0){
                foreach($rol->permissions as $permiso){
                    if($permiso->name == $permission){
                        $pasa = true;
                    }
                }
            }
        }

        if(!$pasa){
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
