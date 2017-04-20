<?php
use Illuminate\Support\Collection;

Route::get('/', function () {
    if(Auth::check()){
       return redirect('registros');
    }    
    return view('welcome');
});


Route::get('login/{id?}', 'LoginController@index');
Route::post('ingresar/', 'LoginController@login');
Route::get('salir/', 'LoginController@salir');

Route::get('auth', 'LoginController@auth');
Route::post('auth', 'LoginController@postAuth');

Route::post('login_directo', 'LoginController@loginDirecto')->name('loginDirecto');

/**
* RUTAS AUTH
*
*/
Route::group(['middleware'=>'auth'], function(){

    Route::resource('registros', 'RegistrosController', ['except' => ['index']]);

    Route::get('home','RegistrosController@index')->name('registros');
    Route::get('registros','RegistrosController@index')->name('registros');
    Route::get('registros.data','RegistrosController@dataRegistros')->name('dataRegistros');
    Route::post('registros/baja','RegistrosController@darDebaja')->name('baja');
    
    Route::get('registros.excel','RegistrosController@exportExcel')->name('exportExcel');

    Route::get('valida_doc/{doc}', 'RegistrosController@validaDoc')->name('validaDoc');
    
    // Tabla completa
    Route::get('reg/tabla_completa','RegistrosController@tablaCompleta')->name('registrosTablaCompleta');
    Route::post('reg.tabla_completa','RegistrosController@dataRegistrosTablaCompleta')->name('dataRegistrosTablaCompleta');

    // Subida Masiva
    Route::get('reg/subida_masiva','RegistrosController@subidaMasiva')->name('subidaMasiva');
    Route::post('reg/subida_masiva','RegistrosController@postSubidaMasiva')->name('postSubidaMasiva');
    Route::get('reg/subida_masiva_registros/{id}','RegistrosController@subidaMasivaRegistros')->name('subidaMasivaRegistros');

    Route::get('reg/subida_masiva_test','RegistrosController@subidaMasivaTest')->name('subidaMasivaTest');
  
    // Descarga excel municipios
    Route::get('reg/excel_municipios','RegistrosController@excelMunicipios')->name('excelMunicipios');

    Route::resource('areas', 'AreasController', ['except' => ['index']]);
    Route::get('areas','AreasController@index')->name('areas');
    Route::get('areas.data','AreasController@dataAreas')->name('dataAreas');

    Route::get('users', 'UsersController@index')->name('users');
    Route::get('users_habeas', 'UsersController@habeas')->name('usersHabeas');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    // Auditoria
    Route::get('registros/auditoria/{id}','RegistrosController@auditoria')->name('auditoria');

    Route::get('asesores_sap', 'RegistrosController@asesoresSap')->name('asesoresSap');
    
    // Reportes controller
    Route::get('reportes', 'ReportesController@index')->name('reportes');
    Route::post('reportes/historial_cambios', 'ReportesController@getHistorialCambios')->name('getHistorialCambios');
    Route::get('reportes/historial_cambios_tabla/{id}/{fecha_inicio}/{fecha_fin}', 'ReportesController@getHistorialCambiosTabla')->name('getHistorialCambiosTabla');
    
    

});

Route::get('save','RegistrosController@saveInfoAgent')->name('save');



Route::get('test', function(){
    //return  $asesores = Curl::to('http://localhost/pruebas/asesores.json')->get();
    $path = storage_path() . "/asesores.json";
    return $json = json_decode(file_get_contents($path), true);   
});


/**
* RUTAS PUBLICAS
*
*/
Route::post('municipios','RegistrosController@municipios')->name('municipios');
Route::get('formulario/{slug}', 'FormularioController@formulario');
Route::post('formulario/guardar', 'FormularioController@guardarFormulario');
Route::get('formulario/baja/{id}', 'FormularioController@baja');
Route::post('formulario/baja', 'FormularioController@bajaPost');
Route::get('password/reset_ok', function(){
    return view('auth.passwords.reset_ok');
    return "Oka reset";
});

Route::auth();

//Route::get('/home', 'HomeController@index');
