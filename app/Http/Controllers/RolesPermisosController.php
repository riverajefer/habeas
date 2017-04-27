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
     * Tabla usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles()
    {

        $roles = Role::all();
        $permisos = Permission::all();
        $usuarios = collect();
        $modU =  ModulosUsers::where('idmodfunc_t21',21)->get();
        foreach($modU as $value){
            $usuarios->push($value->users);
        }
        return view('roles_permisos.roles', compact('usuarios', 'roles', 'permisos'));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id_departamento
     * @return \Illuminate\Http\Response
     */
     public function saveRol(Request $request){

          $this->validate($request,[
            'roles'=>'required',
         ]);         

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
         $permisos =  $request->input('permisos');
         $user_id = $request->input('user');
         $user = User::find($user_id);
         $user->syncPermissions($permisos);
         return redirect('usuarios')->with('success', 'Permisos asignados correctamente');
     }


    /**
     * Display the specified resource.
     *
     * @param  int  $id_departamento
     * @return \Illuminate\Http\Response
     */
     public function savePermisosRol(Request $request){

         $this->validate($request,[
             'permisos'=>'required',
         ]); 

         $permisos =  $request->input('permisos');
         $rol_id = $request->input('rol');
         $rol = Role::find($rol_id);
         $rol->syncPermissions($permisos);
         return redirect('roles')->with('success', 'Permisos asignados correctamente');
     }


}
