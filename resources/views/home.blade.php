@extends('layouts.app') 
@push('title', 'Welcome to dashboard!') 
@section('content')
<div class="container">
    <div class="row">        
        <div class="col-12 col-sm-6 col-md">
            <a href="{{route('page.index')}}">
                <div class="info-box mb-3 shadow">                
                    <span class="info-box-icon bg-danger elevation-1"><i class="far fa-file-alt"></i></span>            
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('global.pages') }} </span>
                        <span class="info-box-number">{{$pages}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-md">
            <a href="{{route('blog.index')}}">    
                <div class="info-box mb-3 shadow">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('global.blogs') }} </span>
                        <span class="info-box-number">{{$blogs}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-md">
            <a href="{{route('media.index')}}">
                <div class="info-box mb-3 shadow">
                    <span class="info-box-icon bg-warning elevation-1"><i class="far fa-image"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('global.media') }} </span>
                        <span class="info-box-number">{{$medias}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-md">
            <a href="{{route('category.index')}}">
                <div class="info-box mb-3 shadow">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('global.categories') }}</span>
                        <span class="info-box-number">{{$categories}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-md">
            <a href="{{route('users.index')}}">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('global.users.title') }}</span>
                        <span class="info-box-number">{{$users}}</span>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="jumbotron">
        <h1>{{ __('global.welcome') }} </h1>
    </div>

</div>
@endsection
