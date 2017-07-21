<div id="responseModal" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

				<h4 class="modal-title"></h4>

			</div>

			<div class="modal-body">

				<div id="messages"></div>

				<form id="responseForm">

					{{ csrf_field() }}

					<input type="hidden" name="to">

					<input type="hidden" name="conversationId">

					<div class="form-group">

						<textarea class="form-control formField"></textarea>

					</div>

					<div id="responseStatus">
						
						<img class="center-block" src="{{ url('images/camera-loader.gif') }}">

						<p class="text-center">Poruka se šalje...</p>

					</div>

					<div class="form-group">

						<button id="responseBtn" class="btn btn-primary form-control formBtn">Odgovori</button>

					</div>

				</form>

			</div>

		</div>

	</div>

</div>