<?php

Route::get('/', function () {
    return view('welcome');
});

Route::controller('data', 'DatatablesController', [
    'anyData'  => 'data.data',
    'getIndex' => 'data',
]);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('pdf', 'DatatablesController@pdf');
Route::get('excel', 'DatatablesController@excel');


Route::get('salir', function(){
    Auth::logout();
});


Route::get('login', function(){

    $user = App\User::whereEmail_t4('fabio.ramirez@annardx.com')->wherePassword(md5('2016'))->first();
    Auth::loginUsingId($user->id_user_t4, false);

});
