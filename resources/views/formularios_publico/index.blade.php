@extends('layouts.publico', ['titulo'=>'ACTUALIZACIÓN DE DATOS', 'texto'=>'FORMULARIO DE ACTUALIZACIÓN DE DATOS'])

@section('content')

<br>
<div class="panel panel-default">
    <div class="panel-heading"> 
        Formulario: {{$area->titulo}}
    </div>

    <div class="panel-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{ $message }}</p>
                </div>
            @endif
        <form action="{{ URL::to('formulario/guardar') }}" role="form" method="POST">

          {{ csrf_field() }}

          <div class="row">
            
            <div class="seg-titulo"> DATOS PERSONALES </div>
            
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombe">Nombre</label>
                    <input type="text" class="form-control" id="nombe" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" autofocus required>
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
                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Primer apellido" value="{{ old('primer_apellido') }}" required>
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
                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo apellido" value="{{ old('segundo_apellido') }}" required> 
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
                    <select name="tipo_documento" id="tipo_documento" class="form-control" required>
                       <option value="">Seleccione un tipo de documento</option>
                       @foreach($tipo_documento as $tipo_documento)
                        <option value="{{$tipo_documento}}"   {{ (collect(old('tipo_documento'))->contains($tipo_documento)) ? 'selected':'' }}  >{{$tipo_documento}}</option>
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
                    <label for="doc">Número de documento</label>
                    <input type="text" class="form-control" id="doc" name="doc" placeholder="Número de documento" value="{{ old('doc') }}" required>
                    @if ($errors->has('doc'))
                        <span class="help-block">
                            <strong>{{ $errors->first('doc') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 


            <div class="col-md-4">
                <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                    <label for="fecha">Fecha de nacimiento</label>
                    <div class='input-group date'>
                        <input type='text' id='datetimepicker' class="form-control" name="fecha_nacimiento" placeholder="aaa-mm-dd"  value="{{ old('fecha_nacimiento') }}" required>
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
                    <input type="text" class="form-control" id="profesion" name="profesion" placeholder="Profesion" value="{{ old('profesion') }}" required>
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
                    <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo" value="{{ old('cargo') }}" required>
                    @if ($errors->has('cargo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>       

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                     
        </div><!-- /row -->


          <div class="row">

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
                    <label for="empresa">Empresa o Entidad</label>
                    <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Empresa o Entidad" value="{{ old('empresa') }}" required>
                    @if ($errors->has('empresa'))
                        <span class="help-block">
                            <strong>{{ $errors->first('empresa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                    <label for="telefono">Teléfono fijo</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono fijo" value="{{ old('telefono') }}">
                    @if ($errors->has('telefono'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="{{ old('celular') }}" required>
                    @if ($errors->has('celular'))
                        <span class="help-block">
                            <strong>{{ $errors->first('celular') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 

        </div><!-- /row -->
        <div class="row">

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('departamento_id') ? ' has-error' : '' }}">
                    <label for="departamento">Departamento</label>
                    <select name="departamento_id" id="departamento" class="form-control" required>
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
                    <select name="municipio_id" id="municipio" class="form-control" required>
                    </select>
                    @if ($errors->has('municipio_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('municipio_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

        </div><!-- /row -->
        <br><br>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">    
                    {!! Recaptcha::render() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif            
                <!--     <div class="g-recaptcha" data-sitekey="6LcMbhoUAAAAADK6U1bVRh0xcDSlDQ1MvlDhLzAr"></div> -->
                </div>
           </div>
        </div>

        <hr>    
        <div class="row">
            <p style="padding:15px">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem voluptates minus illum aperiam, nisi qui voluptatibus incidunt facere, natus cupiditate. Blanditiis corrupti, omnis tenetur nisi unde maiores eveniet asperiores vitae.
            </p>
            <p>
            <a data-fancybox data-caption="Soporte" href="{{asset('files/tratamiento_de_datos.pdf')}}"> Ver Soporte </a>
            </p>
            <div class="col-md-3 col-md-offset-5">
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                    <input type="checkbox" name="autorizo" id="checkbox-1" class="mdl-checkbox__input" required>
                    <span class="mdl-checkbox__label">Si autorizo</span>
                </label>
                @if ($errors->has('autorizo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('autorizo') }}</strong>
                    </span>
                @endif                
            </div>
          </div>
        </div>

        <br><br>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                        ENVIAR INFORMACIÓN
                    </button>
                </div>
            </div>  
            <br><br>            
        </div> <!-- /row -->
        <input type="hidden" value="Formulario_{{$slug}}" name="procedencia">
        <input type="hidden" value="{{$area->id}}" name="area_id">

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
                
            $("[data-fancybox]").fancybox({
                // Options will go here
            });
        });
    </script>
@endpush