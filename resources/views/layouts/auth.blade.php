<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@stack('title')</title>
        <link rel="stylesheet" href="{{asset('manager/vendor/css/main.css')}}">
    </head>
    <body class="hold-transition login-page">    

        <div id="app">
            @yield('content')
        </div>

        <!-- Javascript -->
        <script type="text/javascript" src="{{asset('manager/vendor/js/main.js')}}"></script>
    </body>
</html>
