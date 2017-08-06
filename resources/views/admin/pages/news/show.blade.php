@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
  
@stop

@section('content')

    {!! $news->body !!}

    <a class="btn btn-primary" href="{{ '/admin/news/' . $news->slug . '/edit' }}">Izmeni</a>

@stop

@section('css')
  
@stop

@section('js')

@stop