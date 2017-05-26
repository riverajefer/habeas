@extends('layouts.master')
@section('content')


  <dialog class="mdl-dialog">
    <h6 class="mdl-dialog__title">
      Alerta  <i class="fa fa-exclamation" aria-hidden="true"></i>
    </h6>
    <div align="center" class="mdl-dialog__content">
      <p>
        Desea dar de baja este registro
      </p>
      <p  class="text-danger">
        Id: <b><span id="span_id"></span></b>
      </p>
      <p id="load" style="display:none">
        <img src="{{asset('images/load.gif')}}" alt="load">
      </p>
       <span class="msg_delete"></span> 

    </div>
    <div class="mdl-dialog__actions">
      <button class="mdl-button mdl-js-button mdl-button--primary aceptar">Aceptar</button>
      <button type="button" class="mdl-button mdl-js-buttonmdl-button--accent close">Cerrar</button>
    </div>
  </dialog>

<script>

    function eliminar(id){
        console.log('id: '+id);
        $('#span_id').text(id);
        
        var dialog = document.querySelector('dialog');
        var showDialogButton = document.querySelector('#show-dialog');
        if (! dialog.showModal) {
             dialogPolyfill.registerDialog(dialog);
        }

        dialog.showModal();

        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });

        dialog.querySelector('.aceptar').addEventListener('click', function() {
            $('.msg_delete').empty();
            $("#load").show();
            $('.mdl-dialog__actions').hide();
            $('.msg_delete').text('Procesando...');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!!  URL::to('registros/baja') !!}',
                type: 'post',
                data: {id:id},

                success:function(msg){
                    console.log("msg: ",msg);
                    if(msg.status){
                        $("#load").hide();
                        $('.msg_delete').text('Registro dado de baja correctamente');
                        $('.mdl-dialog__actions').show();
                        setTimeout(function(){ dialog.close(); }, 1500);
                        window.location.href=window.location.href;
                        location.reload();
                    }else{
                        $('.msg_delete').text('Ha ocurrido un eror');
                        $("#load").hide();
                        $('.mdl-dialog__actions').show();
                    }
                }
            });

        });    

  }

</script>

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
                <li class="list-group-item">
                    <span>Ciudad:</span>  
                    {{$registro->municipio->nombre_municipio or ''}}
                </li>                
            </ul>  
        </div>
        <div class="col-md-6">
            <ul class="list-group">
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
                    <span>Operario:</span>  
                    {{ $registro->area->m_operario->nombre }}
                </li>  
                <li class="list-group-item">
                    <span>Encargados:</span>  
                    @if(count($registro->area->users)>0)
                    <ul>
                      @foreach($registro->area->users as $user)
                        <li>{{$user->nombre}}</li>
                      @endforeach
                    </ul>
                    @endif
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
                    @if($registro->deviceRegistro)
                        <button data-toggle="modal" data-target="#myModal" type="button" class="mdl-button">
                           VER
                        </button>
                    @endif
                </li>                  
                <li class="list-group-item {{ $registro->estado ? 'Activo': 'Inactivo'  }}">
                    
                    {{-- $registro->estado ? 'Activo': 'Dado de baja'  --}}
                    @if($registro->estado)
                        <span>Estado:</span>  Activo
                    @else
                        <span>Estado:</span>  Dado de baja <br>
                        <span>Por:</span>
                          @if($registro->baja_por)
                            {{App\Models\User::find($registro->baja_por)->nombre}}
                          @else
                            Mismo usuario
                          @endif
                    @endif
                </li>                  
            </ul>  
        </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Más información del registro </h4>
          </div>

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
    </div>
  </div>
</div>




<div class="row">
    <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-pills">

                @if(MyFuncs::usuarioRolPuede('crear registros'))
                    <li role="presentation">
                        <a href="{{URL::to('registros/create')}}">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo registro
                            </button>
                        </a> 
                    </li>
                @endif

                @if(MyFuncs::usuarioRolPuede('modificar registros'))
                    <li role="presentation">
                        <a href="{{URL::to('registros/'.$registro->id.'/edit')}}" title="Actualizar registro">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Actualizar registro
                            </button>  
                        </a>
                    </li>
                @endif
                <!--

                @if(MyFuncs::usuarioRolPuede('baja'))
                    @if($registro->estado==1)
                        <li role="presentation">
                            <a onclick="eliminar( {{$registro->id}} )" href="javascript:void(0)" title="Dar de baja el registro">
                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Dar de baja el registro
                                </button>  
                            </a>
                        </li>
                    @endif
                @endif                   
                -->

                    @if($registro->estado==1)
                        <li role="presentation">
                            <a onclick="eliminar( {{$registro->id}} )" href="javascript:void(0)" title="Dar de baja el registro">
                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Dar de baja el registro
                                </button>  
                            </a>
                        </li>
                    @endif

                <li role="presentation">
                    <a href="{{URL::to('registros')}}" title="Ver lista de registros">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                            <i class="fa fa-list" aria-hidden="true"></i> Ver todos 
                        </button>  
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{URL::to('registros/auditoria/'.$registro->id)}}" title="Historial de cambios">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect" {{$registro->audits()->first()? '':'disabled'}}>
                            <i class="fa fa-history" aria-hidden="true"></i> Historial de cambios
                        </button>  
                    </a>
                </li>  
            </ul>
    </div>
</div>
<br><br>
</div>

<br>
<br>
<br>





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
