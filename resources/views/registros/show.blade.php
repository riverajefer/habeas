@extends('layouts.master')

@section('content')
<br>
<div class="panel panel-default">

<div class="panel-heading"> 
    <i class="fa fa-user" aria-hidden="true"></i> Detalles del registro
</div>

  <div class="panel-body">
    <div class="row">   
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">
                    <span>Nombre:</span>  
                    {{$registro->nombre}}
                </li>
                <li class="list-group-item">
                    <span>Apellidos:</span> 
                     {{$registro->primer_apellido}} {{$registro->segundo_apellido}}
                </li>
                <li class="list-group-item"><span>Tipo de documento:</span> 
                    {{$registro->tipo_documento}}
                </li>                
                <li class="list-group-item"><span>Número de documento:</span> 
                    {{$registro->doc}}
                </li>
                <li class="list-group-item">
                    <span>Fecha de nacimiento:</span>
                    {{$registro->fecha_nacimiento}}
                </li>
                <li class="list-group-item">
                    <span>Email personal:</span>  
                    {{$registro->email}}
                </li> 
                <li class="list-group-item">
                    <span>Teléfono personal:</span>  
                    {{$registro->telefono_personal}}
                </li>
                <li class="list-group-item">
                    <span>Celular personal:</span>  
                    {{$registro->celular}}
                </li>                                 
                <li class="list-group-item">
                    <span>Área:</span>  
                    {{$registro->area->titulo or 'sin seleccionar'}}
                </li>               
                <li class="list-group-item">
                    <span>Profesion:</span>  
                    {{$registro->profesion}}
                </li>
                <li class="list-group-item">
                    <span>Cargo:</span>  
                    {{$registro->cargo}}
                </li>
                <li class="list-group-item">
                    <span>Empresa:</span>  
                    {{$registro->empresa}}
                </li>
                <li class="list-group-item">
                    <span>Teléfono corporativo:</span>  
                    {{$registro->telefono_corporativo}}
                </li>
                <li class="list-group-item">
                    <span>Email corporativo:</span>  
                    {{$registro->email_corporativo}}
                </li>   
                <li class="list-group-item">
                    <span>Celular corporativo:</span>  
                    {{$registro->celular_corporativo}}
                </li>                 
            </ul>  
        </div>
        <div class="col-md-6">
            <ul class="list-group">
             
                <li class="list-group-item">
                    <span>Departamento:</span>  
                    {{$registro->municipio->ndepartamento->nombre or ''}}
                </li>
                <li class="list-group-item">
                    <span>Ciudad:</span>  
                    {{$registro->municipio->nombre_municipio or ''}}
                </li>
                <li class="list-group-item">
                    <span>Dirección:</span>  
                    {{$registro->direccion}}
                </li>                                
                
                <li class="list-group-item">
                    <span>Archivo de soporte:</span>  
                    @if($registro->archivo_soporte)
                        <a data-fancybox data-caption="Soporte" href="{{asset('uploads/soportes/'.$registro->archivo_soporte.'')}}"> Ver Soporte </a>
                    @else
                       
                    @endif
                </li>
                <li class="list-group-item">
                    <span>SN:</span>  
                    {{ $registro->sn }}
                </li>   
                <li class="list-group-item">
                    <span>Asesor comercial:</span>  
                    {{ $registro->asesor_comercial }}
                </li>   
                <li class="list-group-item">
                    <span>Estado del cliente:</span>  
                    {{ $registro->estado_cliente }}
                </li>  
                <li class="list-group-item">
                    <span>Tipo de registro:</span>  
                    {{ $registro->tipoRegistro->titulo or '' }}
                </li> 
                <li class="list-group-item">
                    <span>Menor de 18 años:</span>  
                    {{ $registro->menor_de_18 ? 'SI': 'NO' }}
                </li>                 
                <li class="list-group-item">
                    <span>Comentarios:</span>  
                    {{ str_limit($registro->comentarios,20) }}
                </li>                                                                                                    
                <li class="list-group-item">
                    <span>Procedencia del registro:</span>  
                    {{ $registro->procedencia }}
                </li>  
                <li class="list-group-item">
                    <span>Registro creado por:</span>  
                    {{ $registro->creadoPor->nombre or '' }}
                </li>  
                <li class="list-group-item">
                    <span>Registro modificado por:</span>  
                    {{ $registro->modificadoPor->nombre or '' }}
                </li>  
                <li class="list-group-item">
                    <span>Fecha de creación:</span>  
                    {{ $registro->created_at }}
                </li>                                                  
                <li class="list-group-item">
                    <span>Fecha de Modificación:</span>  
                    {{ $registro->updated_at}}
                </li>  
                <li class="list-group-item {{ $registro->estado ? 'Activo': 'Inactivo'  }}">
                    <span>Estado:</span>  
                    {{ $registro->estado ? 'Activo': 'Dado de baja'  }}
                </li>                  
            </ul>  
        </div>
    </div>
  </div>


<div class="row">
    <div class="col-md-2 col-md-offset-3">
        <a href="{{URL::to('registros/'.$registro->id.'/edit')}}">
            <button class="mdl-button mdl-js-button mdl-button--primary">
                MODIFICAR REGISTRO
            </button>
        </a>
    </div>
    
    <div class="col-md-2">
        <a href="{{URL::to('registros/create')}}">
            <button class="mdl-button mdl-js-button mdl-button--accent">
                NUEVO REGISTRO
            </button>
        </a>
    </div>  

    <div class="col-md-3">
        <a href="{{URL::to('registros')}}">
            <button class="mdl-button mdl-js-button mdl-button--primary">
                VER TODOS LOS REGISTROS
            </button>
        </a>
    </div>        
</div>
<br><br>



</div>
@stop

@push('scripts')
<script>
$(function() {

	$("[data-fancybox]").fancybox({
		// Options will go here
	});

});
</script>
@endpush