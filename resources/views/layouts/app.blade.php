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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
        <link href="{{ asset('manager/css/select2.css') }}" rel="stylesheet" />
        <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
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
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="{{ asset('manager/AdminLTE-3.0.5/dist/js/adminlte.js') }}"></script>
        
        <!-- Lazy load -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.plugins.min.js"></script>
        
        <script type="text/javascript" src="{{ asset('manager/js/custom.js')}}"></script>
        <!-- Javascript -->
        @livewireScripts
        
        @stack('js')

        <!-- Javascript -->
    </body>
</html>
