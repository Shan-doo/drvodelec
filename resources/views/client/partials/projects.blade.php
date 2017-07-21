<div class="section">  

	<div class="line3">

		<div class="container">

			<div class="row Fresh">
				<div class="col-md-4 Des">
					<i class="fa fa-heart"></i>
					<h4>Čist & originalan dizajn</h4>
					<p>Nulla consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor. feugiat </p>
				</div>

				<div class="col-md-4 Ver">
					<i class="fa fa-cog"></i>
					<h4>Fleksibilnost</h4>
					<p>Nulla consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor. feugiat </p>
				</div>

				<div class="col-md-4 Fully">
					<i class="fa fa-tablet"></i>
					<h4>Odgovornost</h4>
					<p>Nulla consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor. feugiat </p>
				</div>		

			</div>
			
		</div>
	</div>          


	<div id="project" class="container">
		
		<div class="row">
			
			<div class="categories col-md-12" style="text-align: center;">

				<ul id="filter">

					@foreach($categories as $category)

					<li>

						<a href="#" data-value="{{ $category->name }}">{{ $category->name }}</a>

					</li>

					@endforeach

				</ul>

			</div>

		</div><br>
		
		<div class="row">

			<div class="portfolio_block columns3 pretty images" data-animated="fadeIn">

				@php 

				$i = 1

				@endphp

				@foreach($images as $image)

					<div id="projectImage{{ $i }}" class="col-md-4 col-sm-4 gall branding" data-image-name={{ $image->name }} data-character="@foreach($image->categories as $category){{ $category->name . ' ' }}@endforeach">
						<a class="plS" href="/storage/images/{{ $image->name }}" rel="prettyPhoto[gallery2]">
							<div class="aspect aspect--16x9">
								<div class="aspect__inner">
									<img class="img-responsive picsGall" src="/storage/images/thumbnails/{{ $image->name }}" alt="{{ $image->description }}" width="356" height="276" style="display: block;" />
								</div>
							</div>
							
						</a>
						<div class="view project_descr ">
							<h3>{{ $image->description }}</h3>
							<ul>
								<li><i class="fa fa-eye"></i>{{$image->views }}</li>
								<li><a class="heart" href="javascript:void(0);"><i class="fa-heart-o"></i><span>{{ $image->likes }}</span></a></li>
							</ul>
						</div>
					</div>

					@php

					$i++

					@endphp

				@endforeach

			</div>

			<div id="loaderAjaxProjects" style="display: none;">
					
				<img class="center-block" src="/images/camera-loader.gif">

				<p class="text-center">Učitavanje...</p>

			</div>

			<div class="col-md-12 cBtn  lb" style="text-align: center;">
				<ul class="load_more_cont ">
					<li id="load_more_imgs" class="dowbload btn_load_more">
						<a href="javascript:void(0);" >
							<i class="fa fa-arrow-down"></i>{{ trans('projects.button') }}
						</a>
					</li>
				</ul>
			</div>
			
		</div>
		
	</div>

</div>