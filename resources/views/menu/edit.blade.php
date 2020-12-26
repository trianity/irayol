@extends('layouts.app')
@push('title', 'Menu')

@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(Session::has($key))
            <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get($key) }}
            </div>
        @endif
    @endforeach
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="add-new-page bg-white p-20 m-b-20">
                        <div class="accrodion-regular">
                            <div id="accordion3">
                                <div class="card mb-2">
                                    <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        {{__('global.custom_link')}} <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                                    </a>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion3">
                                        <div class="card-body">
                                            <form action="{{route('save-menu-item')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <!-- Main Content section start -->
                                                        <div class="col-12 col-lg-12">
                                                            <div class="add-new-page  bg-white p-20 m-b-20">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="label" class="col-form-label">{{ __('global.title') }}*</label>
                                                                            <input id="label" name="label" value="{{ old('label') }}" type="text" class="form-control" required>
                                                                            <small id="emailHelp" class="form-text text-muted">{{__('global.required')}}</small>
                                                                            <input name="source" type="hidden" value="custom" class="form-control" required>
                                                                            <input type="hidden" name="menu_id" value="{{ $menuId }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="url" class="col-form-label">{{ __('global.url') }}</label>
                                                                            <input id="url" name="url" value="{{ old('url') }}" type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 m-t-20">
                                                                        <div class="form-group form-float form-group-sm">
                                                                            <button type="submit" name="btn" class="btn btn-primary btn-sm btn-block">
                                                                                <i class="fa fa-plus-circle"></i> {{ __('global.add') }}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Main Content section end -->
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        {{__('global.pages')}} <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                                    </a>
                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion3">
                                        <div class="card-body scroll">
                                            @if($pages->count() > 0)
                                                @foreach ($pages as $page)
                                                    <form action="{{route('save-menu-item')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input name="source" type="hidden" value="page" class="form-control" required>
                                                        <input type="hidden" name="menu_id" value="{{ $menuId }}">

                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <input hidden name="page_url" type="text" value="/{{$page->slug}}" />
                                                                <input hidden name="page_id" type="text" value="{{$page->id}}" />
                                                                <input readonly type="text" class="form-control form-control-sm" value="{{$page->title}}" />
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                @endforeach
                                            @else
                                                {{ __('no_page_available') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                        {{__('global.blogs')}} <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                                    </a>
                                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion3">
                                        <div class="card-body scroll">
                                            @if($posts->count() > 0)
                                                @foreach ($posts as $post)
                                                    <form action="{{route('save-menu-item')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input  name="source" value="post" type="hidden" class="form-control" required>
                                                        <input type="hidden" name="menu_id" value="{{ $menuId }}">

                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <input hidden name="post_url" type="text" value="/{{$post->slug}}" />
                                                                <input hidden name="post_id" type="text" value="{{$post->id}}" />
                                                                <input readonly type="text" class="form-control form-control-sm" value="{{ Str::limit($post->title, 40) }}" />
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endforeach
                                            @else
                                                {{ __('no_page_available') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-2">
                                    <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                        {{__('global.categories')}} <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                                    </a>
                                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion3">
                                        <div class="card-body scroll">
                                            @if($categories->count() > 0)
                                                @foreach ($categories as $category)
                                                    <form action="{{route('save-menu-item')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input  name="source" type="hidden" value="category" class="form-control" required>
                                                        <input type="hidden" name="menu_id" value="{{ $menuId }}">

                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <input hidden name="category_url" type="text" value="/{{$category->slug}}" />
                                                                <input hidden name="category_id" type="text" value="{{$category->id}}" />
                                                                <input readonly type="text" class="form-control form-control-sm" value="{{ Str::limit($category->name, 40) }}" />
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endforeach
                                            @else
                                                {{ __('no_category_available') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    @if (count($menuItems) > 0)
                        <form action="{{route('update-menu-item')}}" method="post" enctype="multipart/form-data" id="update-menu-item">
                            @csrf
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cf nestable-lists">
                                            <div class="dd" id="nestable3">
                                                <ol class="dd-list">
                                                    @foreach ($menuItems as $item)
                                                        @if(count($item->children)==0)
                                                            <li class="dd-item dd3-item" id="{{ $item->id }}" data-id="{{ $item->id }}">
                                                                {{-- define category --}}
                                                                <input type="hidden" name="source"  value="{{@$item->source}}">
                                                                <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="1">
                                                                <div class="dd-handle dd3-handle"></div>

                                                                <div class="dd3-content">
                                                                    <div class="float-left">
                                                                        {{ $item->label }}
                                                                    </div>
                                                                    <!-- expand menu item start -->
                                                                    <div class="float-right">
                                                                        <a data-toggle="collapse" href="#main_menu_{{ $item->id }}" role="button" aria-expanded="false" aria-controls="main_menu_{{ $item->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                        <a class="ml-3" href="javascript:void(0)" onclick="delete_menu_item('{{ $item->id }}')"> <i class="fas fa-trash"></i></a>
                                                                    </div>
                                                                </div>

                                                                <div class="collapse" id="main_menu_{{ $item->id }}">
                                                                    <div class="card text-white bg-secondary card-body">
                                                                        <div class="form-group">
                                                                            <label for="label-{{ $item->id }}" class="col-form-label">{{ __('global.title') }}</label>
                                                                            <input id="label-{{ $item->id }}" name="label[]" value="{{ $item->label }}" type="text" class="form-control" required>
                                                                            <input name="menu_item_id[]" value="{{ $item->id }}" type="hidden" class="form-control">
                                                                        </div>
                                                                        @if($item->source == 'custom')
                                                                        <div class="form-group">
                                                                            <label for="order" class="col-form-label">{{ __('global.url') }}</label>
                                                                            <input id="order" name="url[]" value="{{ $item->url }}" type="text" class="form-control">
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <label for="target" class="control-label">{{ __('global.link_behavior') }}</label>
                                                                            <select class="form-control select2bs4" id="target" name="target[]" >
                                                                                <option value="_self" {{ old('target', optional($item)->target ? : '') == '' ? 'selected' : '' }} selected>{{__('global.open_in_same_tab')}}</option>
                                                                                @foreach (['_blank' => __('global.open_in_new_tab') ] as $key => $text)
                                                                                    <option value="{{ $key }}" {{ old('target', optional($item)->target) == $key ? 'selected' : '' }}>
                                                                                        {{ $text }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @else
                                                            <li class="dd-item dd3-item" id="{{ $item->id }}" data-id="{{ $item->id }}">
                                                                {{-- define category --}}
                                                                <input type="hidden" name="source"  value="{{@$item->source}}">
                                                                <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="1">
                                                                <div class="dd-handle dd3-handle"></div>

                                                                <div class="dd3-content">
                                                                    <div class="float-left">
                                                                        {{ $item->label }}
                                                                    </div>
                                                                    <!-- expand menu item start -->
                                                                    <div class="float-right">
                                                                        <a data-toggle="collapse" href="#main_menu_{{ $item->id }}" role="button" aria-expanded="false" aria-controls="main_menu_{{ $item->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                        <a class="ml-3" href="javascript:void(0)" onclick="delete_menu_item('{{ $item->id }}')"> <i class="fas fa-trash"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="collapse" id="main_menu_{{ $item->id }}">
                                                                    <div class="card text-white bg-secondary card-body">
                                                                        <div class="form-group">
                                                                            <label for="label-{{ $item->id }}" class="col-form-label">{{ __('global.title') }}</label>
                                                                            <input id="label-{{ $item->id }}" name="label[]" value="{{ $item->label }}" type="text" class="form-control" required>
                                                                            <input name="menu_item_id[]" value="{{ $item->id }}" type="hidden" class="form-control">
                                                                        </div>
                                                                        @if($item->source == 'custom')
                                                                        <div class="form-group">
                                                                            <label for="order" class="col-form-label">{{ __('global.url') }}</label>
                                                                            <input id="order" name="url[]" value="{{ $item->url }}" type="text" class="form-control">
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">

                                                                            <label for="target" class="control-label">{{ __('global.link_behavior') }}</label>
                                                                            <select class="form-control select2bs4" id="target" name="target[]" >
                                                                                <option value="_self" {{ old('target', optional($item)->target ? : '') == '' ? 'selected' : '' }} selected>{{__('global.open_in_same_tab')}}</option>
                                                                                @foreach (['_blank' => __('global.open_in_new_tab') ] as $key => $text)
                                                                                    <option value="{{ $key }}" {{ old('target', optional($item)->target) == $key ? 'selected' : '' }}>
                                                                                        {{ $text }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ol class="dd-list">
                                                                    @foreach ($item->children as $child)
                                                                        @if(count($child->children)==0)
                                                                            <li class="dd-item dd3-item" id="{{ $child->id }}" data-id="{{ $child->id }}">
                                                                                {{-- define category --}}
                                                                                <input type="hidden" name="source"  value="{{@$item->source}}">
                                                                                <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="2">
                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                <div class="dd3-content">
                                                                                    <div class="float-left">
                                                                                        {{ $child->label }}
                                                                                    </div>
                                                                                    <!-- expand menu item start -->
                                                                                    <div class="float-right">
                                                                                        <a data-toggle="collapse" href="#child_menu_{{ $child->id }}" role="button" aria-expanded="false" aria-controls="child_menu_{{ $child->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                                        <a class="ml-3" href="javascript:void(0)" onclick="delete_menu_item('{{ $child->id }}')"> <i class="fas fa-trash"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="collapse" id="child_menu_{{ $child->id }}">
                                                                                    <div class="card text-white bg-secondary card-body">
                                                                                        <div class="form-group">
                                                                                            <label for="label-{{ $child->id }}" class="col-form-label">{{ __('global.title') }}</label>
                                                                                            <input id="label-{{ $child->id }}" name="label[]" value="{{ $child->label }}" type="text" class="form-control" required>
                                                                                            <input name="menu_item_id[]" value="{{ $child->id }}" type="hidden" class="form-control">
                                                                                        </div>
                                                                                        @if($child->source == 'custom')
                                                                                        <div class="form-group">
                                                                                            <label for="order" class="col-form-label">{{ __('global.url') }}</label>
                                                                                            <input id="order" name="url[]" value="{{ $child->url }}" type="text" class="form-control">
                                                                                        </div>
                                                                                        @endif
                                                                                        <div class="form-group">
                                                                                            <label for="target" class="control-label">{{ __('global.link_behavior') }}</label>
                                                                                            <select class="form-control select2bs4" id="target" name="target[]" >
                                                                                                <option value="_self" {{ old('target', optional($child)->target ? : '') == '' ? 'selected' : '' }} selected>{{__('global.open_in_same_tab')}}</option>
                                                                                                @foreach (['_blank' => __('global.open_in_new_tab') ] as $key => $text)
                                                                                                    <option value="{{ $key }}" {{ old('target', optional($child)->target) == $key ? 'selected' : '' }}>
                                                                                                        {{ $text }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @else
                                                                            <li class="dd-item dd3-item" id="{{ $child->id }}" data-id="{{ $child->id }}">
                                                                                {{-- define category --}}
                                                                                <input type="hidden" name="source"  value="{{@$item->source}}">
                                                                                <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="2">
                                                                                <div class="dd-handle dd3-handle"></div>

                                                                                <div class="dd3-content">
                                                                                    <div class="float-left">
                                                                                        {{ $child->label }}
                                                                                    </div>
                                                                                    <!-- expand menu item start -->
                                                                                    <div class="float-right">
                                                                                        <a data-toggle="collapse" href="#child_menu_{{ $child->id }}" role="button" aria-expanded="false" aria-controls="child_menu_{{ $child->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                                        <a class="ml-3" href="javascript:void(0)" onclick="delete_menu_item('{{ $child->id }}')"> <i class="fas fa-trash"></i></a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="collapse" id="child_menu_{{ $child->id }}">
                                                                                    <div class="card text-white bg-secondary card-body">
                                                                                        <div class="form-group">
                                                                                            <label for="label-{{ $child->id }}" class="col-form-label">{{ __('global.title') }}</label>
                                                                                            <input id="label-{{ $child->id }}" name="label[]" value="{{ $child->label }}" type="text" class="form-control" required>
                                                                                            <input name="menu_item_id[]" value="{{ $child->id }}" type="hidden" class="form-control">
                                                                                        </div>
                                                                                        @if($child->source == 'custom')
                                                                                        <div class="form-group">
                                                                                            <label for="order" class="col-form-label">{{ __('global.url') }}</label>
                                                                                            <input id="order" name="url[]" value="{{ $child->url }}" type="text" class="form-control">
                                                                                        </div>
                                                                                        @endif
                                                                                        <div class="form-group">
                                                                                            <label for="target" class="control-label">{{ __('global.link_behavior') }}</label>
                                                                                            <select class="form-control select2bs4" id="target" name="target[]" >
                                                                                                <option value="_self" {{ old('target', optional($child)->target ? : '') == '' ? 'selected' : '' }} selected>{{__('global.open_in_same_tab')}}</option>
                                                                                                @foreach (['_blank' => __('global.open_in_new_tab') ] as $key => $text)
                                                                                                    <option value="{{ $key }}" {{ old('target', optional($child)->target) == $key ? 'selected' : '' }}>
                                                                                                        {{ $text }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <ol class="dd-list">
                                                                                    @foreach ($child->children as $subChild)
                                                                                        <li class="dd-item dd3-item" id="{{ $subChild->id }}" data-id="{{ $subChild->id }}">
                                                                                            {{-- define category --}}
                                                                                            <input type="hidden" name="source"  value="{{@$item->source}}">
                                                                                            <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="3">
                                                                                            <div class="dd-handle dd3-handle"></div>

                                                                                            <div class="dd3-content">
                                                                                                <div class="float-left">
                                                                                                    {{ $subChild->label }}
                                                                                                </div>
                                                                                                <!-- expand menu item start -->
                                                                                                <div class="float-right">
                                                                                                    <a data-toggle="collapse" href="#subChild_menu_{{ $subChild->id }}" role="button" aria-expanded="false" aria-controls="subChild_menu_{{ $subChild->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                                                    <a class="ml-3" href="javascript:void(0)" onclick="delete_menu_item('{{ $subChild->id }}')"> <i class="fas fa-trash"></i></a>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="collapse" id="subChild_menu_{{ $subChild->id }}">
                                                                                                <div class="card text-white bg-secondary card-body">
                                                                                                    <div class="form-group">
                                                                                                        <label for="label-{{ $subChild->id }}" class="col-form-label">{{ __('global.title') }}</label>
                                                                                                        <input id="label-{{ $subChild->id }}" name="label[]" value="{{ $subChild->label }}" type="text" class="form-control" required>
                                                                                                        <input name="menu_item_id[]" value="{{ $subChild->id }}" type="hidden" class="form-control">
                                                                                                    </div>
                                                                                                    @if($subChild->source == 'custom')
                                                                                                    <div class="form-group">
                                                                                                        <label for="order" class="col-form-label">{{ __('global.url') }}</label>
                                                                                                        <input id="order" name="url[]" value="{{ $subChild->url }}" type="text" class="form-control">
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    <div class="form-group">
                                                                                                        <label for="target" class="control-label">{{ __('global.link_behavior') }}</label>
                                                                                                        <select class="form-control select2bs4" id="target" name="target[]" >
                                                                                                            <option value="_self" {{ old('target', optional($subChild)->target ? : '') == '' ? 'selected' : '' }} selected>{{__('global.open_in_same_tab')}}</option>
                                                                                                            @foreach (['_blank' => __('global.open_in_new_tab') ] as $key => $text)
                                                                                                                <option value="{{ $key }}" {{ old('target', optional($subChild)->target) == $key ? 'selected' : '' }}>
                                                                                                                    {{ $text }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ol>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ol>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="float-right">
                                            <button class="btn btn-primary" type="submit">{{ __('global.update') }}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning" role="alert">Empty menu!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('manager/menu/nestable/nestable.css')}}">
@endpush

@push('js')
    <script src="{{asset('manager/menu/nestable/jquery.nestable.js') }}"></script>
    <script src="{{asset('manager/menu/nestable/custom.js') }}"></script>
    <script src="{{asset('manager/js/sweetalert.min.js')}}"></script>

    <script type="text/javascript">
        function delete_menu_item(row_id) {
            let table_row = '#' + row_id
            let token =  "{{ csrf_token() }}";
            url = "{{ route('delete-menu-item') }}"

            swal({
                title: "{{ __('global.are_you_sure?') }}",
                text: "{{ __('global.it_will_be_deleted_permanently') }}",
                icon: "warning",
                buttons: true,
                buttons: ["{{ __('global.cancel') }}", "{{ __('global.delete') }}"],
                dangerMode: true,
                closeOnClickOutside: false
            })
            .then(function(confirmed){
                if (confirmed){
                    $.ajax({
                        url: url,
                        type: 'delete',
                        data: 'row_id=' + row_id + '&_token='+token,
                        dataType: 'json'
                    })
                    .done(function(response){
                        swal.stopLoading();
                        if(response.status == "success"){
                            swal("{{ __('global.deleted') }}", response.message, response.status);
                            $(table_row).fadeOut(2000);
                        } else {
                            swal("Error!", response.message, response.status);
                        }
                    })
                    .fail(function(){
                        swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                    })
                }
            })
        }
    </script>
@endpush
