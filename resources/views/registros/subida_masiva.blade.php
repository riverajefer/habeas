@extends('layouts.master')
@section('content')


<div class="panel panel-default">

    <div class="panel-heading"> 
        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Subida masiva
    </div>

    <div class="panel-body">

    <div class="row">
        <div class="col-md-6" style="border-right:1px solid #ccc">
            <h4>Subida masiva</h4>
            <form action="{{ route('postSubidaMasiva') }}" role="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="file">Archivo xlsx</label>
                    <input type="file" id="file" name="file" required>
                    <p class="help-block">Archivo de tipo xlsx.</p>
                </div>  
                
                <div id="validation_errors">
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <button id="load_btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                                CARGAR ARCHIVO
                            </button>
                        </div>
                    </div>              
                </div> <!-- /row --> 
                <br>
                <div id="load_progress" align="center">
                    <br>
                    <img src="{{asset('images/load.gif')}}" alt="">
                    <p>Cargando información...</p>
                </div> 
                <div id="load_ok" class="alert alert-success" role="alert">
                   <h4>Registros guardados correctamente: <span class="badge cantidad"></span></h4>
                   <p align="center"> <a href="#" id="enlace">VER REGISTROS</a> </p>
                </div>
                <div id="load_error" class="alert alert-danger" role="alert">
                   <h4>Ha ocurrido un error, revise el archivo de registro</h4>
                   <p id="error_text"></p>
                </div>

            </form>
        </div>

        <div class="col-md-6">
            <h4>Instrucciones</h4>
            <ul>
                <li>Descargue el archivo base <a href="#" > AQUÌ </a> </li> 
                <li>Descargar archivo de identificadores: <a href="{{URL::Route('excelMunicipios')}}">AQUÍ</a></li>
                <li>Complete las celdas</li>
            </ul> 
        </div>
    </div>
  </div>

</div>


@stop

@push('scripts')
<script>

    // Inicializaciòn de variables

$load_btn      = $('#load_btn');
$load_progress = $('#load_progress');
$load_ok       = $('#load_ok');
$load_error    = $('#load_error');
$validation_errors    = $('#validation_errors');

    
function inicioLoad(){
    $load_progress.hide();
    $load_ok.hide();
    $load_error.hide();
    $load_btn.show();
    $validation_errors.hide();
}

inicioLoad();
$('form').submit(function(e){
    e.preventDefault();

    $load_btn.hide();
    $load_progress.show();
    $load_ok.hide();
    $load_error.hide();
    $validation_errors.hide();

    var formData = new FormData();
    formData.append('file', $('#file')[0].files[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });    
    $.ajax({
        url : '{!! URL::Route('postSubidaMasiva') !!}',
        type : 'POST',
        data : formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
            console.log("Retorno: ", data);
            if(data.status){
                $('form')[0].reset();
                $load_btn.show();
                $load_progress.hide();
                $load_ok.show('slow');
                $('.cantidad').text(data.cantidad);
                $('#enlace').attr('href', '{!! URL::to("reg/subida_masiva_registros/") !!}'+'/'+data.id)
            }else{
                $load_btn.show();
                $load_progress.hide();
                console.log("Error");
                $('form')[0].reset();
                $validation_errors.show();
                $load_error.show();
                //$("#error_text").text(data.errors);

                errorsHtml = '<div class="alert alert-danger"><ul>';

                $.each( data.errors, function( key, value ) {
                    errorsHtml += '<li>' + value + '</li>';
                });
                errorsHtml += '</ul></div>';
                    
                $('#validation_errors').html( errorsHtml );


            }
        },
        error :function( jqXhr ) {
            if( jqXhr.status === 422 ) {

                inicioLoad()
                $validation_errors.show();

                $errors = jqXhr.responseJSON;
                
                errorsHtml = '<div class="alert alert-danger"><ul>';

                $.each( $errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                errorsHtml += '</ul></div>';
                    
                $('#validation_errors').html( errorsHtml );
                
                } else {
                    /// do some thing else
                }
            }        
    });


    

});

</script>
@endpush