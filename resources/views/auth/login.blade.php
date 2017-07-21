@extends('layouts.master')

@section('content')

	
<div id="loginNotModal" class="container">
	
	<div class="row">

		<div class="col-md-6 col-md-offset-3">
			
			<h1 class="text-muted">{{ trans('login.heading') }}</h1>

		</div>	

	</div>

	<div class="row">
		
		<div class="col-md-12">

			<form  method="POST" action="/login" class="form-horizontal loginForm">
								
				{{ csrf_field() }}

				<div class="form-group">
														
					<div class="col-md-6 col-md-offset-3">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="fa fa-user" aria-hidden="true"></i>

							</span>
																													
							<input type="text" class="form-control formField input-lg" id="username" name="username" value="{{ $username or old('username') }}"  autofocus placeholder="{{ trans('placeholders.username') }}" >
																		
			            </div>
			       
			            @if ($errors->has('username'))

			                <span class="help-block inputError">

			                    <strong>{{ $errors->first('username') }}</strong>

			                </span>

			            @endif

					</div>

				</div>

				<div class="form-group">

					<div class="col-md-6 col-md-offset-3">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="fa fa-key" aria-hidden="true"></i>

							</span>

							<input type="password" class="form-control formField input-lg" id="password" name="password" placeholder="{{ trans('placeholders.password') }}" >

						</div>

			             @if ($errors->has('password'))

			                <span class="help-block inputError">

			                    <strong>{{ $errors->first('password') }}</strong>

			                </span>

			            @endif
					
					</div>

				</div>
														
				<div class="form-group">

					<div class="col-md-6 col-md-offset-3">

						<a id="forgotPassword" href="/password/forgot">{{ trans('login.forgot') }}</a>

					</div>

				</div>

				<div class="form-group">

			        <div class="col-md-6 col-md-offset-3" style="margin-top: 20px; margin-bottom: 20px;">
				
						<button id="loginFormSubmit" type="submit" class="btn btn-default btn-block formBtn"><i class="fa fa-sign-in"></i>Prijavi&nbsp;se
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