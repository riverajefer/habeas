@extends('layouts.master')
@section('content')


<br> 
<div class="row rtable">
    <div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i>  Lista de registros
        </div>
        <div class="panel-body">
        <ul class="nav nav-pills" style="float:right">
            <li role="presentation">
                <a href="{{URL::to('registros/create')}}">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo registro
                    </button>
                </a> 
            </li>
            <li role="presentation">
                <a href="#">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-clone" aria-hidden="true"></i> Subida masiva
                    </button>  
                </a>
            </li>
            <li role="presentation">
                <a href="{{URL::route('exportExcel')}}">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar en Excel
                    </button>  
                </a>
            </li>
            <li role="presentation">
                <a href="{{URL::route('registros')}}">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver
                    </button>  
                </a>
            </li>            
        </ul>
        </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{ $message }}</p>
                </div>
            @endif          
         <div class="table-responsive">        
            <table class="table table-striped table-bordered table-hover table-condensed display responsive nowrap" cellspacing="0" width="100%" id="registros-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Primer apellido</th>
                        <th>Segundo apellido</th>
                        <th>Tipo Doc</th>
                        <th>Documento</th>
                        <th>Fecha nacimiento</th>
                        <th>Email</th>
                        <th>Teléfono personal</th>
                        <th>Celular personal</th>
                        <th>Área</th>
                        <th>Profesión</th>
                        <th>Cargo</th>
                        <th>Empresa</th>
                        <th>Teléfono corporativo</th>
                        <th>Email corporativo</th>
                        <th>Celular corporativo</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th>Dirección</th>
                        <th>Soporte</th>
                        <th>SN</th>
                        <th>Asesor comercial</th>
                        <th>Estado del cliente</th>
                        <th>Tipo de registro</th>
                        <th>Menor de 18</th>
                        <th>Comentarios</th>

                        <th>Procedencia</th>
                        <th>Creado Por</th>
                        <th>Modificado Por</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de modificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>   
         </div>              
        </div>
    </div>
</div>

@stop

@push('scripts')
<script>
//$(".rtable").parents('.container').css("width", "100%");


$(function() {

    $.fn.dataTable.ext.errMode = 'none';
    $('#registros-table').DataTable({
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        },
         order: [ [0, 'desc'] ],      
        processing: true,
        serverSide: true,
        ajax: '{!! route('dataRegistrosTablaCompleta') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nombre', name: 'nombre' },
            { data: 'primer_apellido', name: 'primer_apellido' },
            { data: 'segundo_apellido', name: 'segundo_apellido' },
            { data: 'tipo_documento', name: 'tipo_documento' },
            { data: 'doc', name: 'doc' },
            { data: 'fecha_nacimiento', name: 'fecha_nacimiento' },
            { data: 'email', name: 'email' },
            { data: 'telefono_personal', name: 'telefono_personal' },
            { data: 'celular', name: 'celular' },
            { data: 'area.titulo', name: 'area.titulo' },
            { data: 'profesion', name: 'profesion' },
            { data: 'cargo', name: 'cargo' },
            { data: 'empresa', name: 'empresa' },
            { data: 'telefono_corporativo', name: 'telefono_corporativo' },
            { data: 'email_corporativo', name: 'email_corporativo' },
            { data: 'celular_corporativo', name: 'celular_corporativo' },
            { data: 'municipio.ndepartamento.nombre', name: 'municipio.ndepartamento.nombre' },
            { data: 'municipio.nombre_municipio', name: 'municipio.nombre_municipio' },
            { data: 'direccion', name: 'direccion' },
            { data: 'soporte', name: 'soporte' },
            { data: 'sn', name: 'sn' },
            { data: 'sn', name: 'sn' }, // asesor comercial
            { data: 'estado_cliente', name: 'estado_cliente' },
            { data: 'tipo_registro.titulo', name: 'tipo_registro.titulo' }, 
            { data: 'menor_de_18', name: 'menor_de_18' }, // ajustar
            { data: 'comentarios', name: 'comentarios' }, // ajustar

            { data: 'procedencia', name: 'procedencia' },
            { data: 'creado_por.nombre', name: 'creado_por.nombre'},
            { data: 'modificado_por', name: 'modificado_por'},
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        console.log("row: ", row);
                        var data = row.data();
                        //return 'Details for '+data[0]+' '+data[1];
                        return 'Detalles del registro';
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
        
    });
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

	$("[data-fancybox]").fancybox({
		// Options will go here
	});


});
</script>
@endpush
