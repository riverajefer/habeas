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
                <li class="list-group-item"><span>Documento:</span> 
                    <u>{{$registro->tipo_documento}}:</u> {{$registro->numero_docuemnto}}
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
            </ul>  
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">
                    <span>Empresa:</span>  
                    {{$registro->empresa}}
                </li>
                <li class="list-group-item">
                    <span>Teléfono:</span>  
                    {{$registro->telefono}}
                </li>
                <li class="list-group-item">
                    <span>Email:</span>  
                    {{$registro->email}}
                </li>
                <li class="list-group-item">
                    <span>Departamento:</span>  
                    {{$registro->municipio->ndepartamento->nombre}}
                </li>
                <li class="list-group-item">
                    <span>Ciudad:</span>  
                    {{$registro->municipio->nombre_municipio}}
                </li>
                <li class="list-group-item">
                    <span>Soporte:</span>  
                    @if($registro->archivo_soporte)
                        <a data-fancybox data-caption="Soporte" href="{{asset('uploads/soportes/'.$registro->archivo_soporte.'')}}"> Ver Soporte </a>
                    @else
                       No hay soporte
                    @endif
                    
                </li>                  
                <li class="list-group-item">
                    <span>Estado::</span>  
                    {{ $registro->estado ? 'Activo': 'Dado de baja'  }}
                </li>  
            </ul>  
        </div>
    </div>
  </div>
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