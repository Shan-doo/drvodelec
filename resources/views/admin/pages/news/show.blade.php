@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <p>Welcome to news.</p>

    {{ $news->title }}

    {!! $news->body !!}

@stop

@section('css')
  
@stop

@section('js')

@stop