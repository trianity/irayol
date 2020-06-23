<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@stack('title')</title>

        <!-- Styles -->
        <link href="{{ asset('manager/css/custom-style.css') }}" rel="stylesheet" />
        <link href="{{ asset('manager/AdminLTE-3.0.5/dist/css/adminlte.css') }}" rel="stylesheet" />
        <link href="{{ asset('manager/AdminLTE-3.0.5/dist/css/skin-midnight.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
        
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,700" rel="stylesheet">
        @stack('css')
    </head>
    <body class="hold-transition login-page">        

        @yield('content')

        <!-- Javascript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="{{ asset('manager/AdminLTE-3.0.5/dist/js/adminlte.js') }}"></script>

        <!-- Javascript -->
        @stack('js')

    </body>
</html>
