@extends('adminlte::master')

@section('adminlte_css')
<link rel="stylesheet"
href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
@stack('css')
@yield('css')

<style type="text/css">
	
	.user-panel .image img {
	  width: 100%;
	  max-width: 45px;
	  height: auto;
	}

</style>

@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
	'boxed' => 'layout-boxed',
	'fixed' => 'fixed',
	'top-nav' => 'layout-top-nav'
	][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

	@section('body')
	<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">
			@if(config('adminlte.layout') == 'top-nav')
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
							{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
						</a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
						<ul class="nav navbar-nav">
							@each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
						</ul>
					</div>
					<!-- /.navbar-collapse -->
					@else
					<!-- Logo -->
					<a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
						<!-- mini logo for sidebar mini 50x50 pixels -->
						<span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
						<!-- logo for regular state and mobile devices -->
						<span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
					</a>

					<!-- Header Navbar -->
					<nav class="navbar navbar-static-top" role="navigation">
						<!-- Sidebar toggle button-->
						<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
							<span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
						</a>
						@endif
						<!-- Navbar Right Menu -->
						<div class="navbar-custom-menu">

							<ul class="nav navbar-nav">

								<!-- Messages: style can be found in dropdown.less-->
								<li class="dropdown messages-menu">
									<!-- Menu toggle button -->
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-envelope-o"></i>
										<span class="label label-success">4</span>
									</a>
									<ul class="dropdown-menu">
										<li class="header">You have 4 messages</li>
										<li>
											<!-- inner menu: contains the messages -->
											<ul class="menu">
												<li>
													<!-- start message -->
													<a href="#">
														<div class="pull-left">
															<!-- User Image -->
															<img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
														</div>
														<!-- Message title and timestamp -->
														<h4>
															Support Team
															<small><i class="fa fa-clock-o"></i> 5 mins</small>
														</h4>
														<!-- The message -->
														<p>Why not buy a new awesome theme?</p>
													</a>
												</li>
												<!-- end message -->
											</ul>
											<!-- /.menu -->
										</li>
										<li class="footer"><a href="#">See All Messages</a></li>
									</ul>
								</li>
								<!-- /.messages-menu -->

								<!-- Notifications Menu -->
								<li class="dropdown notifications-menu">
									<!-- Menu toggle button -->
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-bell-o"></i>
										<span class="label label-warning">10</span>
									</a>
									<ul class="dropdown-menu">
										<li class="header">You have 10 notifications</li>
										<li>
											<!-- Inner Menu: contains the notifications -->
											<ul class="menu">
												<li>
													<!-- start notification -->
													<a href="#">
														<i class="fa fa-users text-aqua"></i> 4 new members joined today
													</a>
												</li>
												<!-- end notification -->
											</ul>
										</li>
										<li class="footer"><a href="#">View all</a></li>
									</ul>
								</li>
								<!-- Tasks Menu -->
								<li class="dropdown tasks-menu">
									<!-- Menu Toggle Button -->
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-flag-o"></i>
										<span class="label label-danger">9</span>
									</a>
									<ul class="dropdown-menu">
										<li class="header">You have 9 tasks</li>
										<li>
											<!-- Inner menu: contains the tasks -->
											<ul class="menu">
												<li>
													<!-- Task item -->
													<a href="#">
														<!-- Task title and progress text -->
														<h3>
															Design some buttons
															<small class="pull-right">20%</small>
														</h3>
														<!-- The progress bar -->
														<div class="progress xs">
															<!-- Change the css width attribute to simulate progress -->
															<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
																<span class="sr-only">20% Complete</span>
															</div>
														</div>
													</a>
												</li>
												<!-- end task item -->
											</ul>
										</li>
										<li class="footer">
											<a href="#">View all tasks</a>
										</li>
									</ul>
								</li>
								<!-- User Account Menu -->
								<li class="dropdown user user-menu">
									<!-- Menu Toggle Button -->
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<!-- The user image in the navbar-->
										<img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
										<!-- hidden-xs hides the username on small devices so only the image appears. -->
										<span class="hidden-xs">{{ Auth::user()->username }}</span>
									</a>
									<ul class="dropdown-menu">
										<!-- The user image in the menu -->
										<li class="user-header">
											<img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

											<p>
												{{ auth()->user()->username }} 
												<small></small>
											</p>
										</li>
										<!-- Menu Body -->
										<li class="user-body">
											<div class="row">
												<div class="col-xs-4 text-center">
													<a href="#">Followers</a>
												</div>
												<div class="col-xs-4 text-center">
													<a href="#">Sales</a>
												</div>
												<div class="col-xs-4 text-center">
													<a href="#">Friends</a>
												</div>
											</div>
											<!-- /.row -->
										</li>

										<li>
											@if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
											<a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
												<i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
											</a>
											@else
											<a href="#"
											onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
											>
											<i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
										</a>
										<form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
											@if(config('adminlte.logout_method'))
											{{ method_field(config('adminlte.logout_method')) }}
											@endif
											{{ csrf_field() }}
										</form>
										@endif
									</li>
								</ul>
							</div>
							@if(config('adminlte.layout') == 'top-nav')
						</div>
						@endif
					</nav>
				</header>

				@if(config('adminlte.layout') != 'top-nav')
				<!-- Left side column. contains the logo and sidebar -->
				<aside class="main-sidebar">

					<!-- sidebar: style can be found in sidebar.less -->
					<section class="sidebar">

						<div class="user-panel">
							<a href="">
							<div class="pull-left image">
								<a href="{{ '/admin/users/' . Auth::user()->username }}">						
									<img src="{{ asset('storage/avatars/cropped/' . Auth::user()->avatar) }}" class="img-circle" alt="User Image">
								</a>	
							</div>
							</a>
							<div class="pull-left info">
								<a style="font-size: 1em;" href="{{ '/admin/users/' . Auth::user()->username }}">{{ Auth::user()->username }}</a><br><br>
								<small><i class="fa fa-circle text-success"></i> Online</small>
								<small><i class="fa fa-circle text-danger"></i> Offline</small>
							</div>
						</div>

						<!-- Sidebar Menu -->
						<ul class="sidebar-menu">
							@each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
						</ul>
						<!-- /.sidebar-menu -->
					</section>
					<!-- /.sidebar -->
				</aside>
				@endif

				<!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
					@if(config('adminlte.layout') == 'top-nav')
					<div class="container">
						@endif

						<!-- Content Header (Page header) -->
						<section class="content-header">
							@yield('content_header')

							@if(Request::segment(2))
																			
								<ol class="breadcrumb" style="font-size: 1.1em;float: none;position: relative;margin-bottom: 20px;padding-left: 10px;">
							        					        
									<li>

									  <i class="fa fa-home"></i>

									  <a href="{{route('admin')}}">Home</a>	

									</li>

									@php

										$url = '/admin/';

									@endphp

									@for($i = 2; $i <= count(Request::segments()); $i++)

										@php

											$url = $url . Request::segment($i) . '/';

										@endphp

										<li>
										
										  	<a href="{{ $url }}">{{ ucfirst(Request::segment($i)) }}</a>
											
										</li>

									@endfor
									
							    </ol>

							@endif
							
						</section>

						<!-- Main content -->
						<section class="content">

							@yield('content')

						</section>
						<!-- /.content -->
						@if(config('adminlte.layout') == 'top-nav')
					</div>
					<!-- /.container -->
					@endif
				</div>
				<!-- /.content-wrapper -->

				<footer class="main-footer">

				    <div class="pull-right hidden-xs">
				    	<!-- <b>Version</b> 2.4.0 -->
				    </div>

				    <strong>Copyright © 2014-{{ \Carbon\Carbon::now()->year }} <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>.</strong> All rights
				    reserved.

				 </footer>

			</div>
			<!-- ./wrapper -->
			@stop

			@section('adminlte_js')
			<script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>
			@stack('js')
			@yield('js')
			@stop
