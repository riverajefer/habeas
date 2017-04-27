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

                <div class="form-group{{ $errors->has('usuarios') ? ' has-error' : '' }}">
                    <label for="ajax-select">Asignar usuarios</label><br>
                    <select class="selectpicker form-control" multiple required name="usuarioss[]">
                        @foreach($usuarios as $user)
                            <option value="{{$user->id}}">{{$user->nombre}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('usuarios'))
                        <span class="help-block">
                            <strong>{{ $errors->first('usuarios') }}</strong>
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

});

</script>
@endpush