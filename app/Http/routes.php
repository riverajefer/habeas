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


/*
Rutas Auth, protegidas
*/

Route::group(['middleware'=>'auth'], function(){

    Route::resource('registros', 'RegistrosController', ['except' => ['index']]);

    Route::get('registros','RegistrosController@index')->name('registros');
    Route::get('registros.data','RegistrosController@dataRegistros')->name('dataRegistros');

    Route::post('municipios','RegistrosController@municipios')->name('municipios');


    Route::resource('areas', 'AreasController', ['except' => ['index']]);
    Route::get('areas','AreasController@index')->name('areas');
    Route::get('areas.data','AreasController@dataAreas')->name('dataAreas');


    Route::get('users', 'UsersController@index')->name('users');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('pdf', 'DatatablesController@pdf');
    Route::get('excel', 'DatatablesController@excel');

});

Route::get('test', function(){

    return App\Models\Registros::find(59)->modificadoPor;
    //return App\Models\Departamentos::find(14)->municipios()->get();
    return App\Models\Departamentos::with('municipios')->get();
    return App\Models\Areas::all();
    return $areas = App\Areas::with('user')->select('areas.*')->get();
    $areas =  App\Areas::find(1);
    return $areas->user()->get();
});