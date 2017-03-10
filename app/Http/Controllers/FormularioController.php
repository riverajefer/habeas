<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Registros;
use App\Models\Areas;
use App\Models\Departamentos;
use App\Models\Municipios;
use App\Models\User;


class FormularioController extends Controller
{

    /**
     * Store a new user.
     * @param  String  $slug
     * @return \Illuminate\View\View
     */
     public function formulario($slug='publico'){

        $area = Areas::whereSlug($slug)->first();
        
        if(!empty($area)){
            $departamentos = Departamentos::all();
            return view('formularios_publico.index', compact('departamentos', 'area', 'slug'));
        }else{
            abort(404);
        }
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_departamento
     * @return \Illuminate\Http\Response
     */
     public function guardarFormulario(Request $request){


        $this->validate($request,[
            'nombre'=>'required|string',
            'primer_apellido'=>'required|string',
            'segundo_apellido'=>'required|string',
            'tipo_documento'=>'required|string',
            'doc'=>'required|string|numeric',
            'email'=>'required|email',
            'fecha_nacimiento'=>'required|date',
            'profesion'=>'required|string',
            'cargo'=>'required|string',
            'empresa'=>'required|string',
            'telefono'=>'required|numeric',
            'departamento_id'=>'required',
            'municipio_id'=>'required',
        ]);


        $registro = New Registros();
        $registro->nombre = $request->input('nombre');
        $registro->primer_apellido = $request->input('primer_apellido');
        $registro->segundo_apellido = $request->input('segundo_apellido');
        $registro->tipo_documento = $request->input('tipo_documento');
        $registro->doc = $request->input('doc');
        $registro->email = $request->input('email');
        $registro->fecha_nacimiento = $request->input('fecha_nacimiento');
        $registro->profesion = $request->input('profesion');
        $registro->cargo = $request->input('cargo');
        $registro->empresa = $request->input('empresa');
        $registro->telefono = $request->input('telefono');
        $registro->municipio_id = $request->input('municipio_id');
        $registro->procedencia = $request->input('procedencia');
        $registro->creado_por = 'Usuario_'.$request->input('procedencia');
        $registro->area_id = $request->input('area_id');
        $registro->estado = 1;
        $registro->save();

        return back()->with('success','Gracias: Registro creado correctamente');





     }

}
