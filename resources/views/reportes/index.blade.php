@extends('layouts.master')

@section('content')

    <h4>REPORTES</h4>


<div class="panel panel-default">
    <div class="panel-heading"> 
        <i class="fa fa-user-plus" aria-hidden="true"></i> Reporte
    </div>
    <div class="panel-body">
        <h4>Consultar historial de cambios entre fechas</h4>
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                    <label for="departamento">Fecha *</label>            
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                        <span></span> <b class="caret"></b>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('registro') ? ' has-error' : '' }}">
                    <label for="departamento">Registro *</label>
                    <select name="registro" id="departamento" class="form-control" required>
                        <option value="">Seleccione un registro</option>
                        @foreach($registros as $registro)
                             <option value="{{$registro->id}}">{{$registro->nombre}} - {{$registro->empresa or 'NULL'}}</option>
                        @endforeach
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
  console.log(picker.startDate.format('YYYY-MM-DD'));
  console.log(picker.endDate.format('YYYY-MM-DD'));
});



        });
    </script>
@endpush