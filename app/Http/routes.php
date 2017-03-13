<?php
use Carbon\Carbon; 

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
    Route::get('reg.tabla_completa','RegistrosController@dataRegistrosTablaCompleta')->name('dataRegistrosTablaCompleta');



    Route::resource('areas', 'AreasController', ['except' => ['index']]);
    Route::get('areas','AreasController@index')->name('areas');
    Route::get('areas.data','AreasController@dataAreas')->name('dataAreas');


    Route::get('users', 'UsersController@index')->name('users');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('pdf', 'DatatablesController@pdf');
    Route::get('excel', 'DatatablesController@excel');

});

Route::get('test', function(){

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