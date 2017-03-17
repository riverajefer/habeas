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
                    <label for="tipo_documento">Tipo de documento</label>
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
                    <input type="text" class="form-control" id="doc" name="doc" placeholder="Número de docuemnto" value="{{ old('doc') }}" required>
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
                        <input type='text' id='datetimepicker' class="form-control" name="fecha_nacimiento" placeholder="aaa/mm/dd"  value="{{ old('fecha_nacimiento') }}" required>
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
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email personal</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>  
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                    <label for="celular">Celular personal</label>
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Número de celular" value="{{ old('celular') }}" required>
                    @if ($errors->has('celular'))
                        <span class="help-block">
                            <strong>{{ $errors->first('celular') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('telefono_personal') ? ' has-error' : '' }}">
                    <label for="telefono_personal">Teléfono fijo personal</label>
                    <input type="text" class="form-control" id="telefono_personal" name="telefono_personal" placeholder="Teléfono personal" value="{{ old('telefono_personal') }}" required>
                    @if ($errors->has('telefono_personal'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefono_personal') }}</strong>
                        </span>
                    @endif
                </div>
            </div>               
                               
        </div> <!-- /row -->



          <div class="row">
           <div class="seg-titulo"> DATOS LABORALES </div>

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
                <div class="form-group{{ $errors->has('telefono_corporativo') ? ' has-error' : '' }}">
                    <label for="telefono_corporativo">Teléfono corporativo</label>
                    <input type="text" class="form-control" id="telefono_corporativo" name="telefono_corporativo" placeholder="Teléfono corporativo" value="{{ old('telefono_corporativo') }}" required>
                    @if ($errors->has('telefono_corporativo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefono_corporativo') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('email_corporativo') ? ' has-error' : '' }}">
                    <label for="email_corporativo">Email corporativo</label>
                    <input type="email" class="form-control" id="email_corporativo" name="email_corporativo" placeholder="Email corporativo" value="{{ old('email_corporativo') }}" required>
                    @if ($errors->has('email_corporativo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email_corporativo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   

        </div><!-- /row -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('celular_corporativo') ? ' has-error' : '' }}">
                    <label for="celular_corporativo">Celular corporativo</label>
                    <input type="text" class="form-control" id="celular_corporativo" name="celular_corporativo" placeholder="Celular corporativo" value="{{ old('celular_corporativo') }}" required>
                    @if ($errors->has('celular_corporativo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('celular_corporativo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>  
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
        
        <div class="row">

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="{{ old('direccion') }}" required>
                    @if ($errors->has('direccion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('direccion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>              

        </div><!-- /row -->

        <div class="row">
            <div class="seg-titulo"> OTROS DATOS </div>

            <div class="col-md-4">
                <div class="form-group{{ $errors->has('sn') ? ' has-error' : '' }}">
                    <label for="sn">SN</label>
                    <input type="text" class="form-control" id="sn" name="sn" placeholder="SN" value="{{ old('sn') }}" required>
                    @if ($errors->has('sn'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sn') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
             <div class="col-md-4">
                <div class="form-group{{ $errors->has('asesor_comercial') ? ' has-error' : '' }}">
                    <label for="asesor_comercial">Asesor comercial</label>
                    <select name="asesor_comercial" id="asesor_comercial" class="form-control" required>
                        <option value="">Seleccione un asesor</option>
                        <option value="1">Cliente Activo</option>
                        <option value="2">Cliente Inactivo</option>

                    </select>

                    @if ($errors->has('estado_cliente'))
                        <span class="help-block">
                            <strong>{{ $errors->first('estado_cliente') }}</strong>
                        </span>
                    @endif
                </div>
            </div>               
             <div class="col-md-4">
                <div class="form-group{{ $errors->has('estado_cliente') ? ' has-error' : '' }}">
                    <label for="estado_cliente">Estado del cliente</label>
                    <select name="estado_cliente" id="estado_cliente" class="form-control" required>
                        <option value="">Seleccione un estado</option>
                        @foreach($estado_cliente as $estado_cliente)
                            <option value="{{$estado_cliente}}"   {{ (collect(old('estado_cliente'))->contains($estado_cliente)) ? 'selected':'' }}  >{{$estado_cliente}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('estado_cliente'))
                        <span class="help-block">
                            <strong>{{ $errors->first('estado_cliente') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                            
        </div><!-- /row -->
        <div class="row">
             <div class="col-md-4">
                <div class="form-group{{ $errors->has('comentarios') ? ' has-error' : '' }}">
                    <label for="comentarios">Comentarios</label>
                    <textarea name="comentarios" id="comentarios" placeholder="Comentarios" class="form-control" cols="30" rows="3">{{ old('comentarios') }}</textarea>
                    @if ($errors->has('comentarios'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comentarios') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   
             <div class="col-md-4">
                <div class="form-group{{ $errors->has('tipo_registro') ? ' has-error' : '' }}">
                    <label for="tipo_registro">Tipo de registro</label>
                    <select name="tipo_registro" id="tipo_registro" class="form-control" required>
                        <option value="">Seleccione el tipo de registro</option>
                        @foreach($tipo_registro as $tipo_registro)
                            <option value="{{$tipo_registro->id}}" {{ old('tipo_registro')==$tipo_registro->id ? 'selected="selected"' : '' }}>{{$tipo_registro->titulo}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('tipo_registro'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tipo_registro') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 
        </div><!-- /row -->

        <div class="row">
        <div class="seg-titulo"> SUBIR SOPORTE</div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('soporte') ? ' has-error' : '' }}">
                    <label for="soporte">Formatos permitidos jpeg, png, jpg, gif, svg, pdf. Tamaño máximo 10 Megas</label>
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
        <input type="hidden" value="Panel de administración" name="procedencia">

        </form>
    </div>
    <br><br>
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
            console.log("Old dep: " )


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