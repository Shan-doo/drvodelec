<div id="clientResponseModal" class="modal fade in" role="dialog" style="display: block;" aria-hidden="false">

	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

				<h4 class="modal-title">{{ $conversation->subject }}</h4>

			</div>

			<div class="modal-body">

				<div id="messages">

					@foreach($conversation->messages as $message)
						
						<p class="{{ $message->owner == 1 ? 'admin' : 'client' }}">{{ $message->body }}</p>
					
					@endforeach
					
				</div>

				<button id="clientResponseModalBtn" class="btn btn-primary form-control formBtn">Odgovori</button>

			</div>

		</div>

	</div>

</div>