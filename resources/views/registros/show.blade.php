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
                    <span>Profesión:</span>  
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
                <li class="list-group-item">
                    <span>Departamento:</span>  
                    {{$registro->municipio->ndepartamento->nombre or ''}}
                </li>
            </ul>  
        </div>
        <div class="col-md-6">
            <ul class="list-group">
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
                    {{ $registro->comentarios }}
                </li>                                                                                                    
                <li class="list-group-item">
                    <span>Procedencia del registro:</span>  
                    {{ $registro->procedencia }}
                </li>  
                <li class="list-group-item">
                    <span>Registro creado por:</span>  
                    {{ $registro->creadoPor->nombre or 'Usuario' }}
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
                <li class="list-group-item">
                    <span>Avanzado:</span>  
                    <button id="show-dialog" type="button" class="mdl-button">
                       {{ $registro->deviceRegistro ? 'VER':''}}
                    </button>
                </li>                  
                <li class="list-group-item {{ $registro->estado ? 'Activo': 'Inactivo'  }}">
                    <span>Estado:</span>  
                    {{ $registro->estado ? 'Activo': 'Dado de baja'  }}
                </li>                  
            </ul>  
        </div>
    </div>
  </div>

  <button id="show-dialog" type="button" class="mdl-button">Información avanzada</button>
  <dialog class="mdl-dialog">
    <div class="mdl-dialog__content">
      <p><b> Información de donde se hizo el registro </b> </p>
        <ul class="demo-list-item mdl-list">
        @if($registro->deviceRegistro)
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    Sistema: {{$registro->deviceRegistro->SO}} {{$registro->deviceRegistro->SO_version}}
                </span>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                   Tipo: {{$registro->deviceRegistro->device}}
                </span>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                   Navegador: {{$registro->deviceRegistro->browser}}
                </span>
            </li> 
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    IP: {{$registro->deviceRegistro->ip}}
                </span>
            </li> 
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    Dispositivo: {{$registro->deviceRegistro->tipo_device}}
                </span>
            </li>  
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    Pais: {{$registro->deviceRegistro->pais}}
                </span>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    {{$registro->deviceRegistro->departamento}} - 
                    {{$registro->deviceRegistro->ciudad}}
                </span>
            </li>                                                            
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                   Ubicación: {{$registro->deviceRegistro->ubicacion}}
                </span>
            </li>
            @endif 
        </ul>      
    </div>
    <div class="mdl-dialog__actions">
      <button class="mdl-button mdl-js-button mdl-button--accent close">Cerrar</button>
    </div>
  </dialog>


<div class="row">
    <div class="col-md-2 col-md-offset-3">
        <a href="{{URL::to('registros/'.$registro->id.'/edit')}}">
            <button class="mdl-button mdl-js-button mdl-button--primary">
                ACTUALIZAR REGISTRO
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

    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#show-dialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {
      dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });


	$("[data-fancybox]").fancybox({
		// Options will go here
	});

});
</script>
@endpush
