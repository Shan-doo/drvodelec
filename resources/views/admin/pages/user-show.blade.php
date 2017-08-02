	@extends('adminlte::page')

	@section('title', 'Dashboard')

	@section('content_header')
	<h1>Profil korisnika {{ $user->username }}</h1>
	@stop

	@section('content')
	<p>Profil korisnika {{ $user->username }}</p>

	
	@stop

	@section('css')
	
	@stop

	@section('js')
	<script> 

	</script>
	@stop