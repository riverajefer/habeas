<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Registros;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $page)
    {

        if($page == 'areas'){
            if ( !(count(Auth::user()->areasResponsable()->first())==0  && count(Auth::user()->areasOperario()->first())==0) ){
                 return redirect('registros');
             }else{
                return $next($request);
             }
        }else if($page == 'registros'){

            $segment =  $request->segments()[1];
            $user = Auth::user();

            // Evento crear
            if($segment=='create'){

                if($user->areasOperario()->first() || (count($user->areasOperario()->first())==0 and count($user->areasResponsable()->first())==0) ){
                    return $next($request);
                }else{
                    return redirect('/');
                }

            }else{ // Evento modificar

                // Si tiene permiso para modificar el registro o es administrador
                $registro = Registros::findOrFail($segment);
                if($registro->area()->first()->m_operario->id == $user->id  || (count($user->areasOperario()->first())==0 and count($user->areasResponsable()->first())==0)){
                    return $next($request);
                }else{
                    return redirect('/'); 
                }
            }
        }else{
            //
        }
                
        //return abort('403');

    }
}
