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
        <h4>Lista de Registros subidos: {{$registros->first()->created_at}}</h4>
        <ul class="nav nav-pills" style="float:right">
            <li role="presentation">
                <a href="{{URL::route('subidaMasiva')}}">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                       <i class="fa fa-arrow-left" aria-hidden="true"></i>  Volver
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
            <table class="table table-striped table-bordered table-hover mdl-data-table" id="registros-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Área</th>
                        <th>Procedencia</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($registros as $registro)
                    <tr>
                        <td>{{$registro->id}}</td>
                        <td>{{$registro->nombre}}</td>
                        <td>{{$registro->primer_apellido}}</td>
                        <td>{{$registro->email}}</td>
                        <td>{{$registro->area->titulo}}</td>
                        <td>{{$registro->procedencia}}</td>
                        <td>{{$registro->id? 'Activo':'Inactivo'}}</td>                        
                        <td>
                           <a class="btn btn-link link-info"  href="{{URL::to('registros/'.$registro->id)}}" data-toggle="tooltip" data-placement="top" title="Ver más"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @empty
                    <p>No Registros</p>                    
                @endforelse                        
                </tbody>
            </table>  
            {{ $registros->links() }} 
         </div>              
        </div>
    </div>
</div>


@stop
