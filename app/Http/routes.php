<?php
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    Route::post('registros_area','RegistrosController@registrosByArea')->name('registrosByArea');

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
    Route::get('reportes/historial_cambios_tabla/{area_id}/{registro_id}/{fecha_inicio}/{fecha_fin}', 'ReportesController@getHistorialCambiosTabla')->name('getHistorialCambiosTabla');
    Route::get('reportes/historial_cambios_excel/{area_id}/{registro_id}/{fecha_inicio}/{fecha_fin}', 'ReportesController@getHistorialCambiosExcel')->name('getHistorialCambiosExcel');

    // Usuarios roles y permisos
    Route::get('roles', 'RolesPermisosController@roles')->name('roles');
    Route::get('usuarios', 'RolesPermisosController@index')->name('usuarios');
    Route::post('save_rol', 'RolesPermisosController@saveRol')->name('saveRol');
    Route::post('save_permisos', 'RolesPermisosController@savePermisos')->name('savePermisos');
    Route::post('save_permisos_rol', 'RolesPermisosController@savePermisosRol')->name('savePermisosRol');



}); 

Route::get('save','RegistrosController@saveInfoAgent')->name('save');



Route::get('test', function(){

    //return $permission = Permission::create(['name' => 'dar de baja']);
    $registro =  App\Models\Registros::find(107);
    $area = $registro->area;
    return $area->users;
      //  $role =  Role::find(1);
   // return $permission = Permission::create(['name' => 'nuevo permiso']);
    //return "test";
    //return $tablas = DB::connection('mssql')->select('select * from obs_list');
    //return  DB::connection('mssql')->getPdo();    
    //return DB::connection('mssql')->select("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE'");

    $sql = DB::connection('mssql')->select("SELECT a.slpname FROM [ANNAR SAS].dbo.OSLP a");
    $salida = [];
    foreach ($sql as $key => $value) {
        if($value->slpname!=false){
            //$salida[] = json_encode($value->slpname, JSON_UNESCAPED_UNICODE);
            //trim($string,'"');
            $valor = utf8_decode($value->slpname);
            $salida[] = array("nombre"=>$valor);
        }
    }
    //return $result = json_encode($sql, JSON_UNESCAPED_UNICODE);
    return Response::json($salida);

    return $salida;
    var_dump($salida);



    try {
        DB::connection('mssql')->getPdo();
        return "Conexión ok";
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration.");
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

Route::group(['middleware' => ['role:operario,crear registros']], function () {
    
    Route::get('prueba', function(){
        return $user = App\Models\User::find(2);
    });

});


