<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$titulo or 'FORMULARIO'}}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">    

    
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

        <!-- Styles -->
        @include('../includes/publico/styles')
        
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>

    <body>
        <!-- Header -->
<header>

            <div class="row" align="center">
            <div class="col-md-2 col-xs-6 col-md-offset-3">
                <img src="{{asset('images/logo_annar.png')}}" alt="Annardx">
            </div>
            <div class="col-md-5 col-xs-6">
                <h1>{{$texto or 'FORMULARIO'}}</h1>
            </div>
            </div>
            
            </header>

        <!-- Content -->
        <div class="container">
            @yield('content')
        </div>

        <!-- Scripts -->
        @include('../includes/publico/scripts')
    </body>
</html>
