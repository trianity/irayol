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
        <link rel="stylesheet" href="{{asset('manager/vendor/css/main.css')}}">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,700" rel="stylesheet">
        @stack('css')
        @livewireStyles
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper" id="app">
            @include('layouts.partials.navbar')

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        @include('layouts.partials.alert')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
		<footer class="main-footer">
			<strong>Copyright &copy; <?php echo date("Y"); ?> <a href="http://irayol.com">IRAYOL</a>.</strong>
			{{__('All rights reserved.')}}
			<div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.0.0</div>
		</footer>

        <!-- Javascript -->
        <script type="text/javascript" src="{{asset('manager/vendor/js/main.js')}}"></script>
        <!-- Javascript -->
        @livewireScripts

        @stack('js')

        <!-- Javascript -->
    </body>
</html>
