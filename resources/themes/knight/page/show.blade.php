@extends('layouts.frontend')

@section('title') {{ $page->title }} @endsection
@section('titleseo') {{ $page->titleseo }} @endsection
@section('descseo') {{ $page->descseo }} @endsection
@section('keywordseo') {{ $page->keywordseo }} @endsection


@section('content')
<div class="container mt-3">
    <div class="col-md-12">
      {!! $page->content !!}
    </div>
</div>
@endsection
