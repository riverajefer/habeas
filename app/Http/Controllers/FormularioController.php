<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Registros;
use App\Models\Areas;
use App\Models\Departamentos;
use App\Models\Municipios;
use Jenssegers\Agent\Agent;
use App\Models\DeviceRegistro;
use App\Models\User;
use Carbon\Carbon; 

class FormularioController extends Controller
{


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->tipo_documento = collect([
            'Cédula de Ciudadanía',
            'NIT',
            'Tarjeta de Identidad',
            'Registro Civil',
            'Pasaporte',
            'Carné Diplomático',
        ]);
       
    }    

    /**
     * Store a new user.
     * @param  String  $slug
     * @return \Illuminate\View\View
     */
     public function formulario($slug='publico'){

        $area = Areas::whereSlug($slug)->first();
        $tipo_documento = $this->tipo_documento;
        
        if(!empty($area)){
            $departamentos = Departamentos::all();
            return view('formularios_publico.index', compact('departamentos', 'area', 'slug', 'tipo_documento'));
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
            'doc'=>'required|string|unique:registros|max:50',
            'email'=>'required|email',
            'fecha_nacimiento'=>'required|date',
            'profesion'=>'required|string',
            'cargo'=>'required|string',
            'empresa'=>'required|string',
            'telefono'=>'numeric',
            'celular'=>'required|numeric',
            'departamento_id'=>'required',
            'municipio_id'=>'required',
            'autorizo'=>'required',
        ]);


        /*******************************
        Obtiene edad, con la fecha
        *******************************/
        $menor_a_18 = false;
        if($request->input('fecha_nacimiento')){
            $menor_a_18 = false;
            $edad = Carbon::parse($request->input('fecha_nacimiento'))->age;
            if($edad<18){
                $menor_a_18 = true;
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
        $registro->telefono_personal = $request->input('telefono');
        $registro->celular = $request->input('celular');
        $registro->municipio_id = $request->input('municipio_id');
        $registro->procedencia = $request->input('procedencia');
        $registro->creado_por = 'Usuario_'.$request->input('procedencia');
        $registro->area_id = $request->input('area_id');
        $registro->menor_de_18 = $menor_a_18;
        $registro->estado = 1;
        $registro->save();

        $this->saveInfoAgent($registro->id);

        return back()->with('success','Gracias: Registro creado correctamente');

     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveInfoAgent($registro_id)
    {
        $agent = new Agent();
        $platform = $agent->platform();
        $version  = $agent->version($platform);

        $tipo_device = '';
        $ip = Request()->ip();

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
        $deviceRegistro->lat = geoip()->getLocation($ip)->lat;
        $deviceRegistro->lon = geoip()->getLocation($ip)->lon;
        $deviceRegistro->save();
    }

}
