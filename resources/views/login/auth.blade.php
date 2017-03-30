@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">Ingresar al módulo habeas data</div>
              <div class="panel-body">
              
                <form action="{{URL::to('auth')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" autofocus required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif                        
                    </div>                    
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="pw">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="pw" placeholder="Contraseña" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif                        
                    </div>

                        @if(Session::has('errorLogin'))
                                <div class="alert alert-danger">
                                    {{ Session::get('errorLogin') }}
                                </div>
                        @endif

                    <br>
                    <div align="center">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Entrar al módulo de Habeas data
                        </button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
