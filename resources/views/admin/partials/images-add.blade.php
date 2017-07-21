<div class="panel panel-default my-panel">

	<div class="panel-heading text-center" data-toggle="popover" data-trigger="hover" data-content="Here you can add new images" data-placement="top">

		Dodavanje Slika

	</div>

	<div class="panel-body">

		<div {{-- class="forma" --}}>

			<form method="POST" action="/admin" enctype="multipart/form-data">

				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('description') ? ' error' : '' }}">
																						
					<input type="text" class="form-control" name='description' placeholder='Opis *'/>

					@if($errors->has('description'))

						<p class="inputError">{{ $errors->first('description') }}</p>

					@endif
											
				</div>
				
				<div class="form-group{{ $errors->has('image') ? ' error' : '' }}">
				
					<label class="btn btn-default btn-file formBtn">

						Izaberi Sliku <input type="file" name="image" style="display: none;">

					</label><br>
					
					@if($errors->has('image'))

						<p class="inputError">{{ $errors->first('image') }}</p>

					@endif

				</div>

				<div class="form-group{{ $errors->has('categories') ? ' error' : '' }}">

					<select id="selectCategories" class="form-control" name="categories[]" multiple style="width: 100%;">

						@foreach($categories as $category)

						<option value="{{ $category->id }}" style="color: red;">{{ $category->name }}</option>

						@endforeach

					</select>

					@if($errors->has('categories'))

						<p class="inputError">{{ $errors->first('categories') }}</p>

					@endif

				</div>

				
				<div class="form-group">

					<button type="submit" class="btn btn-default formBtn form-control">Dodaj</button>

				</div>

			</form>

		</div>

	</div>

</div>{{-- panel images add --}}