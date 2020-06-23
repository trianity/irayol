@extends('layouts.frontend')

@section('title', $page->title )
@section('titleseo', $page->titleseo )
@section('descseo', $page->descseo )
@section('keywordseo', $page->keywordseo )

@section('content')
  {!! $page->content !!}
@endsection
