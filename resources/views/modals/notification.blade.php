<!-- Notifications Modal -->
<div id="notificationModal" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

				<h4 class="modal-title">Obaveštenje</h4>

			</div>

			<div class="modal-body"> 

				<p>
					@if(session('status'))

						{{ session('status') }}

					@endif

				</p>

			</div>

		</div>

	</div>

</div>