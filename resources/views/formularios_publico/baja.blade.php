@extends('layouts.publico', ['titulo'=>'DAR DE BAJA', 'texto'=>'CANCELAR SUSCRIPCIÓN'])

@section('content')

<br>
<div class="panel panel-default">
    <div class="panel-heading"> 
    </div>

    <div class="panel-body">


            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3>{{ $message }}</h3>
                </div>
            @endif
        <form action="{{ URL::to('formulario/baja') }}" role="form" method="POST">

          {{ csrf_field() }}

          <div class="row">

          <p class="text_baja">
          Por favor complete la siguiente información, para darse de baja.
          </p>
            
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('area_id') ? ' has-error' : '' }}">
                    <label for="area">Área a la que pertenece</label>
                    <select name="area_id" id="area"  class="form-control" value="{{ old('area') }}" required>
                       <option value="">Seleccione un área</option>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}" {{ old('area_id')==$area->id ? 'selected="selected"' : '' }}>{{$area->titulo}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('area_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('area_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

            @if($registro->telefono_personal)
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('telefono_personal') ? ' has-error' : '' }}">
                        <label for="telefono_personal">Escriba su número de teléfono fijo personal</label>
                        <input type="text" class="form-control" id="telefono_personal" name="telefono_personal" placeholder="Teléfono personal" value="{{ old('telefono_personal') }}">
                        @if ($errors->has('telefono_personal'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telefono_personal') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <input type="hidden" name="fijo" value="fijo">

            @elseif($registro->celular)
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                        <label for="celular">Escriba su número de celular personal</label>
                        <input type="text" class="form-control" id="celular" name="celular" placeholder="Número de celular" value="{{ old('celular') }}">
                        @if ($errors->has('celular'))
                            <span class="help-block">
                                <strong>{{ $errors->first('celular') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="ncelular" value="ncelular">
                
            @elseif($registro->fecha_nacimiento)

                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                        <label for="fecha">Seleccione su fecha de nacimiento</label>
                        <div class='input-group date'>
                            <input type='text' id='datetimepicker' class="form-control" name="fecha_nacimiento" placeholder="dd/mm/aaa" value="{{ old('fecha_nacimiento') }}">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar">
                                </span>
                            </span>
                        </div>
                        @if ($errors->has('fecha_nacimiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                            </span>
                        @endif                    
                    </div>
                </div> 
                <input type="hidden" name="fecha" value="fecha">
                
            @else
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('tipo_documento') ? ' has-error' : '' }}">
                        <label for="tipo_documento">Tipo documento</label>
                        <select name="tipo_documento" id="tipo_documento" class="form-control" disabled>
                        <option value="">Seleccione un tipo de documento</option>
                        @foreach($tipo_documento as $tipo_documento)
                            <option value="{{$tipo_documento}}"  {{ $registro->tipo_documento==$tipo_documento ? 'selected="selected"' : '' }}>{{$tipo_documento}}</option>
                        @endforeach
                        </select>

                        @if ($errors->has('tipo_documento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tipo_documento') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('doc') ? ' has-error' : '' }}">
                        <label for="doc">Escriba el número de documento</label>
                        <input type="text" class="form-control" id="doc" name="doc" placeholder="Número de docuemnto" value="{{ old('doc') }}">
                        @if ($errors->has('doc'))
                            <span class="help-block">
                                <strong>{{ $errors->first('doc') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> 
                <input type="hidden" name="ndoc" value="ndoc">

            @endif

          </div> <!-- /row -->
          <input type="hidden" name="registro_id" value="{{$registro->id}}">

            @if ($message = Session::get('error_baja'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{ $message }}</p>
                </div>
            @endif

        <hr>    
        <div class="row">
            <p style="padding:15px">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem voluptates minus illum aperiam, nisi qui voluptatibus incidunt facere, natus cupiditate. Blanditiis corrupti, omnis tenetur nisi unde maiores eveniet asperiores vitae.
            </p>
          </div>
        </div>

        <div class="im-centered">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                            DAR DE BAJA
                        </button>
                    </div>
                </div>  
                <br><br>            
            </div> <!-- /row -->
        </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{ $message }}</p>
                </div>
            @endif

        </form>
    </div>
</div>
@stop

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log("Create")
            $('#datetimepicker').datetimepicker({
                locale: 'es',
                format: 'YYYY-MM-DD',
                viewMode: 'years',
                maxDate : 'now',
                minDate : '-1910/12/31',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });

            // Select anidados

            $("#departamento").change(function(){
                console.log("change");
                $("#departamento option:selected").each(function () {

                    var elegido = $(this).val();
                    $("#municipio").empty();

                    $.post('{!! route('municipios') !!}', {id:elegido}, function(data){
                        console.log("retunr data: ", data);
                        if(data.length>0){
                            $.each(data, function(index,value){
                                $("#municipio").append('<option value='+value.id+'  >'+value.nombre_municipio+'</option>')
                            });
                        }
                    });

                });
            });
        });
    </script>
@endpush