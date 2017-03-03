@extends('layouts.master')
@section('content')

<br> 
<div class="row">
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
                <a href="#">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar en Excel
                    </button>  
                </a>
            </li>
        </ul>
        </div>
         <div class="table-responsive">        
            <table class="table table-striped table-bordered table-hover mdl-data-table" id="registros-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Teléfono</th>
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
$(function() {
    $('#registros-table').DataTable({
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        },      
        processing: true,
        serverSide: true,
        ajax: '{!! route('dataRegistros') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nombre', name: 'nombre' },
            { data: 'primer_apellido', name: 'primer_apellido' },
            { data: 'email', name: 'email' },
            { data: 'telefono', name: 'telefono' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});

</script>
@endpush
