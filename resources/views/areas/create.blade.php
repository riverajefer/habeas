@extends('layouts.master')

@section('content')

<br>


<div class="panel panel-default">

    <div class="panel-heading"> 
        <i class="fa fa-user-plus" aria-hidden="true"></i> Crear área
    </div>

    <div class="panel-body">

       <form action="{{ route('areas.store') }}" role="form" method="POST">
          {{ csrf_field() }}

            <div class="col-md-6 col-md-offset-3">
            
                <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                    <label for="nombe">Titulo</label>
                    <input type="text" class="form-control" v-model="formInputs.titulo" id="nombe" name="titulo" placeholder="Titulo" value="{{ old('titulo') }}" autofocus required>
                    @if ($errors->has('titulo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('titulo') }}</strong>
                        </span>
                    @endif
                </div>      

                <div class="form-group{{ $errors->has('responsable') ? ' has-error' : '' }}">
                    <label for="ajax-select">Usuario Responsable</label><br>
                    <select id="ajax-select" class="selectpicker with-ajax form-control" name="responsable" required data-live-search="true"></select>
                    @if ($errors->has('responsable'))
                        <span class="help-block">
                            <strong>{{ $errors->first('responsable') }}</strong>
                        </span>
                    @endif
                </div>  

                <div class="form-group{{ $errors->has('operario') ? ' has-error' : '' }}">
                    <label for="ajax-select">Usuario Operario</label><br>
                    <select id="ajax-select" class="selectpicker with-ajax form-control" name="operario" required data-live-search="true"></select>
                    @if ($errors->has('operario'))
                        <span class="help-block">
                            <strong>{{ $errors->first('operario') }}</strong>
                        </span>
                    @endif
                </div> 



                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                            GUARDAR
                        </button>
                    </div>
                </div>              
            </div>
        </form>
    </div>
</div>


@stop



@push('scripts')
<script>
$(function() {

var options = {
        ajax        : {
            url     : '{!! route('usersHabeas') !!}',
            type    : 'GET',
            dataType: 'json',
        },
        locale        : {
            emptyTitle: 'Seleccione un usuario'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].nombre,
                        value: data[i].id,
                        data : {
                            subtext: data[i].email
                        }
                    }));
                }
            }
            return array;
        }
    };
    $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

    $('select').trigger('change');


});

</script>
@endpush