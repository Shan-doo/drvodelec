@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<p>Welcome to this beautiful admin panel.</p>

<ul class="timeline">
	
@foreach($messages as $message)

	<li>
		
		<i class="fa fa-envelope bg-blue"></i>
		<div class="timeline-item">
			<span class="time"><i class="fa fa-clock-o"></i>{{ $message->created_at }}</span>

			<h3 class="timeline-header"><a href="#">{{ $message->conversation->sender }}</a> ...</h3>

			<div class="timeline-body">
				{{ $message->body }}
			</div>

			<div class="timeline-footer">
				<a class="btn btn-primary btn-xs">...</a>
			</div>
		</div>
	</li>	

@endforeach

@foreach($users as $user)

	<li>
		<li>
	      <i class="fa fa-user bg-aqua"></i>

	      <div class="timeline-item">
	        <span class="time"><i class="fa fa-clock-o"></i>{{ $user->created_at }}</span>

	        <h3 class="timeline-header no-border"><a href="#">{{ $user->username }}</a></h3>
	      </div>
	    </li>
	<li>

@endforeach

</ul>

<ul class="timeline">

	timeline date
	<li class="time-label">
		<span class="bg-red">
			10 Feb. 2014
		</span>
	</li>
	end timeline-date

	timeline item
	<li>
		timeline icon
		<i class="fa fa-envelope bg-blue"></i>
		<div class="timeline-item">
			<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

			<h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

			<div class="timeline-body">
				...
				Content goes here
			</div>

			<div class="timeline-footer">
				<a class="btn btn-primary btn-xs">...</a>
			</div>
		</div>
	</li>
	END timeline item

	timeline item
	<li>
		timeline icon
		<li>
	      <i class="fa fa-user bg-aqua"></i>

	      <div class="timeline-item">
	        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

	        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
	      </div>
	    </li>
	END timeline item

	timeline item
	<li>
		<i class="fa fa-comments bg-yellow"></i>

		<div class="timeline-item">
			<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

			<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

			<div class="timeline-body">
				Take me to your leader!
				Switzerland is small and neutral!
				We are more like Germany, ambitious and misunderstood!
			</div>
			<div class="timeline-footer">
				<a class="btn btn-warning btn-flat btn-xs">View comment</a>
			</div>
		</div>
	</li>
	END timeline item

	timeline date

	<li class="time-label">
		<span class="bg-green">
			3 Jan. 2014
		</span>
	</li>

	END timeline date

	<li>
		<i class="fa fa-camera bg-purple"></i>

		<div class="timeline-item">
			<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

			<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

			<div class="timeline-body">
				<img src="http://placehold.it/150x100" alt="..." class="margin">
				<img src="http://placehold.it/150x100" alt="..." class="margin">
				<img src="http://placehold.it/150x100" alt="..." class="margin">
				<img src="http://placehold.it/150x100" alt="..." class="margin">
			</div>
		</div>
	</li>
	
	timeline end

	<li>
      <i class="fa fa-clock-o bg-gray"></i>
    </li>

	...

</ul>
@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<!-- <script> console.log('Hi!'); </script> -->
@stop