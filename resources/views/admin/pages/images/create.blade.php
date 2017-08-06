@extends('adminlte::page')

@section('content')

<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Horizontal Form</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form method="POST" action="/admin/images/create" enctype="multipart/form-data" class="form-horizontal">
		<div class="box-body">

			{{ csrf_field() }}

			<div class="form-group">
				<label class="col-sm-2 control-label">Opis</label>

				<div class="col-sm-10">
					<input class="form-control" placeholder="Opis *" type="text" name="description">
				</div>
			</div>

			<div class="form-group">

              <label class="col-sm-2 control-label">File input</label>

              <div class="col-sm-10">

              	<input name="image" type="file">

              </div>

            </div>

			<!-- select2 -->

			<div class="form-group">
				
				<label class="col-sm-2 control-label">Multiple</label>

				<div class="col-sm-10">

					<select id="selectCategories" class="form-control select2 select2-hidden-accessible" name="categories[]" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
						@foreach($categories as $category)

						<option value="{{ $category->id }}">{{ $category->name }}</option>

						@endforeach

					</select>
				</div>
			</div>
			<!-- end select2 -->

			<div class="form-group">

				<div class="col-sm-10 col-sm-offset-2">
			
					<button type="submit" class="btn btn-info">Dodaj Sliku</button>

				</div>

			</div>

		</div>
		<!-- /.box-body -->
		
	</form>
</div>

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')

<script type="text/javascript">

	$(document).ready(function() {

		$('#selectCategories').select2();
	});

</script>

@stop

@stop