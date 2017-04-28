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
    Route::get('reportes/historial_cambios_excel/{id}/{fecha_inicio}/{fecha_fin}', 'ReportesController@getHistorialCambiosExcel')->name('getHistorialCambiosExcel');

    // Usuarios roles y permisos
    Route::get('roles', 'RolesPermisosController@roles')->name('roles');
    Route::get('usuarios', 'RolesPermisosController@index')->name('usuarios');
    Route::post('save_rol', 'RolesPermisosController@saveRol')->name('saveRol');
    Route::post('save_permisos', 'RolesPermisosController@savePermisos')->name('savePermisos');
    Route::post('save_permisos_rol', 'RolesPermisosController@savePermisosRol')->name('savePermisosRol');

}); 

Route::get('save','RegistrosController@saveInfoAgent')->name('save');



Route::get('test', function(){

//return $permission = Permission::create(['name' => 'roles y permisos']);


        $user =  Auth::user();
        $areas = $user->areas;

        $registros = new Collection;
        foreach($areas as $area){
            $registros = $registros->merge(App\Models\Registros::with('area')->with('area.m_responsable')->with('area.m_operario')->with('municipio')->with('municipio.ndepartamento')->with('creadoPor')->with('modificadoPor')->with('tipoRegistro')->where('area_id', $area->id)->get());
        }
        return $registros;




    $user = App\Models\User::find(2);


    $permission = 'modificar registros';
    $puede = MyFuncs::usuarioRolPuede($user, $permission);
    return  (String) $puede;

        $roles = $user->roles;
        $permisos = [];
        $pasa = false;
        foreach($roles as $rol){
            $permisos[] =  $rol->permissions;
            if(count($rol->permissions) >0){
                foreach($rol->permissions as $permiso){
                    if($permiso->name == $permission){
                        $pasa = true;
                    }
                }
            }
        }
        return (String) $pasa;



    //$areas = App\Models\Areas::find(2);
    //return $areas->registros;

    //User::has('posts')->get();
    $areas = $user->areas;

    $registros = [];
    foreach($areas as $area){
        $registros[] = $area->registros;
    }
    return $registros;



   $areas = App\Models\Areas::find(4);
   //return $areas->users;

$users = [2,3];
return $areas->users()->attach($users);

/*
$comment = $post->comments()->create([
    'message' => 'A new comment.',
]);
*/




    $user = App\Models\User::find(2);
    $Elpermiso = 'crear registros';
    $roles = $user->roles;
    $permisos = [];
    $pasa = 'NO';
    foreach($roles as $rol){
        $permisos[] =  $rol->permissions;
        if(count($rol->permissions) >0){
            foreach($rol->permissions as $permiso){
                if($permiso->name == $Elpermiso){
                    $pasa ='Si tiene permiso';
                }
            }
        }
    }
    return $pasa;

    //return $user->assignRole('operario');
    //$user->assignRole('admin');
    //return $role = Role::create(['name' => 'admin']);
    //$role =  Role::find(3);
    //return $role->givePermissionTo('crear registros');
    //return (String) $user->hasAllRoles(Role::all());
    //return $user->givePermissionTo('crear registros');
    //return $permission = Permission::create(['name' => 'reportes']);
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

Route::group(['middleware' => ['role:operario,crear registros']], function () {
    
    Route::get('prueba', function(){
        return $user = App\Models\User::find(2);
    });

});


