<div id="footer" class="lineBlack">
	<div class="container">
		<div class="row downLine">
			
			<div class="col-md-5 col-sm-5 text-left copy">
				<p>Copyright &copy; @php echo date("Y"); @endphp {{ config('app.name') }}. Made by <a href="http://designscrazed.org/">Dušan Krstić</a>. </p>
			</div>

			@if(Request::segment(1) !== 'admin' && Request::segment(1) !== 'login' && Request::segment(2) !== 'forgot')

			<div id="downMenuCont" class="col-md-5 col-sm-5 text-right dm">
				<ul id="downMenu">
					<li class="active"><a href="#home">{{ trans('navigation.home') }}</a></li>
					<li><a href="#about">{{ trans('navigation.about') }}</a></li>
					<li><a href="#project">{{ trans('navigation.projects') }}</a></li>
					<li class="last"><a href="#contact">{{ trans('navigation.contact') }}</a></li>
				</ul>
			
			</div>

			<div id="localeCont" class="col-md-2">
			
				<form action="/" method="POST" style="margin-top: -5px;">
						
					{{ csrf_field() }}
			
					<input name="locale" type="hidden" value="{{ App::getLocale() === 'en' ? 'srb' : 'en' }}">
			
					<button id="changeLocaleBtn" class="{{ App::getLocale() === 'en' ? 'srb' : 'en' }}" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;</button>
			
				</form>
			
			</div>
		
			@endif

		</div>
	</div>
</div>