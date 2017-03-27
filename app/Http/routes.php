<?php

Route::get('/', function () {
    if(Auth::check()){
       return redirect('registros');
    }    
    return view('welcome');
});


Route::get('login/{id?}', 'LoginController@index');
Route::post('login/', 'LoginController@login');
Route::get('salir/', 'LoginController@salir');

/**
* RUTAS AUTH
*
*/
Route::group(['middleware'=>'auth'], function(){


    Route::resource('registros', 'RegistrosController', ['except' => ['index']]);

    Route::get('registros','RegistrosController@index')->name('registros');
    Route::get('registros.data','RegistrosController@dataRegistros')->name('dataRegistros');
    Route::post('registros/baja','RegistrosController@darDebaja')->name('baja');

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


    // Auditoria
    Route::get('registros/auditoria/{id}','RegistrosController@auditoria')->name('auditoria');
    


});

Route::get('save','RegistrosController@saveInfoAgent')->name('save');



Route::get('test', function(){

    $re =  App\Models\Registros::find(34);
    //echo $re->audits[0]->id.PHP_EOL;
    return $re->audits[0]->getModified(true);
    echo $re->old_values;

    return;
    return $re->audits;


    return  $tables = DB::select('SHOW TABLES');
    //return $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

    //$users = DB::connection('mysql2')->table("users")->get();
    //return $users;
    return "Test";
});


/**
* RUTAS PUBLICAS
*
*/
Route::get('formulario/{slug}', 'FormularioController@formulario');
Route::post('formulario/guardar', 'FormularioController@guardarFormulario');
Route::get('formulario/baja/{id}', 'FormularioController@baja');
Route::post('formulario/baja', 'FormularioController@bajaPost');