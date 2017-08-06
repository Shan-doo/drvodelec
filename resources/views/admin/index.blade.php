@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

	<h1 class="text-center">
		
		@if(\Carbon\Carbon::now()->hour > 03 && \Carbon\Carbon::now()->hour < 12)

			Dobro jutro,

		@elseif(\Carbon\Carbon::now()->hour > 12 && \Carbon\Carbon::now()->hour < 17)

			Dobar dan,

		@else

			Dobro veče,

		@endif

		{{ auth()->user()->username }}

	</h1>

@stop

@section('content')

	<p class="text-center">Poslednji put ste bili prijavljeni {{ auth()->user()->last_login->diffForHumans() }} Evo šta je novo...</p>
	
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

				        <h3 class="timeline-header no-border"><a href="{{ 'admin/users/' . $feeds[$i]->feedable->username }}">{{ $feeds[$i]->feedable->username }}</a> just joined your awesome site</h3>
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
							Take me to your leader!
							Switzerland is small and neutral!
							We are more like Germany, ambitious and misunderstood!
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

@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')

<script type="text/javascript">
	
	
</script>

@stop