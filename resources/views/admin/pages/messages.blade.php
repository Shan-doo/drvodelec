@extends('admin.index')

@section('admin-page')
	
	<div class="container">

		<h1 class="text-muted text-center" style="margin-bottom:10%;">Messages</h1>
		
		<div class="row">
			
			<div class="col-md-12">
				
				<div id="messagesAjax">
		
					@include('admin.partials.messages')

				</div>

			</div>

		</div>

	</div>

	<script src="/js/admin.js"></script>

	<script src="{{ url('js/messages.js') }}"></script>

@endsection