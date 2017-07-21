@extends('layouts.master')

@section('content')

<div id="adminElements" class="container" style="margin-bottom: 10%; margin-top: 10%;">

	@yield('admin-page')

</div>

<script src="{{ url('js/admin.js') }}"></script>

@endsection