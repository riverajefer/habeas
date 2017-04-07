@extends('layouts.master')
@section('content')

<script>

    function eliminar(id){
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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i>  Lista de registros
        </div>
        <div class="panel-body">
        <ul class="nav nav-pills" style="float:right">

            @unless( count(Auth::user()->areasResponsable()->first())>0  && count(Auth::user()->areasOperario()->first())==0 )
                <li role="presentation">
                    <a href="{{URL::to('registros/create')}}">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo registro
                        </button>
                    </a> 
                </li>
                @endunless        
                @if( count(Auth::user()->areasResponsable()->first())==0  && count(Auth::user()->areasOperario()->first())==0 )
                    <li role="presentation">
                        <a href="{{URL::route('subidaMasiva')}}">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                <i class="fa fa-clone" aria-hidden="true"></i> Subida masiva
                            </button>  
                        </a>
                    </li>
                @endif        
            <li role="presentation">
                <a href="{{URL::route('exportExcel')}}">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar en Excel
                    </button>  
                </a>
            </li>
            <li role="presentation">
                <a href="{{URL::route('registrosTablaCompleta')}}">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-table" aria-hidden="true"></i> Ver tabla completa
                    </button>  
                </a>
            </li>            
        </ul>
        </div>
        
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5>{{ $message }}</h5>
                    @if(Session::get('registro_id'))
                        <a href="{{URL::to('registros/'.Session::get('registro_id'))}}">Ver Registro</a>
                    @endif
                </div>
            @endif          
         <div class="table-responsive">        
            <table class="table table-striped table-bordered table-hover mdl-data-table" id="registros-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Documento</th>
                        <th>Área</th>
                        <th>Operario</th>
                        <th>Responsable</th>
                        <th>Procedencia</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>   
         </div>              
        </div>
    </div>
</div>

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

@stop

@push('scripts')
<script>
$(function() {
     $.fn.dataTable.ext.errMode = 'none';

    $('#registros-table').DataTable({
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        },
        order: [ [8, 'desc'], [0, 'desc']],      
        processing: true,
        serverSide: true,
        "createdRow": function( row, data, dataIndex ) {
            if ( data['estado'] == "Inactivo" ) {
                $( row ).addClass( "danger" );
            }
        },    
        ajax: '{!! route('dataRegistros') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nombre', name: 'nombre' },
            { data: 'primer_apellido', name: 'primer_apellido' },
            { data: 'doc', name: 'doc' },
            { data: 'area.titulo', name: 'area.titulo' },
            { data: 'operario', name: 'operario' },
            { data: 'responsable', name: 'responsable' },
            { data: 'procedencia', name: 'procedencia' },
            { data: 'estado', name: 'estado' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],



    });
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

});

</script>
@endpush
