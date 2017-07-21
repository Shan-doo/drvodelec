@extends('layouts.master')

@section('content')


<div id="forgotPassword" class="container">

	<div class="row">
			
		<div class="col-md-6 col-md-offset-3">
			
			<h1 class="text-muted">{{ trans('login.forgot') }}</h1>

		</div>

	</div>

	<div class="row">		

		<div class="col-md-12">

			<form id="resetPasswordForm" method="POST" action="/password/email" class="form-horizontal loginForm">
		
				{{ csrf_field() }}

				<div class="form-group">

					<div class="col-md-6 col-md-offset-3">
					
						<span id="resetEmailSuccess" class="help-block">

	                        <strong></strong>

	                    </span>

	                </div>

				</div>

				<div class="form-group">
					
					<div class="col-md-6 col-md-offset-3">

						<div class="input-group">

							<span class="input-group-addon">

								<i class="fa fa-envelope-o" aria-hidden="true"></i>
								
							</span>

							<input type="text" class="form-control formField input-lg" id="emailReset" name="email" value="{{ old('email') }}" placeholder="{{ trans('placeholders.email') }}" >

						</div>

						@if ($errors->has('email'))

	                        <span class="help-block inputError">

	                            <strong>{{ $errors->first('email') }}</strong>

	                        </span>

	                    @endif

	                    @if (session('status'))

	                        <span class="help-block inputError">

	                            <strong>{{ session('status') }}</strong>

	                        </span>

	                    @endif
	           
	                    <span id="resetEmailError" class="help-block inputError">

	                        <strong></strong>

	                    </span>

					</div>

				</div>

				<div class="form-group">

					<img id="resetSpinner" class="center-block" src="/images/camera-loader.gif">

				</div>
				
				<div class="form-group">

	                <div class="col-md-6 col-md-offset-3">

						<button id="resetFormSubmit" type="submit" class="btn btn-default btn-block formBtn">

							<i class="fa fa-refresh" aria-hidden="true"></i>
						
						Resetuj

						</button>

					</div>

				</div>

			</form>

		</div>

	</div>

</div>

<script type="text/javascript">
	
	// init slicknav
	$('#menu').slicknav({
		label: 'MENU',
		duration: 800,
		easingOpen: "swing",
		easingClose: "easeOutBounce"
	});

</script>

@endsection