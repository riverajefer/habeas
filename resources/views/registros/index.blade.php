@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="widget">
            <div class="widget-content">
               <p>Lista de registros</p>
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
