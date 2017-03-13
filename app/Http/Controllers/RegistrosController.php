<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 
use App\Http\Requests;
use App\Models\Registros;
use Datatables;
use App\Models\Areas;
use App\Models\Departamentos;
use App\Models\Municipios;
use App\Models\User;
use Excel;
use Auth;


class RegistrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('registros.index');
    }


    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function dataRegistros()
    {
        //$registros = Registros::query();
        $registros = Registros::with('area')->get();

        return Datatables::of($registros)
            ->addColumn('action', function ($registros) {
                return '
                    <a class="btn btn-link link-info"  href="registros/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="Ver más"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a class="btn btn-link link-warning" href="registros/'.$registros->id.'/edit" data-toggle="tooltip" data-placement="top" title="Modificar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a class="btn btn-link link-danger" data-toggle="tooltip" data-placement="top" title="Dar de baja"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
            })        
            ->editColumn('nombre', '<a href="registros/{{$id}}">{{$nombre}}</a>')
            ->removeColumn('password')->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamentos::all();
        $areas = Areas::orderBy('titulo','ASC')->get();
        return view('registros.create', compact('departamentos', 'areas'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'nombre'=>'required|string',
            'primer_apellido'=>'required|string',
            'segundo_apellido'=>'required|string',
            'tipo_documento'=>'required|string',
            'doc'=>'required|string|unique:registros',
            'email'=>'required|email',
            'email_corporativo'=>'required|email',
            'fecha_nacimiento'=>'required|date',
            'profesion'=>'required|string',
            'cargo'=>'required|string',
            'empresa'=>'required|string',
            'telefono'=>'required|numeric',
            'area_id'=>'required',
            'departamento_id'=>'required',
            'municipio_id'=>'required',
            'archivo' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:10000',            
        ]);

        $soporte = '';
        if($request->soporte){
            $soporte = time().'.'.$request->soporte->getClientOriginalExtension();
            $request->soporte->move(public_path('uploads/soportes'), $soporte);
        }


        /*******************************
        Calucla edad, con la fecha
        *******************************/
        $menor_a_18 = false;
        $edad = Carbon::parse($request->input('fecha_nacimiento'))->age;
        if($edad<18){
            $menor_a_18 = true;
        }

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
        $registro->archivo_soporte = $soporte;
        $registro->municipio_id = $request->input('municipio_id');
        $registro->area_id = $request->input('area_id');
        $registro->procedencia = $request->input('procedencia');
        $registro->creado_por = Auth::user()->id;
        $registro->menor_de_18 = $menor_a_18;
        $registro->estado = 1;
        $registro->save();

        return redirect('registros')->with('success','Registro creado correctamente');

    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = Registros::findOrFail($id);
        return view('registros.show', compact('registro'));
    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $registro = Registros::findOrFail($id);
        $departamentos = Departamentos::all();
        $areas = Areas::orderBy('titulo','ASC')->get();
        return view('registros.edit', compact('registro','departamentos', 'areas'));        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nombre'=>'required|string',
            'primer_apellido'=>'required|string',
            'segundo_apellido'=>'required|string',
            'tipo_documento'=>'required|string',
            'doc'=>'required|string|unique:registros'.$id,
            'email'=>'required|email',
            'fecha_nacimiento'=>'required|date',
            'profesion'=>'required|string',
            'cargo'=>'required|string',
            'empresa'=>'required|string',
            'telefono'=>'required|numeric',
            'area_id'=>'required',
            'departamento_id'=>'required',
            'municipio_id'=>'required',
            'archivo' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:10000',            
        ]);

        $soporte = $request->input('archivo_soporte');


        if($request->soporte){
            $soporte = time().'.'.$request->soporte->getClientOriginalExtension();
            $request->soporte->move(public_path('uploads/soportes'), $soporte);
            $soporte = $soporte;
        }

        $registro = Registros::findOrFail($id);
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
        $registro->archivo_soporte = $soporte;
        $registro->municipio_id = $request->input('municipio_id');
        $registro->area_id = $request->input('area_id');
        $registro->procedencia = $request->input('procedencia');
        $registro->estado = 1;
        $registro->modificado_por = Auth::user()->id;
        $registro->save();

        return redirect('registros')->with('success','Registro actualizado correctamente');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id_departamento
     * @return \Illuminate\Http\Response
     */
    public function municipios(Request $request)
    {
        return $departamentos = Departamentos::findOrFail($request->input('id'))->municipios()->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportExcel()
    {

        $excel = \App::make('excel');

        Excel::create('Registros', function($excel) {
 
            $excel->sheet('Registros', function($sheet) {

                $registros = Registros::all();
                $sheet->freezeFirstRow();
                $sheet->loadView('registros.excel')->with('registros', $registros);
 
            });
        })->export('xls');
    }


    /**
     * TABLA COMPLETA 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tablaCompleta()
    {
        return view('registros.tabla_completa');
    }


    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function dataRegistrosTablaCompleta()
    {
        //$registros = Registros::query();
        $registros = Registros::with('area')->with('municipio')->with('municipio.ndepartamento')->with('creadoPor')->with('modificadoPor')->get();

        return Datatables::of($registros)
            ->addColumn('action', function ($registros) {
                return '
                    <a class="btn btn-xs btn-link link-info"  href="registros/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="Ver más"><i class="fa fa-cog" aria-hidden="true"></i></a>';
            })
            ->editColumn('nombre', '<a href="registros/{{$id}}">{{$nombre}}</a>')
            ->editColumn('soporte', '<a data-fancybox data-caption="Soporte" href="{{URL::to("uploads/soportes/$archivo_soporte")}}"> {{ $archivo_soporte? "soporte" : ""  }} </a>')
            //->editColumn('modificado_por.nombre', '{{$modificado_por? "$modificado_por->nombre": ""}}')
            ->addColumn('modificado_por', function ($registros) {
                return $registros->modificadoPor? $registros->modificadoPor->nombre: '';
            })            
            ->removeColumn('password')->make(true);
    }



}
