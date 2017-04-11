<?php
namespace App\Helpers;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Areas;
use App\Models\Departamentos;
use App\Models\Municipios;
use App\Models\TipoRegistro;


class MyFuncs {

        /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->device = Agent::device();
    }


    public static function full_name($first_name,$last_name) {
        return 'Full name: '. $first_name . ', '. $last_name;   
    }

    public static function fn_atributo($atributo, $audit, $modified){
        $colletion = new Collection;
        $collection = collect([
            ['atributo' => ''],
            ['new' => ''],
            ['old' => ''],
        ]);
        

        $colletion->new = $modified['new'];
        if( $audit->event=='updated'){
            $colletion->old = $modified['old'];
        }else{
            $colletion->old = '';
        }

        switch($atributo){
            case 'primer_apellido';
                $colletion->atributo = 'Primer Apellido';
                break;
            case 'segundo_apellido';
                $colletion->atributo = 'Segundo Apellido';
                break;  
            case 'tipo_documento';
                $colletion->atributo = 'Tipo de documento';
                break;  
            case 'doc';
                $colletion->atributo = 'Documento';
                break;  
            case 'fecha_nacimiento';
                $colletion->atributo = 'Fecha de nacimiento';
                break;  
            case 'telefono_personal';
                $colletion->atributo = 'Teléfono personal';
                break;  
            case 'telefono_corporativo';
                $colletion->atributo = 'Teléfono corporativo';
                break;  
            case 'celular_corporativo';
                $colletion->atributo = 'Celular corporativo';
                break;
            case 'email_corporativo';
                $colletion->atributo = 'Email corporativo';
                break;                                                  
            case 'direccion';
                $colletion->atributo = 'Dirección';
                break; 
            case 'archivo_soporte';
                $colletion->atributo = 'Archivo de soporte';
                if($colletion->old){
                    $ruta = asset('uploads/soportes/'.$colletion->old);
                    $colletion->old = '<a data-fancybox data-caption="Soporte" href="'.$ruta.'"> Ver Soporte </a>';
                    $ruta = asset('uploads/soportes/'.$colletion->new);
                    $colletion->new = '<a data-fancybox data-caption="Soporte" href="'.$ruta.'"> Ver Soporte </a>';

                }else{
                    $ruta = asset('uploads/soportes/'.$colletion->new);
                    $colletion->new = '<a data-fancybox data-caption="Soporte" href="'.$ruta.'"> Ver Soporte </a>';
                }                  
                break;                  
            case 'segundo_apellido';
                $colletion->atributo = 'Segundo Apellido';
                break;   
            case 'municipio_id';
                $colletion->atributo = 'Ciudad';
                if($colletion->old){
                    $colletion->new = Municipios::find($colletion->new)->ndepartamento->nombre.' - '. Municipios::find($colletion->new)->nombre_municipio;
                    $colletion->old = Municipios::find($colletion->old)->ndepartamento->nombre.' - '. Municipios::find($colletion->old)->nombre_municipio;
                }else{
                    $colletion->new = Municipios::find($colletion->new)->ndepartamento->nombre.' - '. Municipios::find($colletion->new)->nombre_municipio;
                }                
                break;                  
            case 'area_id';
                $colletion->atributo = 'Área';
                if($colletion->old){
                    $colletion->new = Areas::find($colletion->new)->titulo;
                    $colletion->old = Areas::find($colletion->old)->titulo;
                }else{
                    $colletion->new = Areas::find($colletion->new)->titulo;
                }
                break;   
            case 'tipo_registro';
                $colletion->atributo = 'Tipo de Registro';
                if($colletion->old){
                    $colletion->new = TipoRegistro::find($colletion->new)->titulo;
                    $colletion->old = TipoRegistro::find($colletion->old)->titulo;
                }else{
                    if(!$colletion->new){
                        $colletion->new = '';
                    }else{
                        $colletion->new = TipoRegistro::find($colletion->new)->titulo;
                    }
                }                
                break;   
            case 'segundo_apellido';
                $colletion->atributo = 'Segundo Apellido';
                break;  
            case 'estado_cliente';
                $colletion->atributo = 'Estado del Cliente';
                break;   
            case 'menor_de_18';
                $colletion->atributo = 'Menor de 18';
                if($colletion->new){
                    $colletion->new = 'SI';
                    $colletion->old = 'NO';
                }else{
                    $colletion->new = 'NO';
                    $colletion->old = 'SI';
                }               
                break;  
            case 'asesor_comercial';
                $colletion->atributo = 'Asesor comercial';
                break;                                                                                                                                                                                                            
            case 'modificado_por';
                $colletion->atributo = 'Modificado por';
                if($colletion->old){
                    $colletion->old = User::find($colletion->old)->nombre;
                }else{
                    $colletion->new = User::find($colletion->new)->nombre;
                }
                break;
            case 'baja_por';
                $colletion->atributo = 'Dado de baja por';
                if($colletion->old==0){
                    $colletion->old = '';
                }else{
                    $colletion->old = User::find($colletion->old)->nombre;
                }
                if($colletion->new == 0){
                    $colletion->old = '';
                }else{
                    $colletion->new = User::find($colletion->new)->nombre;
                }

                break;                
            case 'creado_por';
                $colletion->atributo = 'Creado por';
                if($colletion->old){
                    $colletion->old = User::find($colletion->old)->nombre;
                }elseif($colletion->new){
                    $colletion->new = User::find($colletion->new)->nombre;
                }else{
                    $colletion->new ='';
                }
                break;
            case 'estado';
                $colletion->atributo = 'Esatado';
                if($colletion->new){
                    $colletion->new = 'Activo';
                    $colletion->old = 'Inactivo';
                }else{
                    $colletion->new = 'Inactivo';
                    $colletion->old = 'Activo';
                }
                break;                                   
            default:
                $colletion->atributo = $atributo;
        }
        
        return $colletion;
    }

    public static function procesaSubida($campo, $valor){
        $collection = collect([
            ['campo' => ''],
            ['valor' => ''],
        ]);

        switch($campo){
            case 'cargo':
                $collection->campo = $campo;
                $collection->valor = $valor;
                break;
            default:
                $collection->campo = $campo;
                $collection->valor = $valor;

        }
        return $collection;
    }


}