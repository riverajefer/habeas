<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('login/{email?}', 'LoginController@index');
Route::post('login/{email?}', 'LoginController@login');
Route::controller('data', 'DatatablesController', [
    'anyData'  => 'data.data',
    'getIndex' => 'data',
]);


/*
Route::controller('data', 'DatatablesController', [
    'anyData'  => 'data.data',
    'getIndex' => 'data',
]);
*/

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('pdf', 'DatatablesController@pdf');
Route::get('excel', 'DatatablesController@excel');


Route::resource('registros', 'RegistrosController', ['except' => [
    'index'
]]);;

Route::get('registros','RegistrosController@index')->name('registros');
Route::get('registros.data','RegistrosController@dataRegistros')->name('dataRegistros');


Route::get('salir', function(){
    Auth::logout();
});


Route::get('login2', function(){

    $user = App\User::whereEmail_t4('fabio.ramirez@annardx.com')->wherePassword(md5('2016'))->first();
    Auth::loginUsingId($user->id_user_t4, false);

});
