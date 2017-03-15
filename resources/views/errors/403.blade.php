@extends('layouts.master')

@section('content')
    <div align="center">
        <h2>Error 403</h2>
        <h4>
         Upps !<br>
         No tienes permiso para acceser a está ruta
        </h4>

        <a href="{{ url('/') }}"> 
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
                VOLVER AL INICIO
            </button>
        </a>
    </div>
@stop
