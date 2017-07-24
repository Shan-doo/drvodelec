<div id="menuF" class="{{ Request::segment(1) == 'admin' || Request::segment(1) == 'login' || Request::segment(2) == 'forgot' ? 'fixed transbg' : 'default' }}">
	<div class="container">
		<div class="row">
			<div class="logo col-md-4">
				<div>
					<a href="/">
						<img src="/images/logo.png">
					</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="navmenu">

				@if(Request::segment(1) == 'admin')

					<ul id="menu">
						
						<li id="dropdown">
							<a id="account" href="#">{{ auth()->user()->username }}
								&nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
							</a>
							<ul id="dropdownMenu" class="hideDrop">
								<li><a href="/admin/images">{{ trans('navigation.images') }}</a></li>
								<li><a href="/admin/messages">{{ trans('navigation.messages') }}</a></li>
								<li><a href="/admin/subscribers">{{ trans('navigation.subscribers') }}</a></li>
								<li><a href="/admin/news">{{ trans('navigation.news') }}</a></li>
								<li><a href="/logout">Log&nbsp;Out</a></li>
							</ul>
						</li>					
			
					</ul>

				@elseif(Request::segment(1) == 'login' || Request::segment(2) == 'forgot')

					<ul id="menu">
												
						<li><a href="/">Back</a></li>					
			
					</ul>

				@else

					<ul id="menu">
				
						<li class="active" ><a href="#home">{{ trans('navigation.home') }}</a></li>
						<li class=""><a href="#about">{{ trans('navigation.about') }}</a></li>
						<li class=""><a href="#project">{{ trans('navigation.projects') }}</a></li>
						<li class=""><a href="#news">{{ trans('navigation.news') }}</a></li>
						<li class=""><a href="#contact">{{ trans('navigation.contact') }}</a></li>
										
						@if(!auth()->check())

							<li><a id="login"  href="#" data-toggle="modal" data-target="#loginModal">{{ trans('navigation.log') }}</a></li>
							<!-- for small screens -->
							<!-- <li class="hidden-lg hidden-md"><a id="loginSmall"  href="/login">{{ trans('navigation.log') }}</a></li> -->
						
						@else

							<li id="dropdown">
								<a id="account" href="#">{{ auth()->user()->username }}
									&nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
								</a>
								<ul id="dropdownMenu" class="hideDrop">
									<li><a href="/admin">Admin&nbsp;Panel</a></li>
									<li><a href="/logout">Log&nbsp;Out</a></li>
								</ul>
							</li>
					
						@endif										

					</ul>
				
				@endif	
					
				</div>

			</div>

		</div>

	</div>

</div>       