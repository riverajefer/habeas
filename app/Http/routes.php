<?php
use Illuminate\Support\Collection;

Route::get('/', function () {
    if(Auth::check()){
       return redirect('registros');
    }    
    return view('welcome');
});


Route::get('ingresar/{id?}', 'LoginController@index');
Route::post('ingresar/', 'LoginController@login');
Route::get('salir/', 'LoginController@salir');

Route::get('auth', 'LoginController@auth');
Route::post('auth', 'LoginController@postAuth');


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

    // Reportes controller
    Route::get('reportes', 'ReportesController@index')->name('reportes');
    

});

Route::get('save','RegistrosController@saveInfoAgent')->name('save');



Route::get('test', function(){
    //return "Test";
     $asesores = Curl::to('http://localhost/pruebas/asesores.json')->get();
     $collect =  collect(json_decode($asesores, true));
     $salida =  $collect->contains('SlpName','ANNAR');
     if($salida){
         return "existe";
     }else{
         return "No existe";
     }


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
