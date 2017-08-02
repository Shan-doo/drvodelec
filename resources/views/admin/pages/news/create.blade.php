@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- <h1>Dashboard</h1> -->
@stop

@section('content')
<!-- <p>Welcome to news create.</p> -->

<div class="row">

	<div class="col-md-12">

		<div class="box box-info">

			<div class="box-header">
				<h3 class="box-title">CK Editor
					<small>Advanced and full of features</small>
				</h3>
				<!-- tools box -->
				<div class="pull-right box-tools">
					<button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
							<i class="fa fa-times"></i></button>
						</div>
						<!-- /. tools -->
					</div>
					<!-- /.box-header -->

					<div class="box-body pad">

						@if(isset($news))

							<form method="POST" action="{{ '/admin/news/' . $news->id }}">

								{{ csrf_field() }}

								<input type="hidden" name="_method" value="PUT">

								<div class="form-group">

				                  <label>Naslov</label>

				                  <input class="form-control" placeholder="Naslov ..." type="text" name="title" value="{{ $news->title }}">

				                </div>

				                <div class="form-group">

				                	<label>Tekst</label>

				                	<textarea id="summernote" name="body" rows="10" cols="80">
				                		
				                		{{ $news->body }}

				                	</textarea>

				                </div>

								<button type="submit" class="btn btn-default">Izmeni</button>

							</form>

						@else

							<form method="POST" action="/admin/news">

								{{ csrf_field() }}

								<div class="form-group">

				                  <label>Naslov</label>

				                  <input class="form-control" placeholder="Naslov ..." type="text" name="title">

				                </div>

				                <div class="form-group">

				                	<label>Tekst</label>

				                	<textarea id="summernote" name="body" rows="10" cols="80" style="display: none;"></textarea>

				                </div>

								<button type="submit" class="btn btn-default">Objavi</button>

							</form>

						@endif

						</div>
					</div>

				</div>
			</div>

@stop

@section('css')

<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/summernote.css') }}">

@stop

@section('js')

<script src="{{ asset('js/admin/summernote.min.js') }}"></script>

  <script>

  	$(document).ready(function() {

  		$.ajaxSetup({

		headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

  		$summernote = $('#summernote');

  		$('#summernote').summernote({
  			dialogsFade: true,
  			toolbar: [
			    ['style', ['style']],
			    ['fontsize', ['fontsize']],
			    ['font', ['bold', 'italic', 'underline', 'clear']],
			    ['fontname', ['fontname']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['height', ['height']],
			    ['insert', ['link', 'hr', 'picture', 'video']],
			    ['table', ['table']],
			    ['view', ['fullscreen', 'codeview']],
    			['help', ['help']]
			  ],
			  height: 500,
			  focus: false,
  			callbacks: {
  				onImageUpload: function(files) {

  					uploadImage(files[0]);

		  		},
		  		onMediaDelete : function($target, editor, $editable) {

		  			var imageHash = $target[0].src.substring($target[0].src.lastIndexOf('/') + 1);

		  			deleteImage(imageHash);
			    }
			}
		});

		function uploadImage(file) {
			
			var data = new FormData();
            data.append("image", file);

         
			$.ajax({		
			url: '/admin/news/store',
			type: 'POST',
			data: data,
			cache: false,
			processData: false, 
			contentType: false,
			})
			.done(function(url) {

				var imageHash = url.substring(url.lastIndexOf('/') + 1);
			
				$image = $('<img style="margin:10px;" class="img-responsive" src="/storage/news/'+ imageHash + '"></img>');

				$summernote.summernote('insertNode', $image[0]);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				/*console.log("complete");*/
			});

		};

		function deleteImage(imageHash) {

			$.ajax({		
			url: '/admin/news/images/' + imageHash,
			type: 'DELETE',
			cache: false,
			processData: false, 
			contentType: false,
			})
			.done(function(response) {
				console.log(response)
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				/*console.log("complete");*/
			});

		};

  	});

  </script>

@stop