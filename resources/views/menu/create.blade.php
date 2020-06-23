@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="container">
                <ul class="space first-space" id="space0">
                    @foreach ($menu_items as $item)
                        <li class="route">
                            <p class="title" id="{{ $item->id}}">{{ $item->label}}</p>
                            <span><i class="fas fa-arrows-alt"></i></span>
                            <ul class="space" id="{{ $item->parent}}"></ul>
                        </li>
                    @endforeach
                    
                    <li class="route">
                        <h3 class="title" id="title2">B</h3>
                        <span class="ui-icon ui-icon-arrow-4-diag"></span>
                        <ul class="space" id="space2">
                            <li class="route">
                                <h3 class="title" id="title3">C</h3>
                                <span class="ui-icon ui-icon-arrow-4-diag"></span>
                                <ul class="space" id="space3"></ul>
                            </li>
                        </ul>
                    </li>
                    <li class="route">
                        <h3 class="title" id="title4">D</h3>
                        <span class="ui-icon ui-icon-arrow-4-diag"></span>
                        <ul class="space" id="space4"></ul>
                    </li>
                    <li class="route">
                        <h3 class="title">E</h3>
                        <span class="ui-icon ui-icon-arrow-4-diag"></span>
                        <ul class="space"></ul>
                    </li>
                    <li class="route">
                        <h3 class="title">F</h3>
                        <span class="ui-icon ui-icon-arrow-4-diag"></span>
                        <ul class="space"></ul>
                    </li>
                    <li class="route">
                        <h3 class="title">G</h3>
                        <span class="ui-icon ui-icon-arrow-4-diag"></span>
                        <ul class="space"></ul>
                    </li>
                    <li class="route">
                        <h3 class="title">H</h3>
                        <span class="ui-icon ui-icon-arrow-4-diag"></span>
                        <ul class="space"></ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 

@push('css')
    <style>
        .route {
            position: relative;
            list-style-type: none;
            border: 0;
            margin: 0;
            padding: 0;
            top: 0px;
            margin-top: 0px;
            max-height: 100% !important;
            width: 100%;
            background: #bcf;
            border-radius: 2px;
            z-index: -1;
        }

        .route span {
            position: absolute;
            top: 20px;
            left: 20px;
            -ms-transform: scale(2);
            /* IE 9 */
            -webkit-transform: scale(2);
            /* Chrome, Safari, Opera */
            transform: scale(2);
            z-index: 10px;
        }

        .route .title {
            position: absolute;
            border: 0;
            margin: 0;
            padding: 0;
            padding-top: 14px;
            height: 44px;
            width: 400px;
            text-indent: 80px;
            background: #4af;
            border-radius: 2px;
            box-shadow: 0px 0px 0px 2px #29f;
            pointer-events: none;
        }

        .first-title { 
            margin-left: 10px; 
        }

        .space {
            position: relative;
            list-style-type: none;
            border: 0;
            margin: 0;
            padding: 0;
            margin-left: 70px;
            width: 60px;
            top: 68px;
            padding-bottom: 68px;
            height: 100%;
            z-index: 1;
        }

        .first-space { 
            margin-left: 10px; 
        }
    </style>
@endpush

@push('js')
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        calcWidth($("#title0"));
        window.onresize = function (event) {
            console.log("window resized");
            //method to execute one time after a timer
        };
        //recursively calculate the Width all titles
        function calcWidth(obj) {
            console.log("---- calcWidth -----");
            var titles = $(obj).siblings(".space").children(".route").children(".title");
            $(titles).each(function (index, element) {
                var pTitleWidth = parseInt($(obj).css("width"));
                var leftOffset = parseInt($(obj).siblings(".space").css("margin-left"));
                var newWidth = pTitleWidth - leftOffset;
                if ($(obj).attr("id") == "title0") {
                    console.log("called");
                    newWidth = newWidth - 10;
                }
                $(element).css({
                    width: newWidth,
                });
                calcWidth(element);
            });
        }
        $(".space").sortable({
            connectWith: ".space",
            // handle:'.title',
            // placeholder: ....,
            tolerance: "intersect",
            over: function (event, ui) {
                // //Recaculate width of all children
                // var pTitleWidth = parseInt($(this).siblings('.title').css('width').replace('px', ''));
                // if ($(this).siblings('.title').attr('id') == 'title0'){
                // 	var newWidth = (pTitleWidth-20).toString().concat('px');
                // }
                // else {
                // 	var newWidth = (pTitleWidth-70).toString().concat('px');
                // }
                // console.log(pTitleWidth + ', ' + newWidth);
                // $(ui.item).children('.title').css({
                // 	'width': newWidth,
                // });
            },
            receive: function (event, ui) {
                calcWidth($(this).siblings(".title"));
            },
        });
        $(".space").disableSelection();
    });
</script>
@endpush
