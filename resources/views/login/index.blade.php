@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="widget">
            <div class="widget-content">
                <form action="{{URL::to('login')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="pw">Vuelva a escribir la contraseña</label>
                        <input type="password" name="password" class="form-control" id="pw" placeholder="Contraseña" required>
                    </div>
                    <br>
                    <input type="hidden" value="{{$email}}" name="email">
                    <div align="center">
                        <button type="submit" class="btn btn-info">Entrar al módulo de Habeas data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
