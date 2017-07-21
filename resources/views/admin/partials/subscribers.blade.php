<div class="panel panel-default my-panel">

	<div class="panel-heading text-center">

		<p>Ukupno Pretplatnika: <span>{{ $subscribersTotal }}</span></p>

		<p>Aktivnih: <span>{{ $subscribersActive }}</span></p>

		<p>Neaktivnih: <span>{{ $subscribersInactive }}</span></p>

	</div>

	<div class="panel-body" style="word-break:break-all;position: relative;overflow: hidden;">

		<div class="table-responsive" style="position: relative;">
		
			<table class="table table-hover">

				<thead>

					<tr style="font-size: 0.9em;">

						<th class="col-md-10">Email</th>

						<th class="col-md-1">Status</th>

						<th class="col-md-1">Obriši</th>					

					</tr>

				</thead>

				<tbody>

					@foreach($subscribers as $subscriber)

					<tr>
					
						<td class="col-md-10">

							<div style="padding-top: 10px;">

								{{ $subscriber->email }}

							</div>

						</td>
						
						<td class="col-md-1">
							
							@if($subscriber->status == 1)

								<div class="checkbox">

								 	<input type="checkbox" value="{{$subscriber->id}}" checked data-toggle="popover" data-trigger="hover" data-content="Deactivate subscription" data-placement="left">

								</div>
								
							@else

								<div class="checkbox">

								 	<input type="checkbox" value="{{$subscriber->id}}" data-toggle="popover" data-trigger="hover" data-content="Activate subscription" data-placement="left">

								</div>

							@endif

						</td>

						<td class="col-md-1">
						
							<button class="btn btn-default deleteSubscriber" data-subscriber-id="{{ $subscriber->id }}" data-toggle="popover" data-trigger="hover" data-content="Terminate subscription" data-placement="top">
								
								<i class="fa fa-trash-o" aria-hidden="true"></i>

							</button>

						</td>
				
					</tr>

					@endforeach

				</tbody>

			</table>

			</div>

			<div id="loaderAjaxSubscribers" style="visibility: hidden;margin-top: 10px;">
					
				<img class="center-block" src="{{ url('images/camera-loader.gif') }}">

				<p class="text-center">Učitavanje...</p>

			</div>

		{{ $subscribers->appends(['get' => 'subs'])->links('layouts.pagination') }}				

		</div>

</div>{{-- panel messages --}}