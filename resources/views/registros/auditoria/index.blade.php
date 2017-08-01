@extends('layouts.master')
@section('content')


<br> 
<h5>HISTORIAL DE CAMBIOS</h5>


@forelse ($auditoria as $audit)

@if($audit->event!='created' and ($audit->user!=Null))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel {{ $audit->event=='created' ? 'panel-info' : 'panel-success'}}">
                <div class="panel-heading">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    El Registro <a href="{{URL::to('registros/'.$audit->auditable_id)}}"> {{$audit->auditable_id or ''}} </a> 
                    fue <b>{{$audit->event=='created'? 'Creado':'Modificado'}} </b>
                    por el usuario: <b> {{  $audit->user->nombre or 'Mismo Usuario' }} </b> el día <b> {{$audit->created_at or '' }} </b>
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
    <p>@lang('post.unavailable_audits')</p>
@endforelse
<br>
<br>
@stop
