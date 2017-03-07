@extends('layouts.master')
@section('content')

<br> 
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i>  Lista de Áreas
        </div>
        <div class="panel-body">
        <ul class="nav nav-pills" style="float:right">
            <li role="presentation">
                <a href="{{URL::to('areas/create')}}">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        <i class="fa fa-briefcase" aria-hidden="true"></i> Agregar área
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
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>{{ $message }}</p>
        </div>
        @endif        
         <div class="table-responsive">        
            <table class="table table-striped table-bordered table-hover mdl-data-table" id="areas-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Persona encargada</th>
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
    $('#areas-table').DataTable({
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        },      
        processing: true,
        serverSide: true,
        ajax: '{!! route('dataAreas') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'titulo', name: 'titulo' },
            { data: 'user.nombre', name: 'user.nombre' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});

</script>
@endpush
