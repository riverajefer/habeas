@extends('layouts.master')
@section('content')

@include('reportes.menu')

<div class="panel panel-default">
    <div class="panel-heading"> 
        <i class="fa fa-bars" aria-hidden="true"></i> Reportes
    </div>
    <div class="panel-body">
        <p>Formato tabla</p>
        <div class="alert alert-info" role="alert">
            Resultado historial de cambios entre el <b>{{$fecha_inicio}}</b> al <b>{{$fecha_fin}}</b><br>
            <a href="{{URL::route('reportes')}}">Nueva consulta</a>
        </div>
        <!-- 
        
        @if(count($auditoria)>0 and $auditoria[0]->event!='created')
            <div align="center">
                <a href="{{URL::route('getHistorialCambiosExcel', [$area_id, $registro_id, $fecha_inicio, $fecha_fin]  )}}"> 
                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar en Excel
                </a>
            </div>
            <hr>
        @else
          <div class="alert alert-danger" role="alert">No se encontraron resultados</div>
        @endif
        -->
          <div align="center">
                <a href="{{URL::route('getHistorialCambiosExcel', [$area_id, $registro_id, $fecha_inicio, $fecha_fin]  )}}"> 
                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar en Excel
                </a>
            </div>        

        <table class="table table-striped table-condensed table-bordered table-hover table-condensed mdl-data-table" id="registros-table">
            <thead>
                <tr>
                    <th>Id Registro</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Campo modificado</th>
                    <th>Valor antes</th>
                    <th>Valor despúes</th>
                </tr>
            </thead>
        <tbody>

            @forelse ($auditoria as $audit)
                @if($audit->event!='created' and ($audit->user!=Null))                        
                    @foreach ($audit->getModified() as $attribute => $modified)
                        <tr>
                            <td>
                                 <a href="{{URL::to('registros/'.$audit->auditable_id)}}"> {{$audit->auditable_id}} </a> 
                            </td>
                            <td>
                                 {{ $audit->created_at }} 
                            </td>
                            <td> 
                                {{ $audit->user->nombre }} 
                            </td>
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
                @endif    
                @empty
                <p>@lang('post.unavailable_audits')</p>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
