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
                    <p class="help-block">Example block-level help text here.</p>
                </div>  
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                                CARGAR ARCHIVO
                            </button>
                        </div>
                    </div>              
                </div> <!-- /row -->                  
            </form>
        </div>

        <div class="col-md-6">
            <h4>Instrucciones</h4>
            <ul>
                <li>Descargue el archivo base <a href="#"> aquí </a> </li> 
                <li>Complete las celdas</li>
                <li>Descargar archivo excel: <a href="{{URL::Route('excelMunicipios')}}">Ciudades - Áreas</a></li>
            </ul> 
        </div>
    </div>
  </div>

</div>


@stop

@push('scripts')
<script>
//
</script>
@endpush