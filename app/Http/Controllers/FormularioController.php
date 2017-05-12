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
use Mail;
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
        //return $request->all();
        $this->validate($request,[
            'nombre'=>'required|string',
            'primer_apellido'=>'required|string',
            'segundo_apellido'=>'required|string',
            'tipo_documento'=>'required|string',
            //'doc'=>'required|string|unique:registros|max:50',
            'doc'=>'required|numeric',
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
            'g-recaptcha-response' => 'required',
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

        //$registro = New Registros();
        $registro = Registros::firstOrCreate(['doc' => $request->input('doc')]);
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
        $registro->area_id = $request->input('area_id');
        $registro->menor_de_18 = $menor_a_18;
        $registro->estado = 1;
        $registro->save();

        //$this->saveInfoAgent($registro->id);

        
        Mail::queue('emails.registro', ['registro'=>$registro], function ($m) use ($registro) {

            $email_responsable = $registro->area->m_responsable->email;
            $email_operario = $registro->area->m_operario->email;
            $m->from('habeasdata@annardx.com', 'Tratamiento de datos');

            if($email_responsable==$email_operario){
                $m->to($email_responsable)->subject('Tratamiento de datos, nuevo registro');                
            }else{
                $m->to($email_responsable)->cc($email_operario, $name = null)->subject('Tratamiento de datos, nuevo registro');
            }
        });


        Mail::queue('emails.notificacion_user', ['registro'=>$registro], function ($m) use ($registro) {
            $email = $registro->email;
            $m->from('habeasdata@annardx.com', 'Tratamiento de datos Annardx');
            $m->to($email)->subject('Tratamiento de datos, nuevo registro');
        });


        return back()->with('success','Gracias: Información envíada correctamente');

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
        $deviceRegistro->ubicacion = geoip()->getLocation($ip)->lat.', '.geoip()->getLocation($ip)->lon;
        $deviceRegistro->save();
    }




    /**
     * Store a id user.
     * @param  String  $slug
     * @return \Illuminate\View\View
     */
     public function baja($id){
         $registro = Registros::findOrFail($id);
         $areas = Areas::all();
         $tipo_documento = $this->tipo_documento;
         return view('formularios_publico.baja', compact('registro', 'areas', 'tipo_documento'));
         return "Baja: ".$id;

     }


    /**
     * Display the specified resource.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
     public function bajaPost(Request $request){

        $registro = Registros::findOrFail($request->input('registro_id'));

        $this->validate($request,[
            'area_id'=>'required',
        ]);
        $area_id = $request->input('area_id');

        if($request->input('fijo')){
            $this->validate($request,[
                'area_id'=>'required',
                'telefono_personal'=>'required|numeric',
            ]);

            if( ($registro->area_id == $area_id) and ($registro->telefono_personal == $request->input('telefono_personal')) ){
                $registro->estado = 0;
                $registro->baja_por = 0;
                $registro->save();
                $this->enviaNotificacion($registro, 'Dado de baja por el mismo usuario');
                return back()->with('success','Su suscripción fue cancelada correctamente.');
            }
            else{
                return back()->with('error_baja','Validación incorrecta, verifica los campos y vuelve a envíar la información ')->withInput();
            }
            
        }

        if($request->input('ncelular')){
            $this->validate($request,[
                'area_id'=>'required',
                'celular'=>'required|numeric',
            ]);
            if( ($registro->area_id == $area_id) and ($registro->celular == $request->input('celular')) ){
                $registro->estado = 0;
                $registro->baja_por = 0;
                $registro->save();                
                $this->enviaNotificacion($registro, 'Dado de baja por el mismo usuario');
                return back()->with('success','Su suscripción fue cancelada correctamente.');
            }
            else{
                return back()->with('error_baja','Validación incorrecta, verifica los campos y vuelve a envíar la información ')->withInput();
            }

        }

        if($request->input('fecha')){
            $this->validate($request,[
                'area_id'=>'required',
                'fecha_nacimiento'=>'required|date',
            ]);
            if( ($registro->area_id == $area_id) and ($registro->fecha_nacimiento == $request->input('fecha_nacimiento')) ){
                $registro->estado = 0;
                $registro->baja_por = 0;
                $registro->save();
                $this->enviaNotificacion($registro, 'Dado de baja por el mismo usuario');
                return back()->with('success','Su suscripción fue cancelada correctamente.');
            }      
            else{
                return back()->with('error_baja','Validación incorrecta, verifica los campos y vuelve a envíar la información ')->withInput();
            }                  
        }

        if($request->input('ndoc')){
            $this->validate($request,[
                'area_id'=>'required',
                'doc'=>'required|numeric',
            ]);
            if( ($registro->area_id == $area_id) and ($registro->doc == $request->input('doc')) ){
                $registro->estado = 0;
                $registro->baja_por = 0;
                $registro->save();
                $this->enviaNotificacion($registro, 'Dado de baja por el mismo usuario');                
                return back()->with('success','Su suscripción fue cancelada correctamente.');
            }   
            else{
                return back()->with('error_baja','Validación incorrecta, verifica los campos y vuelve a envíar la información ')->withInput();
            }                      
        }
     }

    /**
     * envía notificación
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviaNotificacion($registro, $evento='Nuevo registro'){

        Mail::queue('emails.registro', ['registro'=>$registro, 'origen'=>'MISMO USUARIO', 'evento'=>$evento], function ($m) use ($registro, $evento) {

            $responsable_id = $registro->area->m_responsable->id;
            $operario_id = $registro->area->m_operario->id;
            $email_responsable = $registro->area->m_responsable->email;
            $email_operario = $registro->area->m_operario->email;

            $m->from('habeasdata@annardx.com', 'Tratamiento de datos');

            // si el responsable y el operario son el mismo usuario, solo se le envia a uno
            if($responsable_id==$operario_id){
                $m->to($email_responsable)->subject('Tratamiento de datos:'.$evento);                
            }else{
                $m->to($email_responsable)->cc($email_operario, $name = null)->subject('Tratamiento de datos: '.$evento);
            }                

        });
    }   

}

