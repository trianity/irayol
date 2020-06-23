@extends('layouts.app') 
@push('title', 'Menu') 
@section('content')

<?php $currentUrl = url()->current(); ?>

<div class="mt-3" id="hwpwrap">
    <div class="js menu-max-depth-0 nav-menus-php auto-fold admin-bar">
        <div id="wpwrap">
            <div id="wpcontent">
                <div id="wpbody">
                    <div id="wpbody-content">
                        <div class="card">
                            <div class="card-header container-fluid">
                                <div class="float-left">
                                    {{$indmenu->name}}
                                </div>
                                <form action="{{route('menu.active')}}" method="POST">
                                    @csrf
                                    <input type="text" hidden name="main_menu" id="main_menu" value="{{ $indmenu->id }}">
                                    <div class="btn-group btn-group-sm float-right" >
                                        <button type="submit" class="btn btn-{{ $indmenu->id == setting('main_menu') ? 'success' : 'secondary' }}">{{ $indmenu->id == setting('main_menu') ? 'Active' : 'Inactive' }}</button>
                                        <a href="{{ route('menu.index') }}" class="btn btn-primary" title="Show All Menus"><i class="fa fa-undo" aria-hidden="true"></i> Show All Menus</a>
                                    </div>
                                </form>                                    
                            </div>
                            <div class="card-body" id="nav-menus-frame">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="menu-settings-column" class="metabox-holder">
                                            <div class="card" id="accordion01">
                                                <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">					
                                                    Custom Link <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                                                </a>					
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion01">
                                                    <div class="card-body">
                                                        <div class="mt-3" id="customlinkdiv">
                                                            <input id="custom-menu-item-url" name="url" type="text" class="form-control form-control-sm" placeholder="url" title="url" />
                                                            <input id="custom-menu-item-name" name="label" type="text" class="form-control form-control-sm mt-3" placeholder="label" title="Label menu" />
                                                            <a href="#" onclick="addcustommenu()" class="btn btn-success btn-sm float-right mt-3 mb-3">Add menu item</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Page-->
                                            <div class="card mt-3" id="accordion02">
                                                <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">					
                                                    Pages <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                                                </a>					
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion02">
                                                    <div class="card-body scroll">
                                                        @foreach ($pages as $page)
                                                            <div class="form-group">
                                                                <div class="input-group mb-3">
                                                                    <input id="page-url-{{$page->id}}" hidden name="page-url" type="text" class="form-control form-control-sm" value="/{{$page->slug}}" />
                                                                    <input id="page-name-{{$page->id}}" readonly name="page-name" type="text" class="form-control form-control-sm" value="{{$page->title}}" />
                                                                    <div class="input-group-append">
                                                                        <a href="#" onclick="addpagemenu(this, {{$page->id}})" class="btn btn-success btn-sm">Add</a>
                                                                    </div>
                                                                </div>
                                                            </div>                                                                                                                                    
                                                        @endforeach 
                                                    </div>
                                                </div>
                                            </div>                                                 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="menu-management-liquid">
                                            <div id="menu-management">
                                                <form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
                                                    <div class="card">                 
                                                        <div class="card-body" id="post-body">
                                                            <div id="post-body-content">
                                                                @if (count($menus) < 1)
                                                                    <div class="alert alert-dismissible alert-info">
                                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                                        <h4 class="alert-heading">Menu Structure</h4>
                                                                        <p class="mb-0">Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.</p>												
                                                                    </div>
                                                                @endif
                                                                
                                                                
                                                                <input type="hidden" name="menu-name" id="menu-name" value="@if(isset($indmenu)){{$indmenu->name}}@endif" />
                                                                <input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
	                                                        
                                                                <ul class="menu ui-sortable list-group mb-3" id="menu-to-edit">
																	@if(isset($menus)) 
																	@foreach($menus as $m)
                                                                    <li id="menu-item-{{$m->id}}" class="list-group-item menu-item-handle menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
                                                                        <dt class="menu-item-handle">
                                                                            <span class="item-title">
                                                                                <span class="menu-item-title"> <span id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span style="color: transparent;">|{{$m->id}}|</span> </span>
                                                                                <span class="is-submenu" style="@if ($m->depth==0) display: none ; @endif;">Subelement</span>
                                                                            </span>
                                                                            <span class="item-controls">
                                                                                <span class="item-type">Link</span>
                                                                                <span class="item-order hide-if-js">
                                                                                    <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> |
                                                                                    <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down">
                                                                                        <abbr title="Move Down">↓</abbr>
                                                                                    </a>
                                                                                </span>
                                                                                <a class="item-edit" id="edit-{{$m->id}}" href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a>
                                                                            </span>
                                                                        </dt>

                                                                        <div class="menu-item-settings container bg-light text-dark mt-3" id="menu-item-settings-{{$m->id}}">
																			<input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />
                                                                              <div class="row">
                                                                                <div class="col">
                                                                                    <label class="col-form-label col-form-label-sm" for="edit-menu-item-title-{{$m->id}}">Label</label>
                                                                                    <input type="text" id="idlabelmenu_{{$m->id}}" class="form-control form-control-sm widefat edit-menu-item-title" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}" />
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label class="col-form-label col-form-label-sm" for="edit-menu-item-classes-{{$m->id}}"> Class CSS (optional)</label>
                                                                                    <input type="text" id="clases_menu_{{$m->id}}" class="form-control form-control-sm widefat code edit-menu-item-classes" name="clases_menu_{{$m->id}}" value="{{$m->class}}" />
                                                                                </div>
                                                                            </div>
                            
                                                                            <label class="col-form-label col-form-label-sm" for="edit-menu-item-url-{{$m->id}}"> Url </label>
                                                                            <input type="text" id="url_menu_{{$m->id}}" class="form-control form-control-sm widefat code edit-menu-item-url" id="url_menu_{{$m->id}}" value="{{$m->link}}" />

																			<span>Move:</span> 
																			<a href="{{ $currentUrl }}" class="menus-move-up" style="display: none;">Move up</a>
                                                                            <a href="{{ $currentUrl }}" class="menus-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a>
                                                                            <a href="{{ $currentUrl }}" class="menus-move-left" style="display: none;"></a>
                                                                            <a href="{{ $currentUrl }}" class="menus-move-right" style="display: none;"></a>
                                                                            <a href="{{ $currentUrl }}" class="menus-move-top" style="display: none;">Top</a>

                                                                            <div class="mt-3 mb-3">
                                                                                <a class="btn btn-danger btn-sm item-delete submitdelete deletion" id="delete-{{$m->id}}" href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">Delete</a>
                                                                                <span class="meta-sep hide-if-no-js"> | </span>
                                                                                <a class="btn btn-secondary btn-sm item-cancel hide-if-no-js" id="cancel-{{$m->id}}" href="{{ $currentUrl }}?edit-menu-item={{$m->id}}&cancel=1424297719#menu-item-settings-{{$m->id}}">Cancel</a>
                                                                                <span class="meta-sep hide-if-no-js"> | </span>
                                                                                <a onclick="getmenus()" class="btn btn-primary btn-sm updatemenu" id="update-{{$m->id}}" href="javascript:void(0)">Update item</a>
                                                                            </div>
                                                                        </div>
                                                                    </li>
																	@endforeach 
																	@endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

@push('css')
	<link href="{{asset('manager/menu/style.css')}}" rel="stylesheet" />
@endpush 

@push('js') 
	@include('menu.scripts')
@endpush
