$(document).ready(function(){

	calculateScroll();

	assignIndexHandlers();

	initIndexPlugins();

	// failed login modal

	$('#failedLogInModal').modal('show');

	$('#resetPasswordModal').modal('show');

	function assignIndexHandlers() {

		// login form

		$('#loginFormSubmit').click(function(e) {

			e.preventDefault();
			submitLoginForm();
		});

		$('#registerFormSubmit').click(function(e) {

			e.preventDefault();
			submitRegisterForm();
		});

		$('#forgotFormSubmit').click(function(e) {

			e.preventDefault();
			submitForgotPasswordForm();
		});

		$('#resetFormSubmit').click(function(e) {

			e.preventDefault();
			submitResetPasswordForm();
		});

		// subscriber

		$('#newsletter .subS').click(function(e){

			e.preventDefault();

			subscribe($(this).prev().val());
		})

		// hide nav menu dropdown on click anywhere
		$('html').click(hideDropdown);

		// prevent anchors' in filter default behaviour

		$('.categories ul li a').click(function(e){

			e.preventDefault();
		});

		// toggle nav menu and highlight nav menu items on scroll

		$(window).scroll(function(event) {

			toggleNav();
			calculateScroll();
		});

		// smooth scroll to

		$('.navmenu > ul > li > a, #footer #downMenu > li > a').not('#login, #account').click(function() {
		 	
			$('html, body').animate({scrollTop: $(this.hash).offset().top - 80}, 500);
			return false;
		});

		$('#sendMessage').click(function() {
		
			if (validateMessage($("#messageForm input, #messageForm textarea"))) {

				sendMessage();
			} else {

				showNotification('Greška', 'Potrebno je popuniti sva polja!');
			}

		});

		// clear form on btn click

		$('#clearForm').click(clearForm);

		// account dropdown

		$('#account').click(toggleNavDropdown);

		// autofocus

		$('#loginModal').on('shown.bs.modal', focusModal);
	    
	}

	function focusModal() {

		$(this).find('input[name=username]').focus();

		$(this).find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var target = e.target.attributes.href.value;
		  $(target +' input[type=text]').focus();
		})

	}

	function initIndexPlugins() {

		// responsive menu

		$('#menu').slicknav({
			label: 'MENU',
			duration: 800,
			easingOpen: "swing",
			easingClose: "easeOutBounce"
		});

		// camera wrap

		$('#camera_wrap_1').camera({
			transPeriod: 500,
			time: 3000,
			height: '490px',
			thumbnails: false,
			pagination: true,
			playPause: false,
			loader: false,
			navigation: false,
			hover: false
		});

	 	// prettyPhoto

	    $(".pretty a[rel^='prettyPhoto']").prettyPhoto({
	    	animation_speed:'fast',
	    	theme:'light_square',
	    	slideshow:3000, 
	    	autoplay_slideshow: false, 
	    	social_tools: ''
	    });
	}

	function toggleNavDropdown(e){

		e.preventDefault();
		e.stopPropagation();

		$(this).parent().toggleClass('dropped');
		
		$(this).parent().find('#dropdownMenu').fadeToggle(300, function() {

			if ($(this).parent().find('i').attr('class') === 'fa fa-caret-down') {

			$(this).parent().find('i').removeClass('fa-caret-down').addClass('fa-caret-up')

			} else {

				$(this).parent().find('i').removeClass('fa-caret-up').addClass('fa-caret-down')
			}

		});
	}

	// hide nav menu dropdown on click anywhere
	function hideDropdown() {
		
		$('#dropdownMenu').fadeOut(300, function() {

			$(this).parent().find('i').removeClass('fa-caret-up').addClass('fa-caret-down');

		});

	};

	///////////////////////////
	// CONTACT - SEND MESSAGE//
	///////////////////////////
	
	function sendMessage() {
		
		var datastring = $("#messageForm").serialize();
		
		$.ajax({
		    type: "POST",
		    url: "/message",
		    data: datastring,
		
		    success: function(sender) {

		    	showNotification('Poruka poslata', 'Vaša poruka je uspešno poslata!');
		    	clearForm();	        
		    },
		    error: function() {

		        showNotification('Greška', 'Došlo je do neočekivane greške. Molimo pokušajte ponovo.');	
		    }
		});

	};

	function validateMessage(fields) {
		
		var validated = true;

		$.each(fields, function(index, el) {
			
			 if (!$.trim(el.value).length) {

			 	validated = false;
			 }
			 
		});

		return validated;
	}

	// highlight nav menu items on scroll

	function calculateScroll() {

		var contentTop      =   [];
		var contentBottom   =   [];
		var winTop      =   $(window).scrollTop();
		var rangeTop    =   200;
		var rangeBottom =   50;		

		$('.navmenu').find('ul > li > a:lt(5)').each(function(){

			contentTop.push( $( $(this).attr('href') ).offset().top );

			contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );

		})

		$.each( contentTop, function(i){

			if ( winTop > contentTop[i] - rangeTop && winTop < contentBottom[i] - rangeBottom ){
				
				$('.navmenu li')
				.removeClass('active')
				.eq(i).addClass('active');				
			}
		})
	};

	// change nav menu on scroll

	function toggleNav() {
		
		var $menu = $("#menuF");

		if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){

            $menu.removeClass("default")
                     	 .addClass("fixed transbg")
                                     
        } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
           
            $menu.removeClass("fixed transbg")
                     	 .addClass("default")
        }

	}

	function clearForm() {
		
		var inputs = $('#messageForm :input');
		inputs.each(function() {
			$(this).val("");
		});

	};

	function showNotification(title, message) {

		$('#notificationModal > .modal-dialog > .modal-content > .modal-header > .modal-title').text(title);
		$('#notificationModal > .modal-dialog > .modal-content > .modal-body > p').text(message);
		$('#notificationModal').modal();
	};

	//////////////
	//NEWSLETTER//
	//////////////

	function subscribe(email) {

		$.ajax({
		    type: "POST",
		    url: "/subscribe",
		    data: {email:email},
		
		    success: function(response, textStatus, xhr) {

		    	/*console.log(response)
		    
		    	showNotification('Prijava uspešna', 'Uspešno ste se prijavili na naš bilten.');*/
		    	        
		    },
		    error: function(response, textStatus, xhr) {
		    			    	
		       var responseObj = JSON.parse(response.responseText);

		       showNotification('Greška', responseObj.email[0]);

		    }
		});
	};


	//////////////////////////////////////////////////////
	//LOGIN/PASSWORD/RESET FORM VALIDATION AND SUBMITION//
	//////////////////////////////////////////////////////

	function submitLoginForm() {

		$('#usernameError > strong').text('');

		$('#passwordError > strong').text('');

		var $loginForm = $('#loginForm');

		var $username = $loginForm.find('input[name=username]').val();

		var $password = $loginForm.find('input[name=password]').val();

		$('#loginSpinner').css('visibility', 'visible');


		$.ajax({
		    type: "POST",
		    url: "/login",
		    data: {
		    	username: $username,
		    	password: $password
			},
		
		    success: function(response, textStatus, xhr) {

		    	$('#loginSpinner').css('visibility', 'hidden');

		    	/*$('#loginForm').submit();*/

		    	window.location = '/admin';

		    	$('#loginModal').modal('hide');

		    },

		    error: function(response, textStatus, xhr) {

		    	if (JSON.parse(response.responseText).username !== undefined) {

		    		$('#loginSpinner').css('visibility', 'hidden');

		    		$('#usernameErrorLogin > strong').text(JSON.parse(response.responseText).username);
		    	}

		    	if (JSON.parse(response.responseText).password !== undefined) {

		    		var passwordErrors = JSON.parse(response.responseText).password;
		    				    		
		    		$('#loginSpinner').css('visibility', 'hidden');

		    		for (var i = 0; i < passwordErrors.length; i++) {
		    		
		    			$('#passwordErrorLogin > strong').text(passwordErrors[i]);
		    		}

		    		
		    	}
		    			    			  
		    }
		});
	}

	function submitRegisterForm() {

		$('#usernameErrorRegister > strong').text('');

		$('#emailErrorRegister > strong').text('');

		$('#passwordErrorRegister > strong').text('');

		var $registerForm = $('#registerForm');

		var $username = $registerForm.find('input[name=username]').val();

		var $email = $registerForm.find('input[name=email]').val();

		var $password = $registerForm.find('input[name=password]').val();

		var $password_confirmation = $registerForm.find('input[name=password_confirmation]').val();

		$('#registerSpinner').css('visibility', 'visible');


		$.ajax({
		    type: "POST",
		    url: "/register",
		    data: {
		    	username: $username,
		    	email: $email,
		    	password: $password,
		    	password_confirmation: $password_confirmation
			},
		
		    success: function(response, textStatus, xhr) {

		    	$('#registerSpinner').css('visibility', 'hidden');
	
		    	window.location = '/';

		    	$('#loginModal').modal('hide');

		    },

		    error: function(response, textStatus, xhr) {

		    	if (JSON.parse(response.responseText).username !== undefined) {

		    		$('#registerSpinner').css('visibility', 'hidden');

		    		$('#usernameErrorRegister > strong').text(JSON.parse(response.responseText).username);
		    	}

		    	if (JSON.parse(response.responseText).email !== undefined) {

		    		$('#registerSpinner').css('visibility', 'hidden');

		    		$('#emailErrorRegister > strong').text(JSON.parse(response.responseText).email);
		    	}

		    	if (JSON.parse(response.responseText).password !== undefined) {

		    		var passwordErrors = JSON.parse(response.responseText).password;
		    				    		
		    		$('#loginSpinner').css('visibility', 'hidden');

		    		for (var i = 0; i < passwordErrors.length; i++) {
		    		
		    			$('#passwordErrorRegister > strong').text(passwordErrors[i]);
		    		}
		    	}		    			    			  
		    }
		});
	}

	function submitForgotPasswordForm() {

		$('#forgotEmailError > strong').text('');

		$('#forgotEmailSuccess > strong').text('');

		var $forgotPasswordForm = $('#forgotPasswordForm');

		var $email = $forgotPasswordForm.find('input[name=email]').val();

		$('#forgotSpinner').css('visibility', 'visible');
		
		$.ajax({
		    type: "POST",
		    url: "/password/email",
		    data: {
		    	email: $email
			},
		
		    success: function(response, textStatus, xhr) {
			 
		    	$('#forgotSpinner').css('visibility', 'hidden');

		    	if (response.success !== undefined) {
		    		$('#forgotEmailSuccess > strong').text(response.success);
		    	}

		    	if (response.failed !== undefined) {
		    		$('#forgotEmailError > strong').text(response.failed);
		    	}
		    },

		    error: function(response, textStatus, xhr) {

		    	$('#forgotSpinner').css('visibility', 'hidden');
				
		    	$('#forgotEmailError > strong').text('Došlo je do graške. Molimo pokušajte kasnije.');		    	    			    			  
		    }
		});
	}

	function submitResetPasswordForm() {

		$('#resetEmailError > strong').text('');

		$('#resetPasswordError > strong').text('');

		var $resetForm = $('#resetForm');

		var $email = $resetForm.find('input[name=email]').val();

		var $password = $resetForm.find('input[name=password]').val();

		var $password_confirmation = $resetForm.find('input[name=password_confirmation]').val();

		$('#resetSpinner').css('visibility', 'visible');


		$.ajax({
		    type: "POST",
		    url: "/password/reset",
		    data: {
		    	email: $email,
		    	password: $password,
		    	password_confirmation: $password_confirmation
			},
		
		    success: function(response, textStatus, xhr) {

		    	$('#resetSpinner').css('visibility', 'hidden');
	
		    	window.location = '/';

		    	$('#loginModal').modal('hide');

		    },

		    error: function(response, textStatus, xhr) {

		    	if (JSON.parse(response.responseText).email !== undefined) {

		    		$('#resetSpinner').css('visibility', 'hidden');

		    		$('#resetEmailError > strong').text(JSON.parse(response.responseText).email);
		    	}

		    	if (JSON.parse(response.responseText).password !== undefined) {

		    		var passwordErrors = JSON.parse(response.responseText).password;
		    				    		
		    		$('#resetSpinner').css('visibility', 'hidden');

		    		for (var i = 0; i < passwordErrors.length; i++) {
		    		
		    			$('#resetPasswordError > strong').text(passwordErrors[i]);
		    		}
		    	}		    			    			  
		    }
		});
	}

});	





