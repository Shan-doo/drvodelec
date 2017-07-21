@extends('layouts.master')

@section('content')

<div id="adminElements" class="container" style="margin-bottom: 10%; margin-top: 10%;">

	<hr>

	<div class="row">

		<div class="col-md-9 col-xs-12 admin-item">
			
			<div id="imagesAjax">
				
				@include('admin.partials.images')

			</div>

			<div id="messagesAjax">
				
				@include('admin.partials.messages')

			</div>
			
		</div>

		<div class="col-md-3 col-xs-12 admin-item">
			
			@include('admin.partials.images-add')
			
			<div id="subscribersAjax">

				@include('admin.partials.subscribers')

			</div>

		</div>

	</div>

</div>

<script src="/js/admin.js"></script>

@endsection