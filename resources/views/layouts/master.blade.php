<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AnnarNet Habeas</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">        

        <!-- Styles -->
        @include('../includes/styles')

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>

    <body>
        <!-- Header -->
        @include('../includes/header')  
        <div class="container">
            @yield('content')
        </div>

        <!-- Scripts -->
        @include('../includes/scripts')
    </body>
</html>