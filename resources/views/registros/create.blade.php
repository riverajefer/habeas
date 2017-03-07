@extends('layouts.master')

@section('content')

<br>
<div class="panel panel-default">

    <div class="panel-heading"> 
        <i class="fa fa-user-plus" aria-hidden="true"></i> Crear registro
    </div>

    <div class="panel-body">

        <form action="{{ route('registros.store') }}" role="form" method="POST" enctype="multipart/form-data">

          {{ csrf_field() }}

          <div class="row">
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombe">Nombre</label>
                    <input type="text" class="form-control" id="nombe" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" autofocus>
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('primer_apellido') ? ' has-error' : '' }}">
                    <label for="primer_apellido">Primer apellido</label>
                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Primer apellido" value="{{ old('primer_apellido') }}">
                    @if ($errors->has('primer_apellido'))
                        <span class="help-block">
                            <strong>{{ $errors->first('primer_apellido') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 


            <div class="col-md-4">
                <div class="form-group{{ $errors->has('segundo_apellido') ? ' has-error' : '' }}">
                    <label for="segundo_apellido">Segundo apellido</label>
                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo apellido" value="{{ old('segundo_apellido') }}"> 
                    @if ($errors->has('segundo_apellido'))
                        <span class="help-block">
                            <strong>{{ $errors->first('segundo_apellido') }}</strong>
                        </span>
                    @endif
                </div>
            </div>    
          </div> <!-- /row -->


          <div class="row">
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('tipo_documento') ? ' has-error' : '' }}">
                    <label for="tipo_documento">Tipo documento</label>
                    <select name="tipo_documento" id="tipo_documento" class="form-control">
                        <option selected="selected" value="1">Cédula de Ciudadanía</option>
                        <option value="2">Cédula de Extranjería</option>
                        <option value="3">NIT</option>
                        <option value="5">Tarjeta de Identidad</option>
                        <option value="6">Registro Civil</option>
                        <option value="7">Pasaporte</option>
                        <option value="8">Carné Diplomático</option>
                    </select>

                    @if ($errors->has('tipo_documento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tipo_documento') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('numero_docuemnto') ? ' has-error' : '' }}">
                    <label for="numero_docuemnto">Número de documento</label>
                    <input type="text" class="form-control" id="numero_docuemnto" name="numero_docuemnto" placeholder="Número de docuemnto" value="{{ old('numero_docuemnto') }}">
                    @if ($errors->has('numero_docuemnto'))
                        <span class="help-block">
                            <strong>{{ $errors->first('numero_docuemnto') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 


            <div class="col-md-4">
                <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                    <label for="fecha">Fecha de nacimiento</label>
                    <div class='input-group date' id='datetimepicker8'>
                        <input type='text' class="form-control" name="fecha_nacimiento" placeholder="dd/mm/aaa"  value="{{ old('fecha_nacimiento') }}">
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

          </div> <!-- /row -->
          <div class="row">

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('profesion') ? ' has-error' : '' }}">
                    <label for="profesion">Profesión</label>
                    <input type="text" class="form-control" id="profesion" name="profesion" placeholder="Profesion" value="{{ old('profesion') }}">
                    @if ($errors->has('profesion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('profesion') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                    <label for="cargo">Cargo</label>
                    <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo" value="{{ old('cargo') }}">
                    @if ($errors->has('cargo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>             

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
                    <label for="empresa">Empresa o Entidad</label>
                    <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Empresa o Entidad" value="{{ old('empresa') }}">
                    @if ($errors->has('empresa'))
                        <span class="help-block">
                            <strong>{{ $errors->first('empresa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

        </div><!-- /row -->


          <div class="row">

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}">
                    @if ($errors->has('telefono'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('area_id') ? ' has-error' : '' }}">
                    <label for="area">Área a la que pertenece</label>
                    <select name="area_id" id="area"  class="form-control" value="{{ old('area') }}" >
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

        </div><!-- /row -->
        <div class="row">

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('departamento_id') ? ' has-error' : '' }}">
                    <label for="departamento">Departamento</label>
                    <select name="departamento_id" id="departamento" class="form-control" >
                        <option value="">Seleccione un departamento</option>
                        @foreach($departamentos as $departamento)
                             <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('departamento_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('departamento_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('municipio_id') ? ' has-error' : '' }}">
                    <label for="municipio">Ciudad</label>
                    <select name="municipio_id" id="municipio" class="form-control" >
                        
                    </select>
                    @if ($errors->has('municipio_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('municipio_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

        </div><!-- /row -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('soporte') ? ' has-error' : '' }}">
                    <label for="soporte">Soporte</label>
                    <input type="file" name="soporte" id="soporte">
                    @if ($errors->has('soporte'))
                        <span class="help-block">
                            <strong>{{ $errors->first('soporte') }}</strong>
                        </span>
                    @endif
               </div>
           </div>
        </div><!-- /row -->

        <br>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                        ENVIAR INFORMACIÓN
                    </button>
                </div>
            </div>              
        </div> <!-- /row -->
        <input type="hidden" value="Administración" name="procedencia">

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
            $('#datetimepicker8').datetimepicker({
                format: 'DD/MM/YYYY',
                viewMode: 'years',
                maxDate : 'now',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });

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