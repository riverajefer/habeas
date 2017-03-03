@extends('layouts.master')

@section('content')

<br>
<div class="panel panel-default">

    <div class="panel-heading"> 
        <i class="fa fa-user-plus" aria-hidden="true"></i> Crear registro
    </div>

    <div class="panel-body">
        <form action="{{ route('registros.store') }}" role="form" method="POST">
          {{ csrf_field() }}
            <div class="col-xs-4">
                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombe">Nombre</label>
                    <input type="text" class="form-control" id="nombe" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="nombe">Email</label>
                    <input type="text" class="form-control" id="nombe" name="email" placeholder="Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 
            <div class="col-xs-4">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="nombe">Email</label>
                    <input type="text" class="form-control" id="nombe" name="email" placeholder="Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                        
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>            
        </form>
    </div>
</div>



@stop
