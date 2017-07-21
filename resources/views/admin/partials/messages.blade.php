<div class="panel panel-default my-panel">

	<div class="panel-heading text-center">

		<p>Ukupno Poruka: {{ $conversationsTotal }}</p>

		<p>Nepročitano: {{ $conversationsUnread }}</p>

	</div>

	<div class="panel-body" style="word-break:break-all;position: relative;overflow: hidden;">

		<div class="table-responsive" style="position: relative;">
		
			<table class="table table-hover">

				<thead>

					<tr>

						<th>Od</th>					
						
						<th>Email</th>

						<th>Primljeno</th>

						<th>Odgovori</th>

						<th>Obriši</th>

					</tr>

				</thead>

				<tbody>

					@foreach($conversations as $conversation)

					<tr>

						<td>{{ $conversation->sender }}</td>

						<td>{{ $conversation->email }}</td>

						<td>{{ $conversation->updated_at->diffForHumans() }}</td>

						<td>
							
							<button class="btn btn-default respondMessage" data-conversation-id="{{ $conversation->id }}">
								
								<i class="{{ $conversation->opened ? 'fa fa-envelope-open' : 'fa fa-envelope'}}" aria-hidden="true"></i>

							</button>

						</td>

						<td>

							<button class="btn btn-default deleteMessage" data-toggle="popover" data-trigger="hover" data-content="Delete a message" data-placement="left" data-conversation-id="{{ $conversation->id }}">

								<i class="fa fa-trash-o" aria-hidden="true"></i>

							</button>

						</td>

					</tr>

					@endforeach

				</tbody>

			</table>

			</div>

			<div id="loaderAjaxConversation" style="visibility: hidden;">
					
				<img class="center-block" src="{{ url('images/camera-loader.gif') }}">

				<p class="text-center">Učitavanje...</p>

			</div>

				{{ $conversations->links('layouts.pagination') }}

		</div>

</div>{{-- panel messages --}}

@include('admin.partials.modal')

@include('admin.partials.response-modal')