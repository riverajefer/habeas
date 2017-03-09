<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FORMULARIO</title>
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
        @include('../includes/publico/header')  

        <!-- Content -->
        <div class="container">
            @yield('content')
        </div>

        <!-- Scripts -->
        @include('../includes/publico/scripts')
    </body>
</html>
