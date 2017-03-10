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
                    <span>Teléfono:</span>  
                    {{$registro->telefono}}
                </li>                               
            </ul>  
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">
                    <span>Email:</span>  
                    {{$registro->email}}
                </li>
                <li class="list-group-item">
                    <span>Departamento:</span>  
                    {{$registro->municipio->ndepartamento->nombre or ''}}
                </li>
                <li class="list-group-item">
                    <span>Ciudad:</span>  
                    {{$registro->municipio->nombre_municipio or ''}}
                </li>
                <li class="list-group-item">
                    <span>Archivo de soporte:</span>  
                    @if($registro->archivo_soporte)
                        <a data-fancybox data-caption="Soporte" href="{{asset('uploads/soportes/'.$registro->archivo_soporte.'')}}"> Ver Soporte </a>
                    @else
                       
                    @endif
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
    <div class="col-md-3 col-md-offset-3">
        <a href="{{URL::to('registros/'.$registro->id.'/edit')}}">
            <button class="mdl-button mdl-js-button mdl-button--primary">
                MODIFICAR REGISTRO
            </button>
        </a>
    </div>
    
    <div class="col-md-3">
        <a href="{{URL::to('registros/create')}}">
            <button class="mdl-button mdl-js-button mdl-button--accent">
                NUEVO REGISTRO
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