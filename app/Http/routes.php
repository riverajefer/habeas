<?php
use Carbon\Carbon; 
use App\Http\Requests;
use Illuminate\Support\Collection;

Route::get('/', function () {

    if(Auth::check()){
       return redirect('registros');
    }    
    return view('welcome');
});

Route::get('login/{id?}', 'LoginController@index');
Route::post('login/', 'LoginController@login');
Route::get('salir/', 'LoginController@salir');


/*
Rutas Auth, protegidas
*/

Route::group(['middleware'=>'auth'], function(){

    Route::resource('registros', 'RegistrosController', ['except' => ['index']]);

    Route::get('registros','RegistrosController@index')->name('registros');
    Route::get('registros.data','RegistrosController@dataRegistros')->name('dataRegistros');

    Route::post('municipios','RegistrosController@municipios')->name('municipios');
    Route::get('registros.excel','RegistrosController@exportExcel')->name('exportExcel');

    // Tabla completa
    Route::get('reg/tabla_completa','RegistrosController@tablaCompleta')->name('registrosTablaCompleta');
    Route::post('reg.tabla_completa','RegistrosController@dataRegistrosTablaCompleta')->name('dataRegistrosTablaCompleta');



    Route::resource('areas', 'AreasController', ['except' => ['index']]);
    Route::get('areas','AreasController@index')->name('areas');
    Route::get('areas.data','AreasController@dataAreas')->name('dataAreas');


    Route::get('users', 'UsersController@index')->name('users');
    Route::get('users_habeas', 'UsersController@habeas')->name('usersHabeas');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('pdf', 'DatatablesController@pdf');
    Route::get('excel', 'DatatablesController@excel');

});


Route::get('save','RegistrosController@saveInfoAgent')->name('save');


Route::get('test', function(){


            $re =  App\Models\Registros::find(2);
return             $area = $re->area()->first()->m_operario;

            $user = App\Models\User::find(5);
            $areas =  $user->areasOperario()->get();

            if($user->areasOperario()->first()){
                return "tiene areas";
            }else{
                return "No tiene areas";

            }
            $user =  Auth::user();


            return $areas =  $user->areasResponsable()->get();

            $registros = new Collection;
            foreach(collect($areas) as $area){
                if(count($area->registros()->get())>0)
                {
                    $registros->push(App\Models\Registros::with('area')->where('area_id', $area->id)->first());
                }
            }

          return $registros;






    //$user =  Auth::user();
    //$area = App\Models\Areas::find(6);
    //return $registros_area  = $area->registros()->get();
    $user = App\Models\User::find(1);
   return  $areas =  $user->areasOperario()->get();
   return  $areas =  $user->areasResponsable()->get();

   

    $R = array();
    foreach($areas as $area){
        if(count($area->registros()->get())>0)
        {
            array_push($R, $area->registros()->with('area')->get());
            //$R[] = $area->registros()->with('area')->get();
        }
    }
    return $R[0][0];
    

 //   return $user->areasResponsable()->registros->get();
    

    //$modulos =  App\Models\Modulos::find(21);

    $modulos =  App\Models\Modulos::find(21);
    return $modulos->users()->get();


   return $modulos = App\Models\User::find(2)->modulos()->where('idmodfunc_t20', 21)->get();


    return dd( geoip()->getLocation(Request::ip()) );
    return Request::ip();
    return dd(Agent::isMobile());
    return MyFuncs::full_name("John","Doe");
    return dd(geoip()->getLocation('27.974.399.65'));

    return dd($position = Location::get('192.168.1.1'));
    return Agent::device();
    return Agent::version(Agent::platform());
    $bro = Agent::browser();
    return $version = Agent::version($bro);

    //$agent = new Agent();
    //return var_dump($agent->is('Windows'));

    return BrowserDetect::detect();

     $perfil = DB::table('perfusr_t21')->where('idmodfunc_t21', '21')->first();
     return $perfil->idusr_t21;

    //return Carbon::now();
    return Carbon::parse('2003-01-29')->age;

    return Auth::user()->id;
    return App\Models\Registros::with('area')->with('municipio')->with('municipio.ndepartamento')->get();
    return $title = str_slug('Diagnóstica', '-');

    return BrowserDetect::browserName();

    return json_encode(array_values((array)geoip()));

    return App\Models\Registros::find(59)->modificadoPor;
    //return App\Models\Departamentos::find(14)->municipios()->get();
    return App\Models\Departamentos::with('municipios')->get();
    return App\Models\Areas::all();
    return $areas = App\Areas::with('user')->select('areas.*')->get();
    $areas =  App\Areas::find(1);
    return $areas->user()->get();
});


/**
* RUTAS PUBLICAS
*
*/
Route::get('formulario/{slug}', 'FormularioController@formulario');
Route::post('formulario/guardar', 'FormularioController@guardarFormulario');