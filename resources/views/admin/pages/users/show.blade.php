@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Profil korisnika {{ $user->username }}</h1>
@stop

@section('content')

<div class="row">
	<div class="col-md-3">

		<!-- Profile Image -->
		<div class="box box-primary">
			<div class="box-body box-profile">

				<div id="profile-image">
					<!-- profile-user-img -->
					<img 
					class="profile-user-img img-responsive img-circle" 
					src="{{ $user->avatar ? asset('storage/avatars/cropped/' . $user->avatar) : asset('storage/avatars/placeholder.png') }}" alt="User profile picture"
					@if(Auth::user()->id === $user->id) 
					data-toggle="modal" 
					data-target="#myModal"
					@endif
					>

				</div>

				<h3 class="profile-username text-center">{{ $user->username }}</h3>

				<p class="text-muted text-center">{{ $user->role->name }}</p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Followers</b> <a class="pull-right">1,322</a>
					</li>
					<li class="list-group-item">
						<b>Following</b> <a class="pull-right">543</a>
					</li>
					<li class="list-group-item">
						<b>Friends</b> <a class="pull-right">13,287</a>
					</li>
				</ul>

				<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

		<!-- About Me Box -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">About Me</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<strong><i class="fa fa-book margin-r-5"></i> Education</strong>

				<p class="text-muted">
					B.S. in Computer Science from the University of Tennessee at Knoxville
				</p>

				<hr>

				<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

				<p class="text-muted">Malibu, California</p>

				<hr>

				<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

				<p>
					<span class="label label-danger">UI Design</span>
					<span class="label label-success">Coding</span>
					<span class="label label-info">Javascript</span>
					<span class="label label-warning">PHP</span>
					<span class="label label-primary">Node.js</span>
				</p>

				<hr>

				<strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
	<div class="col-md-9">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="false">Timeline</a></li>
				@if(Auth::user()->id === $user->id)

				<li class=""><a href="#username_email_edit" data-toggle="tab" aria-expanded="false">Username/Email</a></li>

				<li class=""><a href="#password_change" data-toggle="tab" aria-expanded="false">Password</a></li>

				@endif
			</ul>
			<div class="tab-content">

				<!-- /.tab-pane -->
				<div class="tab-pane active" id="timeline">
					<!-- The timeline -->
					<ul class="timeline">

						<li class="time-label">

							<span class="bg-purple">

								@if(count($feeds))

								{{ $feeds->first()->created_at->format('d-M-Y') }}

								@else

								{{ \Carbon\Carbon::now()->format('d-M-Y') }}

								@endif

							</span>

						</li>

						@if(count($feeds))

						@for($i = 0; $i < count($feeds); $i++)

						@if($feeds[$i]->event->name === 'message_received')

						<li>
							<i class="fa fa-envelope bg-blue"></i>
							<div class="timeline-item">
								<span class="time"><i class="fa fa-clock-o"></i>&nbsp;{{ $feeds[$i]->created_at->diffForHumans() }}</span>

								<h3 class="timeline-header"><a href="#">{{ $feeds[$i]->feedable->conversation->sender }}</a> ...</h3>

								<div class="timeline-body">

									{{ $feeds[$i]->feedable->body }}

								</div>

								<div class="timeline-footer">
									<a class="btn btn-primary btn-xs">Odgovori</a>
								</div>
							</div>
						</li>

						@elseif($feeds[$i]->event->name === 'image_uploaded')

						<li>
							<i class="fa fa-camera bg-purple"></i>

							<div class="timeline-item">
								<span class="time"><i class="fa fa-clock-o"></i>&nbsp;{{ $feeds[$i]->created_at->diffForHumans() }}</span>

								<h3 class="timeline-header"><a href="#">{{ $feeds[$i]->feedable->user->username }}</a> uploaded new photos</h3>

								<div class="timeline-body">	
									<img width="150" height="100" src="{{ asset('storage/images/thumbnails/' . $feeds[$i]->feedable->name) }}" alt="..." class="margin">
								</div>
							</div>
						</li>

						@elseif($feeds[$i]->event->name === 'user_registered')

						<li>
							<li>
								<i class="fa fa-user bg-aqua"></i>

								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i>&nbsp;{{ $feeds[$i]->created_at->diffForHumans() }}</span>

									<h3 class="timeline-header no-border"><a href="#">{{ $feeds[$i]->feedable->username }}</a> just joined your awesome site</h3>
								</div>
							</li>
							<li>

								@elseif($feeds[$i]->event->name === 'comment_received')

								<li>
									<i class="fa fa-comments bg-yellow"></i>

									<div class="timeline-item">
										<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

										<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

										<div class="timeline-body">
											
										</div>
										<div class="timeline-footer">
											<a class="btn btn-warning btn-flat btn-xs">View comment</a>
										</div>
									</div>
								</li>

								@elseif($feeds[$i]->event->name === 'news_published')

								<li>
									<i class="fa fa-newspaper-o bg-aqua"></i>

									<div class="timeline-item">
										<span class="time"><i class="fa fa-clock-o"></i> {{ $feeds[$i]->created_at->diffForHumans() }}</span>

										<h3 class="timeline-header"><a href="{{ '/admin/users/' . $feeds[$i]->user->username }}">{{ $feeds[$i]->user->username }}</a> published <a href="{{ '/admin/news/' . $feeds[$i]->feedable->slug }}">{{ $feeds[$i]->feedable->title }}</a></h3>

										<div class="timeline-body">
											{{ strip_tags(str_limit($feeds[$i]->feedable->body, $limit = 300, $end='...')) }}
										</div>
										<div class="timeline-footer">
											<a class="btn btn-flat btn-xs bg-aqua" href="{{ '/admin/news/' . $feeds[$i]->feedable->slug }}">View Article</a>
										</div>
									</div>
								</li>

								@elseif($feeds[$i]->event->name === 'news_edited')

								<li>
									<i class="fa fa-pencil bg-green"></i>

									<div class="timeline-item">
										<span class="time"><i class="fa fa-clock-o"></i> {{ $feeds[$i]->created_at->diffForHumans() }}</span>

										<h3 class="timeline-header"><a href="{{ '/admin/users/' . $feeds[$i]->user->username }}">{{ $feeds[$i]->user->username }}</a> updated <a href="{{ '/admin/news/' . $feeds[$i]->feedable->slug }}">{{ $feeds[$i]->feedable->title }}</a></h3>

										<div class="timeline-body">
											{{ strip_tags(str_limit($feeds[$i]->feedable->body, $limit = 300, $end='...')) }}
										</div>
										<div class="timeline-footer">
											<a class="btn btn-flat btn-xs bg-green" href="{{ '/admin/news/' . $feeds[$i]->feedable->slug }}">View Article</a>
										</div>
									</div>
								</li>

								@endif

								@if(!empty($feeds[$i + 1]))

									@if($feeds[$i]->created_at->format('d-M-Y') !== $feeds[$i + 1]->created_at->format('d-M-Y'))

									<li class="time-label">

										<span class="bg-green">

											{{ $feeds[$i + 1]->created_at->format('d-M-Y') }}

										</span>

									</li>

									@endif

								@endif

								@endfor

								@endif

								<li>

									<i class="fa fa-clock-o bg-gray"></i>

								</li>

							</ul>
						</div>
						<!-- /.tab-pane -->

						@if(Auth::user()->id === $user->id)

						<div class="tab-pane" id="username_email_edit">
							<!-- @if ($errors->any())
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif -->
							<form method="POST" action="{{ '/admin/users/' . $user->username }}" class="form-horizontal">

								{{ csrf_field() }}
								
								<input type="hidden" name="_method" value="PATCH">

								<div class="form-group">
									<label for="inputName" class="col-sm-2 control-label">Name</label>

									<div class="col-sm-10">
										<input class="form-control" id="inputName" placeholder="Name" type="text" value="{{ $user->username }}" name="username">
										@if($errors->has('username'))
											<br>
											<div class="alert alert-danger">

											{{ $errors->first('username') }}

											</div>

										@endif
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-sm-2 control-label">Email</label>

									<div class="col-sm-10">
										<input class="form-control" id="inputEmail" placeholder="Email" type="email" value="{{ $user->email }}" name="email">
										@if($errors->has('email'))
											<br>
											<div class="alert alert-danger">

											{{ $errors->first('email') }}

											</div>

										@endif
									</div>
								</div>													
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-danger">Submit</button>
									</div>
								</div>
							</form>
						</div>

						<div class="tab-pane" id="password_change">
							
							<!-- @if ($errors->any())
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif -->
							<form method="POST" action="{{ '/admin/users/' . $user->username }}" class="form-horizontal">

								{{ csrf_field() }}
								
								<input type="hidden" name="_method" value="PATCH">

								<div class="form-group">
									<label for="inputEmail" class="col-sm-2 control-label">Old Password</label>

									<div class="col-sm-10">
										<input class="form-control" id="inputEmail" placeholder="Old Password" type="password" name="old_password">
										@if($errors->has('old_password'))
											<br>
											<div class="alert alert-danger">

											{{ $errors->first('old_password') }}

											</div>

										@endif
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-sm-2 control-label">New Password</label>

									<div class="col-sm-10">
										<input class="form-control" id="inputEmail" placeholder="New Password" type="password" name="new_password">
										@if($errors->has('new_password'))
											<br>
											<div class="alert alert-danger">

											{{ $errors->first('new_password') }}

											</div>

										@endif
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-sm-2 control-label">Repeat New Password</label>

									<div class="col-sm-10">
										<input class="form-control" id="inputEmail" placeholder="Repeat New Password" type="password" name="new_password_confirmation">
										@if($errors->has('new_password_confirmation'))
											<br>
											<div class="alert alert-danger">

											{{ $errors->first('new_password_confirmation') }}

											</div>

										@endif
									</div>
								</div>
								<!-- <div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox">
											<label>
												<input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
											</label>
										</div>
									</div>
								</div> -->
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-danger">Submit</button>
									</div>
								</div>
							</form>

						</div>

						@endif

						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
		
		@if(Auth::user()->id === $user->id) 

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modal Header</h4>
					</div>
					<div class="modal-body">

						<div class="croppie-test"></div>

						<div class="row">

							<div class="col-md-3 col-md-offset-1">

								<label class="btn btn-primary">

									<i class="fa fa-camera" aria="true"></i>&nbsp;

									<input type="file" name="image" style="display:none;"> Izaberi Sliku

								</label>&nbsp;&nbsp;<br><br>

							</div>

							<div class="col-md-3 col-md-offset-5">

								<!-- $user->avatar ? 'visible' : 'hidden'  -->
								<button id="cropButton" type="button" class="btn btn-primary {{ $user->avatar ? 'visible' : 'hidden' }}">Crop</button>

							</div>				

						</div>

					</div>
					<div class="modal-footer">

						<button id="closeButton" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		     
            </div>
        </div>

        @endif

    </div>
</div>

@stop

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.0/croppie.min.css" />

<style type="text/css">

	.hidden {
		display: none;
	}

	.visible {
		display: block;
	}

	.profile-user-img:hover {
		cursor: pointer;
	}

	ul.timeline li div {

		box-shadow: none;
	}

	/* ul.timeline li div.timeline-item {
	
		box-shadow: none;
	
	}
	
	ul.timeline li div.timeline-item h3.timeline-header {
	
		border-bottom: none;
	} */

</style>



@stop

@section('js')

@if(Auth::user()->id === $user->id) 

	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.0/croppie.min.js"></script>

	<script src="{{ asset('js/admin/user-profile.js') }}"></script>

@endif

@stop