<div id="news">
	<div class="line4">		
		<div class="container">
			<div class="row Ama">
				<div class="col-md-12">
				<h3>What&rsquo;s New?</h3>
				<p>Get the latest news from our blog</p>
				</div>
			</div>
		</div>
	</div>

	@foreach($news->chunk(2) as $chunk)

		<div class="container">

			<div class="row news">

			@foreach($chunk as $news)
				
				<div class="col-md-6 {{ $loop->iteration % 2 == 1 ? 'text-left' : 'text-right' }}">
				<img class="img-responsive picsGall" src="images/picNews/news1.jpg"/>
				<h3><a href="#">{{ $news->title }}</a></h3>
				<ul>
					<li><i class="fa fa-calendar"></i>{{ $news->created_at->diffForHumans() }}</li>
					<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
				</ul>
				<p>{{ strip_tags(str_limit($news->body, $limit = 300, $end = '...')) }} <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
				</div>
			
			@endforeach

			</div>

		</div>

	@endforeach

	<hr class="hrNews">

		<div class="container">
		<div class="row cBtn">
			<div class="col-md-12" style="text-align: center; margin-bottom: -90px; z-index: 10;">
				<ul class="mNews">
					<li class="dowbload bhide2"><a href="#"><i class="fa fa-arrow-down"></i>Load More news</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>