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
use DB;
use File;
use Mail;
use Validator;
use Jenssegers\Agent\Agent;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Collection;
use App\HElpers\MyFuncs;
use Response;
class RegistrosController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('role:crear registros', ['only'=>['create', 'store']]);  
        $this->middleware('role:ver registros',   ['only'=>['index', 'show']]);
        $this->middleware('role:modificar registros',   ['only'=>['edit']]);

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
        $areas = $user->areas;

        $registros = new Collection;
        foreach($areas as $area){
            $registros = $registros->merge($area->registros);
        }

        return Datatables::of($registros)
            ->addColumn('action', function ($registros) {
                    $view = '<a class="btn btn-link link-info"  href="registros/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="Ver más"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    $edit =  '';
                    $puede = MyFuncs::usuarioRolPuede('modificar registros');

                    if($puede){
                        $edit =  '<a class="btn btn-link link-warning" href="registros/'.$registros->id.'/edit" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                    }

                    $history = '<a class="btn btn-link" href="registros/auditoria/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="No hay cambios"><i class="fa fa-history" aria-hidden="true"></i></a>';

                    $delete = '';
                    if($registros->estado and MyFuncs::usuarioRolPuede('dar de baja registro') ){
                        $delete = '<a class="btn btn-link link-danger" data-token="'.csrf_token().'"  data-toggle="tooltip" data-placement="top" onClick="eliminar('.$registros->id.')" title="Dar de baja"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    }

                    return $view.''.$edit.''.$history.''.$delete;
            })
            ->editColumn('nombre', '<a href="registros/{{$id}}">{{$nombre}}</a>')
            ->addColumn('area', function ($registros) {
                return $registros->area->titulo;
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
        if(count(Auth::user()->areasResponsable()->first())==0  && count(Auth::user()->areasOperario()->first())==0){
            $areas = Areas::orderBy('titulo','ASC')->get();
        }
        
        $tipo_registro = TipoRegistro::orderBy('titulo','ASC')->get();
        $tipo_documento = $this->tipo_documento;
        $estado_cliente = $this->estado_cliente;
        $asesores = $this->asesores();
        return view('registros.create', compact('departamentos', 'areas', 'tipo_registro', 'tipo_documento', 'estado_cliente', 'asesores'));
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
            'archivo' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:10000|uploaded',    
        ]);

        $soporte = NULL;
        if($request->soporte){
            $soporte = time().'.'.$request->soporte->getClientOriginalExtension();
            $request->soporte->move(public_path('uploads/soportes'), $soporte);
        }


        /*******************************
        Obtiene edad, con la fecha
        *******************************/
        $menor_a_18 = 0;
        $fecha_nacimiento = NULL;
        if($request->input('fecha_nacimiento')){
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $menor_a_18 = 0;
            $edad = Carbon::parse($fecha_nacimiento)->age;
            if($edad<18){
                $menor_a_18 = 1;
            }
        }

        $sn = NULL;
        if($request->input('sn')){
            $sn = $request->input('sn');
        }        

        $registro = New Registros();
        $registro->nombre = $request->input('nombre');
        $registro->primer_apellido = $request->input('primer_apellido');
        $registro->segundo_apellido = $request->input('segundo_apellido');
        $registro->tipo_documento = $request->input('tipo_documento');
        $registro->doc = $request->input('doc');
        $registro->email = $request->input('email');
        $registro->fecha_nacimiento = $fecha_nacimiento;
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
        $registro->sn = $sn;
        $registro->telefono_corporativo = $request->input('telefono_corporativo');
        $registro->celular = $request->input('celular');
        $registro->celular_corporativo = $request->input('celular_corporativo');
        $registro->email_corporativo = $request->input('email_corporativo');
        $registro->direccion = $request->input('direccion');
        $registro->comentarios = $request->input('comentarios');
        $registro->estado_cliente = $request->input('estado_cliente');
        $registro->tipo_registro = $request->input('tipo_registro');
        $registro->comentarios = $request->input('comentarios');
        $registro->asesor_comercial = $request->input('asesor_comercial');
        $registro->estado = 1;
        
        $registro->save();

        $this->enviaNotificacion($registro, 'Nuevo Registro');
        $this->saveInfoAgent($registro->id, $request->input('ip'));


        return redirect('registros')->with('success','Registro creado correctamente.')->with('registro_id', $registro->id);
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
        if(count(Auth::user()->areasResponsable()->first())==0  && count(Auth::user()->areasOperario()->first())==0){
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
        //return $request->all();

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
            'archivo' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:10000|uploaded',    
        ]);


        /*******************************
        Obtiene edad, con la fecha
        *******************************/
        $menor_a_18 = 0;
        $fecha_nacimiento = NULL;
        if($request->input('fecha_nacimiento')){
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $menor_a_18 = 0;
            $edad = Carbon::parse($fecha_nacimiento)->age;
            if($edad<18){
                $menor_a_18 = 1;
            }
        }

        $sn = NULL;
        if($request->input('sn')){
            $sn = $request->input('sn');
        }  

        $soporte = NULL;
        if($request->soporte){
            $soporte = time().'.'.$request->soporte->getClientOriginalExtension();
            $request->soporte->move(public_path('uploads/soportes'), $soporte);
            $soporte = $soporte;
        }

        $baja_por = NULL;
        if(!$request->input('estado_registro')){
            $baja_por = Auth::user()->id;
        }

        $tipo_registro = 0;
        if($request->input('tipo_registro')){
            $tipo_registro = $request->input('tipo_registro');
        }        

        $registro = Registros::findOrFail($id);
        $registro->nombre = $request->input('nombre');
        $registro->primer_apellido = $request->input('primer_apellido');
        $registro->segundo_apellido = $request->input('segundo_apellido');
        $registro->tipo_documento = $request->input('tipo_documento');
        $registro->doc = $request->input('doc');
        $registro->email = $request->input('email');
        $registro->fecha_nacimiento = $fecha_nacimiento;
        $registro->profesion = $request->input('profesion');
        $registro->cargo = $request->input('cargo');
        $registro->empresa = $request->input('empresa');
        $registro->telefono_personal = $request->input('telefono_personal');
        $registro->archivo_soporte = $soporte;
        $registro->municipio_id = $request->input('municipio_id');
        $registro->area_id = $request->input('area_id');
        $registro->menor_de_18 = $menor_a_18;
        $registro->sn = $sn;
        $registro->telefono_corporativo = $request->input('telefono_corporativo');
        $registro->celular = $request->input('celular');
        $registro->celular_corporativo = $request->input('celular_corporativo');
        $registro->email_corporativo = $request->input('email_corporativo');
        $registro->direccion = $request->input('direccion');
        $registro->comentarios = $request->input('comentarios');
        $registro->estado_cliente = $request->input('estado_cliente');
        $registro->tipo_registro = $tipo_registro;
        $registro->comentarios = $request->input('comentarios');
        $registro->modificado_por = Auth::user()->id;
        $registro->estado = $request->input('estado_registro'); // esto tiene que venir dinamico
        $registro->baja_por = $baja_por;
        $registro->asesor_comercial = $request->input('asesor_comercial');
        $registro->save();

        $this->enviaNotificacion($registro, 'Modificación Registro');

        return redirect('registros')->with('success','Registro actualizado correctamente')->with('registro_id', $registro->id);

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
        $this->enviaNotificacion($registro, 'Registro dado de baja');
        sleep(1);
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
                $areas = $user->areas;

                $registros = new Collection;
                foreach($areas as $area){
                    $registros = $registros->merge($area->registros);
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
        $areas = $user->areas;

        $registros = new Collection;
        foreach($areas as $area){
            $registros = $registros->merge(Registros::with('area')->with('area.m_responsable')->with('area.m_operario')->with('municipio')->with('municipio.ndepartamento')->with('creadoPor')->with('modificadoPor')->with('tipoRegistro')->where('area_id', $area->id)->get());
        }


        return Datatables::of($registros)
            ->addColumn('action', function ($registros) {

                return '<a href="../registros/'.$registros->id.'">
                    <button class="mdl-button mdl-js-button mdl-button--primary">
                        Ver
                    </button></a>';

            })
            ->editColumn('nombre', '<a href="../registros/{{$id}}">{{$nombre}}</a>')
            ->editColumn('soporte', '<a data-fancybox data-caption="Soporte" href="{{URL::to("uploads/soportes/$archivo_soporte")}}"> {{ $archivo_soporte? "soporte" : ""  }} </a>')
            ->addColumn('modificado_por', function ($registros) {
                return $registros->modificadoPor? $registros->modificadoPor->nombre: '';
            })
            ->editColumn('menor_de_18', '{{ $menor_de_18 ? "SI":"NO" }}')
            ->editColumn('estado', '{{ $estado ? "Activo":"Inactivo" }}')
            ->editColumn('comentarios', '{{str_limit($comentarios,50)}}')->make(true);
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
        $tipo_registro = TipoRegistro::select('id', 'titulo')->get();
     
        $ciudades = new Collection;
        foreach($mun as $mun){
            $ciudades->push(
                ['ID'=>$mun->id, 'Departamento'=>$mun->ndepartamento->nombre, 'Municipio'=>$mun->nombre_municipio]
            );
        }

        return Excel::create('Ciudades_Areas', function($excel) use ($ciudades, $areas, $tipo_registro) {


            // sheet 2 Ciudades
			$excel->sheet('Ciudades', function($sheet) use ($ciudades)
	        {
                $sheet->setAutoFilter('A1:C1');
                $sheet->freezeFirstRow();
				$sheet->fromArray($ciudades);
	        });

            // sheet 3 Áreas
            $excel->sheet('Areas', function($sheet) use ($areas) {
                $sheet->freezeFirstRow();
                $sheet->fromArray($areas);
            });   

            // sheet 4 Tipo documento
            $excel->sheet('Tipo documento', function($sheet) {
                $sheet->freezeFirstRow();

                $tipo_documento = Array(
                    ['id'=>1,'Tipo documento'=>'Cédula de Ciudadanía'],
                    ['id'=>2,'Tipo documento'=>'NIT'],
                    ['id'=>3,'Tipo documento'=>'Tarjeta de Identidad'],
                    ['id'=>4,'Tipo documento'=>'Registro Civil'],
                    ['id'=>5,'Tipo documento'=>'Pasaporte'],
                    ['id'=>6,'Tipo documento'=>'Carné Diplomático'],
                );

                $sheet->fromArray($tipo_documento);
            });                        
            // sheet 3 Tipo Registros
            $excel->sheet('Tipo de Registro', function($sheet) use ($tipo_registro) {
                $sheet->freezeFirstRow();
                $sheet->fromArray($tipo_registro);
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
        // aca se puede hacer la validación $request->file('file')->getClientOriginalExtension();
        //return File::extension($request->file('file')->getRealPath());

        sleep(1);

        if($request->hasFile('file')){

                $path = $request->file('file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();
                $subida_id = Registros::max('subida_masiva_id') + 1;
                $count = 0;

                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {

                        $dataValidation = array(
                                'area_id'=>$value->id_area,
                                'id_ciudad'=>$value->id_ciudad,
                                'tipo_registro'=>$value->tipo_registro,
                                'nombre'=>$value->nombre,
                                'primer_apellido'=>$value->primer_apellido,
                                'segundo_apellido'=>$value->segundo_apellido,
                                'tipo_documento'=>$value->tipo_documento,
                                'doc'=>$value->documento,
                                'fecha_de_nacimiento'=>$value->fecha_de_nacimiento,
                                'email_personal'=>$value->email_personal,
                                'telefono_personal'=>$value->telefono_personal,
                                'celular_personal'=>$value->celular_personal,
                                'profesion'=>$value->profesion,
                                'cargo'=>$value->cargo,
                                'empresa'=>$value->empresa,
                                'telefono_corporativo'=>$value->telefono_corporativo,
                                'email_corporativo'=>$value->email_corporativo,
                                'celular_corporativo'=>$value->celular_corporativo,
                                'direccion'=>$value->direccion,
                                'sn'=>$value->sn,
                                'tipo_de_registro'=>$value->tipo_de_registro,
                                'menor_de_18'=>$value->menor_de_18,
                                'comentarios'=>$value->comentarios,
                                'estado_del_cliente'=>$value->estado_del_cliente,                                                                                   
                            );

                            $v = Validator::make($dataValidation, [
                                'email_personal' => 'required|email',
                                'area_id'        => 'required|exists:areas,id',
                                'tipo_registro'  => 'required|exists:tipo_registros,id',
                                'nombre'=>'required|string|max:80',
                                'primer_apellido'=>'required|string|max:50',
                                'segundo_apellido'=>'required|string|max:50',
                                'tipo_documento'=>'required|numeric',
                                //'doc'=>'required|numeric|unique:registros',
                                'doc'=>'required|numeric',
                                'fecha_de_nacimiento'=>'date',
                                'email_personal'=>'required|email|max:100',
                                'celular_personal'=>'numeric',
                                'telefono_personal'=>'numeric',
                                'profesion'=>'string|max:60',
                                'cargo'=>'string|max:60',
                                'empresa'=>'string|max:80',
                                'telefono_corporativo'=>'numeric',
                                'email_corporativo'=>'email|max:100',
                                'celular_corporativo'=>'numeric',
                                'id_ciudad'=>'required|exists:municipios,id',
                                'direccion'=>'max:60',
                                'sn'=>'max:80',
                                'estado_del_cliente'=>'max:10',
                                'comentarios'=>'max:800',
                            ]);

                            if ($v->fails()) {
                                return response()->json(['status' => false, 'errors'=>$v->errors()->all()]);
                            }
        
                            // validation tipo_documento
                            try {
                                $this->tipo_documento[$value->tipo_documento];
                            }
                            catch (\Exception $e)  {
                                $errors[0] = 'tipo_documento no existe en base de datos';
                                return response()->json(['status' => false, 'errors'=>$errors]);
                            }                    

                            // validation menor_18
                            if( !(is_numeric($value->menor_de_18) and ($value->menor_de_18==0 or $value->menor_de_18 == 1) and strlen($value->menor_de_18)==1)  ){
                                $errors[0] = 'menor_de_18 debe ser 1 o 0';
                                return response()->json(['status' => false, 'errors'=>$errors]);
                            } 

                            // validation estado_del_cliente
                            if( !(is_numeric($value->estado_del_cliente) and ($value->estado_del_cliente==0 or $value->estado_del_cliente == 1) and strlen($value->estado_del_cliente)==1)  ){
                                $errors[0] = 'estado_del_cliente debe ser 1 o 0';
                                return response()->json(['status' => false, 'errors'=>$errors]);
                            }

                            // validation asesores
                            /*
                            $asesores = Curl::to('http://190.145.89.228/annarnetp/index.php/prueba/index')->get(); // cambiar esta URL
                            $collect =  collect(json_decode($asesores, true));
                            $existe_asesor =  $collect->contains('SlpName',$value->asesor_comercial);
                            if(!$existe_asesor){
                                $errors[0] = 'El nombre del asesor no existe en la base de datos';
                                return response()->json(['status' => false, 'errors'=>$errors]);
                            }
                            */
                            

                            $estado_cliente = 'Cliente Activo';
                            if($value->estado_del_cliente == 0){
                                $estado_cliente = 'Cliente Inactivo';
                            }

                            //$newRegistro = new Registros();
                            $newRegistro = Registros::firstOrCreate(['doc' => $value->documento]);
                            $newRegistro->nombre = $value->nombre;
                            $newRegistro->primer_apellido = $value->primer_apellido;
                            $newRegistro->segundo_apellido = $value->segundo_apellido;
                            $newRegistro->tipo_documento =  $this->tipo_documento[$value->tipo_documento]; // condición
                            $newRegistro->doc = $value->documento;
                            $newRegistro->fecha_nacimiento = $value->fecha_de_nacimiento;
                            $newRegistro->profesion = $value->profesion;
                            $newRegistro->cargo = $value->cargo;
                            $newRegistro->telefono_personal = $value->telefono_personal;
                            $newRegistro->empresa = $value->empresa;
                            $newRegistro->telefono_corporativo = $value->telefono_corporativo;
                            $newRegistro->celular = $value->celular_corporativo;
                            $newRegistro->celular_corporativo = $value->celular_corporativo;
                            $newRegistro->email = $value->email_personal;
                            $newRegistro->email_corporativo = $value->email_corporativo;
                            $newRegistro->direccion = $value->direccion;
                            $newRegistro->municipio_id = $value->id_ciudad;
                            $newRegistro->area_id = $value->id_area;
                            $newRegistro->procedencia = 'Subida masiva';
                            $newRegistro->tipo_registro = $value->tipo_registro;
                            $newRegistro->menor_de_18 = $value->menor_de_18;
                            $newRegistro->comentarios = $value->comentarios;
                            $newRegistro->asesor_comercial = $value->asesor_comercial;
                            $newRegistro->estado_cliente = $estado_cliente;
                            $newRegistro->creado_por = Auth::user()->id;
                            $newRegistro->estado = 1;
                            $newRegistro->sn = $value->sn;
                            $newRegistro->subida_masiva_id = $subida_id; // logica
                            $newRegistro->save();
                            $count = $count + count($newRegistro);

                    }
                    return response()->json(['status' => true, 'cantidad' => $count, 'id'=>$newRegistro->subida_masiva_id]);

                }else{
                    return response()->json(['status' => false, 'error'=>'El archivo está vacio']);
                }
            }
        }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subidaMasivaRegistros($id){
        $registros = Registros::where('subida_masiva_id',$id)->paginate(30);  
        return view('registros.registros_subida_masiva', compact('registros'));
    }


    /**
     * Valida documento
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function validaDoc($doc){
        $existeRegistro = Registros::where('doc',$doc)->first();
        if($existeRegistro){
            $url = route('registros.edit', ['id' => $existeRegistro->id]);
            return response()->json(['success' => true, 'registro' => $existeRegistro, 'url'=>$url]);
        }else{
            return response()->json(['success' => false]);
        }
        return $existeRegistro;
    }


    /**
     * envía notificación
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviaNotificacion($registro, $evento='Nuevo registro'){

        Mail::queue('emails.registro', ['registro'=>$registro, 'origen'=>'PANEL DE ADMINISTRACIÓN', 'evento'=>$evento], function ($m) use ($registro, $evento) {

            $user_auth = Auth::User()->id;
            $responsable_id = $registro->area->m_responsable->id;
            $operario_id = $registro->area->m_operario->id;
            $email_responsable = $registro->area->m_responsable->email;
            $email_operario = $registro->area->m_operario->email;

            $m->from('habeasdata@annardx.com', 'Tratamiento de datos');

            // "Envio a los dos";
            if($user_auth!=$operario_id and $user_auth!=$responsable_id){

                // si el responsable y el operario son el mismo usuario, solo se le envia a uno
                if($responsable_id==$operario_id){
                    $m->to($email_responsable)->subject('Tratamiento de datos:'.$evento);                
                }else{
                   $m->to($email_responsable)->cc($email_operario, $name = null)->subject('Tratamiento de datos: '.$evento);
                }                

            }elseif($user_auth==$operario_id and $user_auth!=$responsable_id){
                //"Envio a Responsable";
                $m->to($email_responsable)->subject('Tratamiento de datos: '.$evento);
                
            }elseif($user_auth!=$operario_id and $user_auth==$responsable_id){
                // "Envio a Operario";
                $m->to($email_operario)->subject('Tratamiento de datos: '.$evento);
            }else{
                //"No se envia a nadie";
            }

        });
    }    

    /**
     * envía notificación
     * @return \Illuminate\Http\Response CURL asesores SAP
     */
    public function asesoresSap(){
    	return $this->asesores();
        $path = storage_path() . "/asesores.json";
        return json_decode(file_get_contents($path), true);   
        //return  $asesores = Curl::to('http://190.145.89.228/annarnetp/index.php/prueba/index')->get();}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrosByArea(Request $request)
    {
        //return $request->all();
        $id_area = $request->input('id');
        $areas = Areas::find($id_area);
        return $registros = $areas->registros;
    }


    public function asesores(){

	    $sql = DB::connection('mssql')->select("SELECT a.slpname FROM [ANNAR SAS].dbo.OSLP a");
	    $asesores = [];
	    foreach ($sql as $key => $value) {
	        if($value->slpname!=false){
	            $valor = utf8_decode($value->slpname);
	            $asesores[] = array("nombre"=>$valor);
	        }
	    }
	    //return $asesores;
	    return Response::json($asesores);

    }


}
