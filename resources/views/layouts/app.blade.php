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
        
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,700" rel="stylesheet">
        @stack('css')
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
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.0.0</div>
		</footer>

        <!-- Javascript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="{{ asset('manager/AdminLTE-3.0.5/dist/js/adminlte.js') }}"></script>

        <!-- Javascript -->
        @stack('js')

        <script type="text/javascript">
            $(document).ready(function() {
                $('.select2').select2();
            });
            /* User clicks the "Insert to post" button */
            $("#InsertPhoto").click(function () {
                $("#MediaModal").modal("hide"); // Close the modal
                var insmedia = $("#InsertPhoto").data("id"); // Save the data-id value of #InsertPhoto button to variable
                /* If variable value is not empty we pass it to tinymce function and it inserts the image to post */
                if (insmedia != "") {
					$('#summernote').summernote('insertImage', insmedia);
                }
            });

            /* When user clicks an image in the modal, we add .selected style class to that image and remove the class from the rest of the images */
            $(".addimage").click(function () {
                if ($(this).hasClass("selected")) {
                    $(this).removeClass("selected");
                } else {
                    $(this).addClass("selected");
                }

                var postimageid = $(this).attr("src"); //Grab the src value of selected image to variable
                $("#InsertPhoto").data("id", postimageid); //Save the value to data-id attribute of #InsertPhoto button
            });

            $("#MediaModal").on("show.bs.modal", function (event) {
                $("img").removeClass("selected");
                $("#InsertPhoto").data("id", ""); // Reset the data-id value of #InsertPhoto button
            });



            /* User clicks the "Insert to Main Image" button  */
            $("#MainPhoto").click(function () {
                $("#MediaModal").modal("hide"); // Close the modal
                var mainPic = $("#MainPhoto").data("id"); // Save the data-id value of #InsertPhoto button to variable
                /* If variable value is not empty we pass it to tinymce function and it inserts the image to post */
                if (mainPic != "") {
				    console.log(mainPic)
                    $('#main_image').val(mainPic); 
                    $("#ImageMainSelect").attr('src', mainPic);
                }
            });

            /* When user clicks an image in the modal, we add .selected style class to that image and remove the class from the rest of the images */
            $(".addMainImage").click(function () {
                if ($(this).hasClass("selected")) {
                    $(this).removeClass("selected");
                } else {
                    $(this).addClass("selected");
                }

                var postimageid = $(this).attr("src"); //Grab the src value of selected image to variable
                $("#MainPhoto").data("id", postimageid); //Save the value to data-id attribute of #MainPhoto button
            });

            $("#MediaModal").on("show.bs.modal", function (event) {
                $("img").removeClass("selected");
                $("#MainPhoto").data("id", ""); // Reset the data-id value of #MainPhoto button
            });
        </script>
        <!-- Tinymce -->

        <!-- Lazy load -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.plugins.min.js"></script>

        <script type="text/javascript">
            $(function () {
                $(".lazy").Lazy({
                    placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7...",
                    afterLoad: function (element) {
                        element.removeClass("loading").addClass("loaded");
                    },
                });
            });
        </script>
        <!-- Lazy load -->
        <!-- Javascript -->
        <script>
            $(document).ready(function () {
                $(".filter-button").click(function () {
                    var value = $(this).attr("data-filter");
                    if (value == "all") {
                        //$('.filter').removeClass('hidden');
                        $(".filter").show("1000");
                    } else {
                        //$('.filter[filter-item="'+value+'"]').removeClass('hidden');
                        //$(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                        $(".filter")
                            .not("." + value)
                            .hide("3000");
                        $(".filter")
                            .filter("." + value)
                            .show("3000");
                    }
                });

                if ($(".filter-button").removeClass("active")) {
                    $(this).removeClass("active");
                }
                $(this).addClass("active");
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                var url = window.location;
                $('ul.nav a[href="' + url + '"]')
                    .parent()
                    .addClass("active");
                $("ul.nav a")
                    .filter(function () {
                        return this.href == url;
                    })
                    .parent()
                    .addClass("active");
            });
        </script>
        <!-- Javascript -->
    </body>
</html>
