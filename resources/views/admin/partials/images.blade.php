<div class="panel panel-default my-panel">

	<div class="panel-heading text-center">

		Ukupno Slika: {{ $imagesTotal }}

	</div>

	<div class="panel-body" style="word-break:break-all;">

		<div class="table-responsive">

			<table class="table table-striped">

				<thead>

					<tr style="font-size: 0.8em;">

						<th class="col-md-3">Ime</th>

						<th class="col-md-3">Opis</th>

						<th class="col-md-2">Kategorije</th>

						<th class="col-md-1">Pregledi</th>

						<th class="col-md-1">Svidjanja</th>

						<th class="col-md-2">Datum Dodavanja</th>

					</tr>

				</thead>

				<tbody>

					@foreach($images as $image)

					<tr>

						<td class="col-md-3"><a href="/storage/images/{{ $image->name }}" rel="prettyPhoto">{{ $image->name }}</a></td>

						<td class="col-md-3">{{ $image->description }}</td>

						<td class="col-md-2">@foreach($image->categories as $category){{ $category->name }}@endforeach</td>

						<td class="col-md-1">{{ $image->views }}</td>

						<td class="col-md-1">{{ $image->likes }}</td>

						<td class="col-md-2">{{ $image->created_at->diffForHumans() }}</td>

						<td>

							<button class="deleteImage btn btn-default" data-image-id="{{ $image->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

						</td>

					</tr>

					@endforeach

				</tbody>

			</table>

			<div id="loaderAjaxImages" style="visibility: hidden;">

				<img class="center-block" src="{{ url('images/camera-loader.gif') }}">

				<p class="text-center">Učitavanje...</p>

			</div>

			{{ $images->links('layouts.pagination') }}

		</div>

	</div>

</div>