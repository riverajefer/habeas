<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests;
use App\Models\User;
use App\Models\ModulosUsers;
use Illuminate\Support\Collection;

class RolesPermisosController extends Controller
{

     /**
     * Tabla usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::all();
        $permisos = Permission::all();
        $usuarios = collect();
        $modU =  ModulosUsers::where('idmodfunc_t21',21)->get();
        foreach($modU as $value){
            $usuarios->push($value->users);
        }
        return view('roles_permisos.index', compact('usuarios', 'roles', 'permisos'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_departamento
     * @return \Illuminate\Http\Response
     */
     public function saveRol(Request $request){
         //return $request->all();
         $roles =  $request->input('roles');
         $user_id = $request->input('user');
         $user = User::find($user_id);
         $user->syncRoles($roles);
         return redirect('usuarios')->with('success', 'Roles asignados correctamente');

     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_departamento
     * @return \Illuminate\Http\Response
     */
     public function savePermisos(Request $request){
         //return $request->all();
         $permisos =  $request->input('permisos');
         $user_id = $request->input('user');
         $user = User::find($user_id);
         $user->syncPermissions($permisos);
         //$user->givePermissionTo($permisos);
         return redirect('usuarios')->with('success', 'Permisos asignados correctamente');

     }

}
