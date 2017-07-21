<div id="contact" class="section">
	<div class="line5">					
		<div class="container">
			<div class="row Ama">
				<div id="contact" class="col-md-12">
					<h3>{{ trans('contact.question') }}</h3>
					<p>{{ trans('contact.contactUs') }}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-12 forma">
				<form id="messageForm">
					<input type="text" class="col-md-6 col-xs-12 name" name='sender' placeholder="{{ trans('contact.placeholderName') }}" value='{{ Cookie::get('name') ? Cookie::get('name') : ''}}'/>
					<input type="text" class="col-md-6 col-xs-12 Email" name='email' placeholder="{{ trans('contact.placeholderEmail') }}" value='{{ Cookie::get('email') ? Cookie::get('email') : ''}}'/>
					<input type="text" class="col-md-12 col-xs-12 Subject" name='subject' value='{{ Cookie::get('subject') ? Cookie::get('subject') : ''}}' placeholder='{{ trans('contact.subject') }}'/>
					<textarea type="text" class="col-md-12 col-xs-12 Message" name='body' placeholder='{{ trans('contact.message') }}'></textarea>
					<div class="cBtn col-xs-12">
						<ul>
							<li id="clearForm" class="clear"><a href="javascript:void(0);"><i class="fa fa-times"></i>Obriši polja</a></li>
							<li id="sendMessage" class="send"><a href="javascript:void(0);"><i class="fa fa-share"></i>Pošalji poruku</a></li>
						</ul>
					</div>
				</form>
			</div>
			<div class="col-md-3 col-xs-12 cont">
				<ul>
					<li><i class="fa fa-home"></i>5512 Lorem Ipsum Vestibulum 666/13</li>
					<li><i class="fa fa-phone"></i>+1 800 789 50 12, +1 800 450 6935</li>
					<li><a href="#"><i class="fa fa-envelope"></i>mail@compname.com</a></li>
					<li><a href="#"><i class="fa fa-facebook-square"></i>Facebook</a></li>
					<li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i>LinkedIn</a></li>
					<li><a href="#"><i class="fa fa-youtube-play"></i>YouTube</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>