@extends('layouts.master')

@section('content')
    <div align="center">
        <h2>Error 404</h2>
        <h3>
         Upps !<br>
         Página no encontrada
        </h3>
        <h4>
            Hasta aquí te trajo el tren
        </h4>
        <a href="{{ url('/') }}"> 
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
                VOLVER AL INICIO
            </button>
        </a>
    </div>
@stop
