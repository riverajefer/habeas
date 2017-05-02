@extends('layouts.master')

@section('content')

<br>


<div class="panel panel-default">

    <div class="panel-heading"> 
        <i class="fa fa-user-plus" aria-hidden="true"></i> Modificar área
    </div>

    <div class="panel-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

    {!! Form::model($area, ['method' => 'PATCH','route' => ['areas.update', $area->id]]) !!}

          {{ csrf_field() }}

              <div class="col-md-6 col-md-offset-3">
            
                <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                    <label for="nombe">Titulo</label>
                    <input type="text" class="form-control" v-model="formInputs.titulo" id="nombe" name="titulo" placeholder="Titulo" value="{{$area->titulo}}" autofocus required>
                    @if ($errors->has('titulo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('titulo') }}</strong>
                        </span>
                    @endif
                </div>      

                <div class="form-group{{ $errors->has('usuarios') ? ' has-error' : '' }}">
                    <label for="ajax-select">Asignar usuarios</label><br>
                    <select class="selectpicker form-control" multiple required name="usuarios[]">
                        @foreach ($usuarios as $user)
                            @foreach($usuarios_s as $us)
                                @if($user->id == $us->id)
                                    <option value="{{$user->id}}" selected>{{$user->nombre}}</option>
                                    <?php continue 2; ?>
                                @endif
                            @endforeach
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