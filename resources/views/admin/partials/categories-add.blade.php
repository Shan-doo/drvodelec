<div class="panel panel-default my-panel">

	<div class="panel-heading text-center" data-toggle="popover" data-trigger="hover" data-content="Here you can add new categories" data-placement="top">

		Dodavanje Kategorija

	</div>

	<div class="panel-body">

		<div {{-- class="forma" --}}>

			<form method="POST" action="/admin/categories" enctype="multipart/form-data">

				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('category') ? ' error' : '' }}">
																						
					<input type="text" class="form-control" name='category' placeholder='Naziv kategorije *'/>

					@if($errors->has('category'))

						<p class="inputError">{{ $errors->first('category') }}</p>

					@endif
											
				</div>
				
				<div class="form-group">

					<button type="submit" class="btn btn-default formBtn form-control">Dodaj</button>

				</div>

			</form>

		</div>

	</div>

</div>{{-- panel images add --}}