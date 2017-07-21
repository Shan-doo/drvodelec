<!-- login/password reset modal -->

<div id="loginModal" class="modal fade" role="dialog">
	
	<div class="modal-dialog">

		<div class="modal-content">
			
			<div class="modal-header">
		
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
		
				<h4 class="modal-title">{{ trans('login.heading') }}</h4>
		
			</div>
			
				<ul class="nav nav-tabs">
		
				  <li class="active"><a data-toggle="tab" href="#loginAdmin">{{ trans('login.login') }}</a></li>
		
				  <li><a data-toggle="tab" href="#resetPassword">{{ trans('login.forgot') }}</a></li>
		
				</ul>
						
				<div class="tab-content">

					<!-- login -->
					<div id="loginAdmin" class="tab-pane active">
						
						<div class="modal-body">
												
							<form id="loginForm" method="POST" action="/login" class="form-horizontal loginForm">
					
								{{ csrf_field() }}
					
								<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
																		
									<div class="col-md-6 col-md-offset-3">

										<div class="input-group">

											<span class="input-group-addon">
												
												<i class="fa fa-user" aria-hidden="true"></i>

											</span>
																																	
											<input type="text" class="form-control formField input-lg" id="username" name="username" value="{{ $username or old('username') }}"  autofocus placeholder="{{ trans('placeholders.username') }}" >
																						
			                            </div>

			                            <span id="usernameError" class="help-block inputError">

			                            	<strong></strong>

			                            </span>

			                            @if ($errors->has('username'))

			                                <span class="help-block">

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

										<span id="passwordError" class="help-block inputError">
											
			                            	<strong></strong>

			                            </span>

			                             @if ($errors->has('password'))

			                                <span class="help-block">

			                                    <strong>{{ $errors->first('password') }}</strong>

			                                </span>

			                            @endif
									
									</div>

								</div>
															
								<img id="loginSpinner" class="center-block" src="/images/camera-loader.gif">

								<div class="form-group">

			                        <div class="col-md-6 col-md-offset-3" style="margin-top: 20px; margin-bottom: 20px;">
								
										<button id="loginFormSubmit" type="submit" class="btn btn-default btn-block formBtn"><i class="fa fa-sign-in"></i>Prijavi&nbsp;se
										</button>

									</div>

								</div>
					
							</form> 
														
						</div>
					
					</div>
					
					<!-- reset -->
					<div id="resetPassword" class="tab-pane">
						
						<div class="modal-body">
		
							<form id="resetPasswordForm" method="POST" action="/password/email" class="form-horizontal loginForm">
		
								{{ csrf_field() }}

								<div class="form-group">

									<div class="col-md-6 col-md-offset-3">
									
										<span id="resetEmailSuccess" class="help-block">

			                                <strong></strong>

			                            </span>

		                            </div>

								</div>
		
								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									
									<div class="col-md-6 col-md-offset-3">

										<div class="input-group">

											<span class="input-group-addon">

												<i class="fa fa-envelope-o" aria-hidden="true"></i>
												
											</span>

											<input type="text" class="form-control formField input-lg" id="emailReset" name="email" value="{{ old('email') }}" placeholder="{{ trans('placeholders.email') }}" >

										</div>

										@if ($errors->has('email'))

			                                <span class="help-block">

			                                    <strong>{{ $errors->first('email') }}</strong>

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
			
		</div>
	
	</div>

</div>

