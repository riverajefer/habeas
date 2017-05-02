@extends('layouts.master')

@section('content')

@include('reportes.menu')

<div class="panel panel-default">
    <div class="panel-heading"> 
        <i class="fa fa-bars" aria-hidden="true"></i> Reportes
    </div>
    <div class="panel-body">
        <h4>Consultar historial de cambios entre fechas</h4>
        <form action="{{ route('getHistorialCambios') }}" role="form" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                        <label for="departamento">Fecha *</label>            
                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                        <label for="area">Áreas *</label>
                        <select name="area" id="area" class="form-control" required>
                            <option value="">Seleccione un área</option>
                            @foreach($areas as $area)
                                <option value="{{$area->id}}">{{$area->titulo}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('area'))
                            <span class="help-block">
                                <strong>{{ $errors->first('area') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>                

                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('registro') ? ' has-error' : '' }}">
                        <label for="registro">Registro *</label>
                        <select name="registro" id="registro" class="form-control" required>
                        </select>
                        @if ($errors->has('registro'))
                            <span class="help-block">
                                <strong>{{ $errors->first('registro') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                        BUSCAR
                    </button>
                </div>
            </div>
            <input type="hidden" name="fecha_inicio">
            <input type="hidden" name="fecha_fin">
            
        </form> 
    </div>
</div>

@stop

@push('scripts')
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script type="text/javascript">
        $(function () {

                var start = moment().subtract(29, 'days');
                var end = moment();

                $("input[name='fecha_inicio']").val(start.format('YYYY-MM-DD'));
                $("input[name='fecha_fin']").val(end.format('YYYY-MM-DD'));

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                        'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);
                
                $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                    $("input[name='fecha_inicio']").val(picker.startDate.format('YYYY-MM-DD'));
                    $("input[name='fecha_fin']").val(picker.endDate.format('YYYY-MM-DD'));
                });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#area").change(function(){
                console.log("change");
                $("#area option:selected").each(function () {

                    var elegido = $(this).val();
                    $("#registro").empty();
                    $("#registro").append('<option value="0">Todos</option>')

                    $.post('{!! route('registrosByArea') !!}', {id:elegido}, function(data){
                        console.log("retunr data: ", data);
                        if(data.length>0){
                            $.each(data, function(index,value){
                                $("#registro").append('<option value='+value.id+'  >('+value.id+') '+value.nombre+'- '+value.empresa+'</option>')
                            });
                        }
                    });

                });
            });



        });
    </script>
@endpush
