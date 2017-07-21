@extends('layouts.master')

@section('content')

	@if(isset($conversation))
		
		@include('modals.response')

		<script type="text/javascript">
			
			$('#clientResponseModal').modal();

			$('#clientResponseModalBtn').click(function() {

				$('#clientResponseModal').modal('hide');

				$('html, body').animate({scrollTop: $('#contact').offset().top - 80}, 500, function() {
					$('#messageForm > textarea').focus();
				});
			})

		</script>

	@endif

	
	@include('client.partials.about')

	@include('client.partials.projects')

	@include('client.partials.news')   

	@include('client.partials.contact')

	@include('client.partials.newsletter')

	@include('modals.notification')		

	@include('modals.login')

	<script src="/js/app.js"></script>
	
	<!-- if javascript is disabled, backend validation -->

	@if($errors->has('username'))
	
		<script>
			
			$('#loginModal').modal();
	
		</script>
	
	@endif

	@if($errors->has('email'))
	
		<script>
			
			$loginModal = $('#loginModal');

			$loginModal.modal();

			$loginModal.find('ul li:first-child').removeClass('active');

			$loginModal.find('ul li:last-child').addClass('active');

			$loginModal.find('.tab-content > #loginAdmin').removeClass('active');

			$loginModal.find('.tab-content > #resetPassword').addClass('active');
	
		</script>
	
	@endif

	<!-- /////////////////// -->
	
	@if(Request::segment(1) === 'password')

		@include('modals.reset')

	@endif


	@if(session('status'))

		<script>
			
			$('#notificationModal').modal();

		</script>

	@endif	

@endsection
