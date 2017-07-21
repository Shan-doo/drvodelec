@extends('admin.index')

@section('admin-page')
	
	<div class="container">

		<h1 class="text-muted text-center" style="margin-bottom:10%;">Subscribers</h1>
		
		<div class="row">
			
			<div class="col-md-12">
				
				<div id="subscribersAjax">
		
					@include('admin.partials.subscribers')

				</div>

			</div>

		</div>

	</div>

	
	
	<script src="{{ url('js/subscribers.js') }}"></script>

@endsection