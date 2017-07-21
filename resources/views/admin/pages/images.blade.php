@extends('admin.index')

@section('admin-page')
	
	<div class="container">

		<h1 class="text-muted text-center" style="margin-bottom:10%;">Images</h1>
		
		<div class="row">
			
			<div class="col-md-9">
				
				<div id="imagesAjax">
		
					@include('admin.partials.images')

				</div>

			</div>

			<div class="col-md-3">
				
				<div id="images-add">
		
					@include('admin.partials.images-add')

				</div>

				<div id="images-add">
		
					@include('admin.partials.categories-add')

				</div>

			</div>

		</div>

	</div>

	<script type="text/javascript" src="{{ url('js/images.js') }}"></script>

@endsection