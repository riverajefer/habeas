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
                    {{$registro->nombre}}
                </li>
                <li class="list-group-item">
                    <span>Ciudad:</span>  
                    {{$registro->nombre}}
                </li>                
                <li class="list-group-item">
                    <span>Estado::</span>  
                    {{$registro->estado}}
                </li>  
            </ul>  
        </div>
    </div>
  </div>
</div>
  
@stop