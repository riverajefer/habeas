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
use App\Models\TipoRegistro;
use App\Models\DeviceRegistro;
use Excel;
use Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Collection;

class RegistrosController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        $this->middleware('perfil:voting', ['only'=>[
            'create', 'edit'
        ]]);

        $this->tipo_documento = collect([
            'Cédula de Ciudadanía',
            'NIT',
            'Tarjeta de Identidad',
            'Registro Civil',
            'Pasaporte',
            'Carné Diplomático',
        ]);

        $this->estado_cliente = collect([
            'Cliente Activo',
            'Cliente Inactivo'
        ]);
       
    }


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

        $user =  Auth::user();
        if(count($user->areasOperario()->first())==0 and count($user->areasResponsable()->first())==0){
             $registros = Registros::with('area')->get();

        }elseif($user->areasOperario()->first() || $user->areasResponsable()->first()){

            $registros = new Collection;
            $areas =  $user->areasOperario()->get();
            foreach($areas as $area){
                if($area->registros()->first())
                {
                    $registros = $registros->merge(Registros::with('area')->where('area_id', $area->id)->get());
                }
            }

            if($user->areasResponsable()->first()){
   
                
                $areasR =  $user->areasResponsable()->get();
                $registrosR = new Collection;

                foreach($areasR as $index => $area){
                    if($area->registros()->first())
                    {
                        if(count($registros)>0){
                            $registrosR = $registros->merge(Registros::with('area')->where('area_id', $area->id)->get());
                        }
                        else{
                            //return $area->id;
                             $registrosR  = $registrosR->merge(Registros::with('area')->where('area_id', $area->id)->get());
                        }                        
                                
                    }
                }  
                if(count($registrosR)>0){
                    $registros = $registrosR->unique();
                }
            }
        }else{
             $registros = Registros::with('area')->get();
        }

        return Datatables::of($registros)
            ->addColumn('action', function ($registros) {
                if($registros->area()->first()->m_operario->id == Auth::user()->id  || Auth::user()->id==73){

                    $view = '<a class="btn btn-link link-info"  href="registros/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="Ver más"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    $edit =  '<a class="btn btn-link link-warning" href="registros/'.$registros->id.'/edit" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                    if($registros->audits->first()){
                        $history = '<a class="btn btn-link"  href="registros/auditoria/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="Ver historial de cambios"><i class="fa fa-history" aria-hidden="true"></i></a>';
                    }else{
                        $history = '<a class="btn btn-link" disabled  href="registros/auditoria/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="No hay cambios"><i class="fa fa-history" aria-hidden="true"></i></a>';
                    }
                    if($registros->estado){
                        $delete = '<a class="btn btn-link link-danger" data-token="'.csrf_token().'"  data-toggle="tooltip" data-placement="top" onClick="eliminar('.$registros->id.')" title="Dar de baja"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    }else{
                        $delete = '';
                    }

                    return $view.''.$edit.''.$history.''.$delete;
                }else{
                    return '
                        <a class="btn btn-link link-info"  href="registros/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="Ver más"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }

            })
            ->editColumn('nombre', '<a href="registros/{{$id}}">{{$nombre}}</a>')
            ->addColumn('responsable', function ($registros) {
                return $registros->area()->first()->m_responsable->nombre;
            })->addColumn('operario', function ($registros) {
                return $registros->area()->first()->m_operario->nombre;
            })
            ->editColumn('estado', '{{$estado? "Activo":"Inactivo"}}')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $departamentos = Departamentos::all();
        $areas =  Auth::user()->areasOperario()->orderBy('titulo','ASC')->get();
        if(Auth::user()->id==73){
            $areas = Areas::orderBy('titulo','ASC')->get();
        }
        
        $tipo_registro = TipoRegistro::orderBy('titulo','ASC')->get();
        $tipo_documento = $this->tipo_documento;
        $estado_cliente = $this->estado_cliente;
        return view('registros.create', compact('departamentos', 'areas', 'tipo_registro', 'tipo_documento', 'estado_cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $this->validate($request,[
            'nombre'=>'required|string|max:80',
            'primer_apellido'=>'required|string|max:50',
            'segundo_apellido'=>'required|string|max:50',
            'tipo_documento'=>'required|string',
            'doc'=>'required|string|unique:registros|max:50',
            'fecha_nacimiento'=>'date',
            'email'=>'required|email|max:100',
            'celular'=>'numeric',
            'telefono_personal'=>'numeric',

            'area_id'=>'required',
            'profesion'=>'required|string|max:60',
            'cargo'=>'required|string|max:60',
            'empresa'=>'required|string|max:80',
            'telefono_corporativo'=>'numeric',
            'email_corporativo'=>'email|max:100',
            'celular_corporativo'=>'numeric',
            'departamento_id'=>'required',
            'municipio_id'=>'required',
            'direccion'=>'max:60',

            'sn'=>'max:80',
            //'asesor_comercial'=>'required',
            'estado_cliente'=>'required',
            'comentarios'=>'max:800',
            //'tipo_registro'=>'required',
            'archivo' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:10000',    
        ]);

        $soporte = '';
        if($request->soporte){
            $soporte = time().'.'.$request->soporte->getClientOriginalExtension();
            $request->soporte->move(public_path('uploads/soportes'), $soporte);
        }


        /*******************************
        Obtiene edad, con la fecha
        *******************************/
        $menor_a_18 = 0;
        if($request->input('fecha_nacimiento')){
            $menor_a_18 = 0;
            $edad = Carbon::parse($request->input('fecha_nacimiento'))->age;
            if($edad<18){
                $menor_a_18 = 1;
            }
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
        $registro->telefono_personal = $request->input('telefono_personal');
        $registro->archivo_soporte = $soporte;
        $registro->municipio_id = $request->input('municipio_id');
        $registro->area_id = $request->input('area_id');
        $registro->procedencia = $request->input('procedencia');
        $registro->creado_por = Auth::user()->id;
        $registro->menor_de_18 = $menor_a_18;

        $registro->sn = $request->input('sn');
        $registro->telefono_corporativo = $request->input('telefono_corporativo');
        $registro->celular = $request->input('celular');
        $registro->celular_corporativo = $request->input('celular_corporativo');
        $registro->email_corporativo = $request->input('email_corporativo');
        $registro->direccion = $request->input('direccion');
        $registro->comentarios = $request->input('comentarios');
        $registro->estado_cliente = $request->input('estado_cliente');
        $registro->tipo_registro = $request->input('tipo_registro');
        $registro->comentarios = $request->input('comentarios');
        $registro->estado = 1;
        $registro->save();

        $this->saveInfoAgent($registro->id, $request->input('ip'));

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
        $areas =  Auth::user()->areasOperario()->orderBy('titulo','ASC')->get();
        if(Auth::user()->id==73){
            $areas = Areas::orderBy('titulo','ASC')->get();
        }
        $tipo_registro = TipoRegistro::orderBy('titulo','ASC')->get();
        $tipo_documento = $this->tipo_documento;
        $estado_cliente = $this->estado_cliente;
        
        return view('registros.edit', compact('registro','departamentos', 'areas','tipo_registro', 'tipo_documento', 'estado_cliente'));

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
            'nombre'=>'required|string|max:80',
            'primer_apellido'=>'required|string|max:50',
            'segundo_apellido'=>'required|string|max:50',
            'tipo_documento'=>'required|string',
            'doc'=>'required|string|unique:registros,id,'.$id,
            'fecha_nacimiento'=>'date',
            'email'=>'required|email|max:100',
            'celular'=>'numeric',
            'telefono_personal'=>'numeric',

            'area_id'=>'required',
            'profesion'=>'required|string|max:60',
            'cargo'=>'required|string|max:60',
            'empresa'=>'required|string|max:80',
            'telefono_corporativo'=>'numeric',
            'email_corporativo'=>'email|max:100',
            'celular_corporativo'=>'numeric',
            'departamento_id'=>'required',
            'municipio_id'=>'required',
            'direccion'=>'max:60',

            'sn'=>'max:80',
            //'asesor_comercial'=>'required',
            'estado_cliente'=>'required',
            'comentarios'=>'max:800',
            //'tipo_registro'=>'required',
            'estado_registro'=>'required',
            'archivo' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:10000',    
        ]);


        /*******************************
        Obtiene edad, con la fecha
        *******************************/
        $menor_a_18 = 0;
        if($request->input('fecha_nacimiento')){
            $menor_a_18 = 0;
            $edad = Carbon::parse($request->input('fecha_nacimiento'))->age;
            if($edad<18){
                $menor_a_18 = 1;
            }
        }

        $soporte = $request->input('archivo_soporte');
        if($request->soporte){
            $soporte = time().'.'.$request->soporte->getClientOriginalExtension();
            $request->soporte->move(public_path('uploads/soportes'), $soporte);
            $soporte = $soporte;
        }

        $baja_por = 0;
        if($request->input('estado_registro')==0){
            $baja_por = Auth::user()->id;
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
        $registro->telefono_personal = $request->input('telefono_personal');
        $registro->archivo_soporte = $soporte;
        $registro->municipio_id = $request->input('municipio_id');
        $registro->area_id = $request->input('area_id');
        $registro->menor_de_18 = $menor_a_18;
        $registro->sn = $request->input('sn');
        $registro->telefono_corporativo = $request->input('telefono_corporativo');
        $registro->celular = $request->input('celular');
        $registro->celular_corporativo = $request->input('celular_corporativo');
        $registro->email_corporativo = $request->input('email_corporativo');
        $registro->direccion = $request->input('direccion');
        $registro->comentarios = $request->input('comentarios');
        $registro->estado_cliente = $request->input('estado_cliente');
        $registro->tipo_registro = $request->input('tipo_registro');
        $registro->comentarios = $request->input('comentarios');
        $registro->modificado_por = Auth::user()->id;
        $registro->estado = $request->input('estado_registro'); // esto tiene que venir dinamico
        $registro->baja_por = $baja_por;
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
     * Toggle Dar de baja el registro the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function darDebaja(Request $request)
    {

        $registro = Registros::find($request->input('id'));
        $registro->estado = 0;
        $registro->baja_por = Auth::user()->id;
        $registro->save();
        sleep(2);
        return response()->json([
            'status' => true,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveInfoAgent($registro_id, $ip)
    {
        $agent = new Agent();
        $platform = $agent->platform();
        $version  = $agent->version($platform);

        $tipo_device = '';

        if($agent->isMobile()){
            $tipo_device = 'Mobile';
        }elseif($agent->isTablet()){
            $tipo_device = 'Tablet';
        }else{
            $tipo_device = 'Desktop';
        }

        $deviceRegistro = new DeviceRegistro();
        $deviceRegistro->registro_id = $registro_id;
        $deviceRegistro->SO = $platform;
        $deviceRegistro->SO_version = $version;
        $deviceRegistro->device = $agent->device();
        $deviceRegistro->browser = $agent->browser();
        $deviceRegistro->ip = $ip;
        $deviceRegistro->tipo_device = $tipo_device;
        $deviceRegistro->pais = geoip()->getLocation($ip)->country;
        $deviceRegistro->Departamento = geoip()->getLocation($ip)->state_name;
        $deviceRegistro->ciudad = geoip()->getLocation($ip)->city;
        $deviceRegistro->ubicacion = geoip()->getLocation($ip)->lat.', '.geoip()->getLocation($ip)->lon;
        $deviceRegistro->save();

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

        //$registros = Registros::all();
        //return view('registros.excel', compact('registros'));

        $excel = \App::make('excel');

        Excel::create('Registros', function($excel) {
 
            $excel->sheet('Registros', function($sheet) {


                $user =  Auth::user();
                if(count($user->areasOperario()->first())==0 and count($user->areasResponsable()->first())==0){
                    $registros = Registros::with('area')->get();

                }elseif($user->areasOperario()->first() || $user->areasResponsable()->first()){

                    $registros = new Collection;
                    $areas =  $user->areasOperario()->get();
                    foreach($areas as $area){
                        if($area->registros()->first())
                        {
                            $registros = $registros->merge(Registros::with('area')->where('area_id', $area->id)->get());
                        }
                    }

                    if($user->areasResponsable()->first()){
        
                        $areasR =  $user->areasResponsable()->get();
                        $registrosR = new Collection;

                        foreach($areasR as $index => $area){
                            if($area->registros()->first())
                            {
                                if(count($registros)>0){
                                    $registrosR = $registros->merge(Registros::with('area')->where('area_id', $area->id)->get());
                                }
                                else{
                                    //return $area->id;
                                    $registrosR  = $registrosR->merge(Registros::with('area')->where('area_id', $area->id)->get());
                                }                        
                                        
                            }
                        }  
                        if(count($registrosR)>0){
                            $registros = $registrosR->unique();
                        }
                    }
                }else{
                    $registros = Registros::with('area')->get();
                }


                $sheet->freezeFirstRow();
                $sheet->setAutoFilter('A1:AH1');
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

        $user =  Auth::user();

        if(count($user->areasOperario()->first())==0 and count($user->areasResponsable()->first())==0){

             $registros = Registros::with('area')->get();

        }elseif($user->areasOperario()->first() || $user->areasResponsable()->first()){
            

            $registros = new Collection;
            $areas =  $user->areasOperario()->get();
            foreach($areas as $area){
                if($area->registros()->first())
                {
                    $registros = $registros->merge(Registros::with('area')->with('area.m_responsable')->with('area.m_operario')->with('municipio')->with('municipio.ndepartamento')->with('creadoPor')->with('modificadoPor')->with('tipoRegistro')->where('area_id', $area->id)->get());
                }

            }

            if($user->areasResponsable()->first()){
                
                $areasR =  $user->areasResponsable()->get();
                $registrosR = new Collection;

                foreach($areasR as $index => $area){
                    if($area->registros()->first())
                    {
                        if(count($registros)>0){
                            $registrosR = $registros->merge(Registros::with('area')->with('area.m_responsable')->with('area.m_operario')->with('municipio')->with('municipio.ndepartamento')->with('creadoPor')->with('modificadoPor')->with('tipoRegistro')->where('area_id', $area->id)->get());
                        }
                        else{
                             $registrosR  = $registrosR->merge(Registros::with('area')->with('area.m_responsable')->with('area.m_operario')->with('municipio')->with('municipio.ndepartamento')->with('creadoPor')->with('modificadoPor')->with('tipoRegistro')->where('area_id', $area->id)->get());
                        }                        
                                
                    }
                }  
                if(count($registrosR)>0){
                    $registros = $registrosR->unique();
                }
            }
        }else{
             $registros = Registros::with('area')->with('area.m_responsable')->with('area.m_operario')->with('municipio')->with('municipio.ndepartamento')->with('creadoPor')->with('modificadoPor')->with('tipoRegistro')->get();
        }


        return Datatables::of($registros)
            ->addColumn('action', function ($registros) {

                if($registros->area()->first()->m_operario->id == Auth::user()->id  || Auth::user()->id==73){
                    return 
                        '<a href="../registros/'.$registros->id.'/edit">
                        <button class="mdl-button mdl-js-button mdl-button--primary">
                            Actualizar
                        </button></a>
                        <a href="../registros/'.$registros->id.'">
                        <button class="mdl-button mdl-js-button mdl-button--primary">
                            Ver
                        </button></a>
                        <button data-dismiss="modal" class="mdl-button mdl-js-button mdl-button--accent">
                            Cancelar
                        </button>';                    
                }else{
                    return '<a href="../registros/'.$registros->id.'">
                        <button class="mdl-button mdl-js-button mdl-button--primary">
                            Ver
                        </button></a>';
                }

            })
            ->editColumn('nombre', '<a href="../registros/{{$id}}">{{$nombre}}</a>')
            ->editColumn('soporte', '<a data-fancybox data-caption="Soporte" href="{{URL::to("uploads/soportes/$archivo_soporte")}}"> {{ $archivo_soporte? "soporte" : ""  }} </a>')
            ->addColumn('modificado_por', function ($registros) {
                return $registros->modificadoPor? $registros->modificadoPor->nombre: '';
            })
            ->editColumn('menor_de_18', '{{ $menor_de_18 ? "SI":"NO" }}')
            ->editColumn('estado', '{{ $estado ? "Activo":"Inactivo" }}')
            ->editColumn('comentarios', '{{str_limit($comentarios,50)}}')
            ->removeColumn('password')->make(true);
    }



    /**
     * AUDITORIA
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auditoria($id)
    {
        //return "Auditoria:  ".$id;
        $registro  = Registros::findOrFail($id);
        $auditoria = $registro->audits()->with('user')->get();
        //return count($auditoria[0]->old_values);
        return view('registros.auditoria.index', compact('auditoria'));
    }




    /**
     * DESCARGA DEPARTAMENTOS EN EXCEL
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function excelMunicipios()
    {
        $areas = Areas::select('id', 'titulo')->get();
        $mun   = Municipios::all();
     
        $ciudades = new Collection;

        foreach($mun as $mun){
            $ciudades->push(
                ['ID'=>$mun->id, 'Departamento'=>$mun->ndepartamento->nombre, 'Municipio'=>$mun->nombre_municipio]
            );
        }

        return Excel::create('Ciudades_Areas', function($excel) use ($ciudades, $areas) {

			$excel->sheet('Ciudades', function($sheet) use ($ciudades)
	        {
                $sheet->setAutoFilter('A1:C1');
                $sheet->freezeFirstRow();
				$sheet->fromArray($ciudades);
	        });
            
            // Our second sheet
            $excel->sheet('Areas', function($sheet) use ($areas) {
                $sheet->freezeFirstRow();
                $sheet->fromArray($areas);
            });            

		})->download();


    }


    /**
     * SUBIDA MASIVA
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subidaMasiva()
    {
        return view('registros.subida_masiva');
    }


    /**
     * POST SUBIDA MASIVA
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postSubidaMasiva(Request $request)
    {

        /*
        Campos:
        Que toca asociar
        Departamento
        Ciudad
        Area
        Asesor comercial ?

        Descargar Areas, departamentos, Ciudaddes en Excel

        */

        if($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                return $data;

                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        //$insert[] = ['title' => $value, 'description' => $value];
                        $insert[] = ['title' => $value->title, 'description' => $value->description];
                    }
                    if(!empty($insert)){
                        //DB::table('items')->insert($insert);
                        return $insert;
                        dd('Insert Record successfully.');
                    }
                }
            }


        //return $request->all();
        return dd($request->file('file')->getRealPath());
        return dd($request->hasFile('file'));
    }


}
