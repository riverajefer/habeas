@extends('layouts.master')
@section('content')

@include('reportes.menu')

<div class="panel panel-default">
    <div class="panel-heading"> 
        <i class="fa fa-bars" aria-hidden="true"></i> Reportes
    </div>
    <div class="panel-body">

        <div class="alert alert-info" role="alert">
            Resultado historial de cambios entre el <b>{{$fecha_inicio}}</b> al <b>{{$fecha_fin}}</b><br>
            <a href="{{URL::route('reportes')}}">Nueva consulta</a>
        </div>
        <!--
        @if(count($auditoria)>0 and $auditoria[0]->event!='created')
            <div align="center">
                <a href="{{URL::route('getHistorialCambiosTabla', [$area_id, $registro_id, $fecha_inicio, $fecha_fin]  )}}"> 
                    <i class="fa fa-table" aria-hidden="true"></i> Ver en formato de tabla
                </a>
            </div>
            <hr>
        @else
          <div class="alert alert-danger" role="alert">
            No se encontraron resultados<br>
            <a href="{{URL::route('reportes')}}">Nueva consulta</a>
          </div>
          
        @endif
        -->

            <div align="center">
                <a href="{{URL::route('getHistorialCambiosTabla', [$area_id, $registro_id, $fecha_inicio, $fecha_fin]  )}}"> 
                    <i class="fa fa-table" aria-hidden="true"></i> Ver en formato de tabla
                </a>
            </div>        
        @forelse ($auditoria as $audit)

        @if($audit->event!='created' and ($audit->user!=Null))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div class="panel {{ $audit->event=='created' ? 'panel-info' : 'panel-success'}}">
                        <div class="panel-heading">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            El Registro <a href="{{URL::to('registros/'.$audit->auditable_id) or ''}}"> {{$audit->auditable_id or ''}} </a> 
                            fue <b>{{$audit->event=='created'? 'Creado':'Modificado'}} </b>
                            por el usuario: <b> {{  $audit->user->nombre or ''}} </b> el día <b> {{$audit->created_at or ''}} </b>
                        </div>
                    <table class="table table-striped table-condensed table-bordered table-hover table-condensed mdl-data-table" id="registros-table">
                        <thead>
                            <tr>
                                <th>Campo modificado</th>
                                <th>Valor antes</th>
                                <th>Valor despúes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audit->getModified() as $attribute => $modified)
                                <tr>
                                    <td>
                                        <b>{{ strtoupper(MyFuncs::fn_atributo($attribute, $audit, $modified)->atributo) }}</b>
                                    </td>
                                    <td>
                                        {!!MyFuncs::fn_atributo($attribute, $audit, $modified)->old!!}
                                    </td>
                                    <td>
                                        {!!MyFuncs::fn_atributo($attribute, $audit, $modified)->new!!}
                                    </td>
                                </tr>
                            @endforeach                        

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <br>
            <br>
        @endif    

            @empty
            <!-- <p>No se encontraron registros</p> -->
        @endforelse
        <br>
        <br>
    </div>
</div>

@stop
