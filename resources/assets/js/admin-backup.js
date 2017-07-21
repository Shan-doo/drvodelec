//////////////	
// MESSAGES //
//////////////

$(document).ready(function($) {

	initAdminPlugins();

	assignMessagesHandlers();

	assignImagesHandlers();

	assignSubscribersHandlers();

	$('#account').click(toggleNavDropdown);

	$('html').click(hideDropdown);
	
	// assign event handlers for conversations pagination, displaying, responding and deleting
	function assignMessagesHandlers() {

		$('#messagesAjax .pagination a').click(function(e) {
			e.preventDefault();
		});

		$('#messagesAjax .pagination a').click(paginationHandlersMessages);
			   
	    $('.respondMessage').click(displayConversation);

	    $('#responseBtn').click(respond);

	    $('.deleteMessage').click(deleteConversation);

	    // autofocus
	    $('#responseModal').on('shown.bs.modal', function () {
    	$(this).find('textarea').focus();
		});

	};

	// ajax pagination for messages	
    function paginationHandlersMessages(e) {

    	// remove events until ajax call is finished
        $('#messagesAjax .pagination a').off('click', paginationHandlersMessages);

        $('#load a').css('color', '#dfecf6');
       	showLoader('Učitavanje...', 'conversations');

        var url = $(this).attr('href'); 

        getMessages(url);

        window.history.pushState("", "", url);

    }

    function getMessages(url) {

        $.ajax({
            url : url  
        }).done(function (data) {
        	
			hideLoader('conversations');

       	 	$('#messagesAjax').html(data);

			assignMessagesHandlers();
       	 			       	 
        }).fail(function () {
			
        	assignMessagesHandlers();

        });
    }
	
	
	// display conversation

	function displayConversation(event) {

		var element = $(event.target);
		var unopened = element.find('i').hasClass('fa-envelope');
		
		if (unopened) {

			element.find('i').removeClass('fa fa-envelope').addClass('fa fa-envelope-open');
		}
		
		var conversation_id = element.data('conversation-id');

		showLoader('Otvaram...', 'conversations');

		// mark conversation as opened
		if (unopened) {

			$.ajax({
			    url: '/admin/messages/' + conversation_id,
			    type: 'patch'
			}).done(function(){

				// BUG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				var $unread = $('#messagesAjax .panel .panel-heading p:last-child');
			
				var $unreadNum = parseInt($unread.html().slice(-2));
			
				$unread.html('Nepročitano: ' + ($unreadNum - 1));
			});
		}

		$.ajax({
            url : '/admin/messages/' + conversation_id  
        }).done(function (conversation) {
       		
        	hideLoader('conversations');

			$('#responseModal .modal-title').text(conversation.subject);

			$('#responseModal .modal-body > #messages').empty();

			for (var i = 0; i < conversation.messages.length; i++) {

				var message = $('<p></p>');

				if (conversation.messages[i].owner == 0) {
					message.addClass('client');
				} else {
					message.addClass('admin')
				}

				message.text(conversation.messages[i].body);

				$('#responseModal .modal-body > #messages').append(message);
			}
			
			$('#responseModal .modal-body > #responseForm > input[name="to"]').val(conversation.email);
			$('#responseModal .modal-body > #responseForm > input[name="conversationId"]').val(conversation.id);
			$('#responseModal').modal('show');
			$('#responseModal textarea').focus();

        }).fail(function () {
				
				hideLoader('conversations');            
    	});

	};
			
	// respond
	function respond(event) {

		event.preventDefault();

		var responseStatus = $(this).closest('form').find("#responseStatus");
		var textarea = $(this).closest('form').find('textarea');
		var response = textarea.val();
		var to = $(this).closest('form').find('input[name="to"]').val();
		var conversationId = $(this).closest('form').find('input[name="conversationId"]').val();

		responseStatus.show();

		$.post("/admin/response",
	    {
	        to: to,
	        conversationId: conversationId,
	        response: response
	     
	    },
	    function(data, status){

	    	if (status == 'success') {

	    		responseStatus.hide();

	    		textarea.val('');

	    		var message = $('<p></p>').addClass('admin').text(response);

				$('.modal-body > #messages').append(message);

	    	}
	      
	    });

	};

	// delete a conversation

	function deleteConversation(ev) {
		
		showLoader('Brisanje...', 'conversations');

		var conversation_id = $(ev.target).data('conversation-id');
		var tableRow = $(this).closest('tr');

		$.ajax({
		    url: '/admin/messages/' + conversation_id,
		    type: 'delete',
		    success: function() {

		        tableRow.fadeOut();
				hideLoader('conversations');        
		        var url = 'admin?get=conv&page=' + $('#messagesAjax > .panel > .panel-body > .pagination > .active').find('span').text();		       
		        getMessages(url);		        
		    }
		});

	};

	function showLoader(message, table) {

		if (table === 'conversations') {

			$('#loaderAjaxConversation').find('p').text(message);
			$('#loaderAjaxConversation').css('visibility', 'visible');
		} else {

			$('#loaderAjaxImages').find('p').text(message);
			$('#loaderAjaxImages').css('visibility', 'visible');
		}
	};

	function hideLoader(table) {

		if (table === 'conversations') {

		$('#loaderAjaxConversation').css('visibility', 'hidden');
		} else {

			$('#loaderAjaxImages').css('visibility', 'hidden');
		}
	};

	////////////
	// IMAGES //
	////////////

	function assignImagesHandlers() {

		$('#imagesAjax .pagination a').click(function(e) {

			e.preventDefault();
		});
	
		// init prettyPhoto 
		$("a[rel^='prettyPhoto']")
		.prettyPhoto({
			animation_speed:'normal',
			theme:'light_square',
			slideshow:false, 
			autoplay_slideshow: false, 
			social_tools: ''
		});

		$('#imagesAjax .pagination a').click(paginationHandlersImages);

		$('.deleteImage').click(deleteImage);	

	};

	// ajax pagination for images
	function paginationHandlersImages(e) {

		// remove events until ajax call is finished
	    $('#imagesAjax .pagination a').off('click', paginationHandlersImages);

	    $('#load a').css('color', '#dfecf6');
	   	$('#loaderAjaxImages').css('visibility', 'visible');

	    var url = $(this).attr('href');  
	    getImages(url);
	    window.history.pushState("", "", url);

	}

	function getImages(url) {

	    $.ajax({
	        url : url  
	    }).done(function (data) {
	    	
			$('#loaderAjaxImages').css('visibility', 'hidden'); 

	   	 	$('#imagesAjax').html(data);

	   	 	assignImagesHandlers();

	    }).fail(function () {
			
	    	assignImagesHandlers();
			            
	    });
	}

	//delete an image
	function deleteImage(ev) {
		
		showLoader('Brisanje...', 'images');

		var imageId = $(ev.target).data('image-id');
		var tableRow = $(this).closest('tr');

		$.ajax({
		    url: '/admin/images?image_id=' + imageId,
		    type: 'delete',
		    success: function(result) {
		    	
		        tableRow.fadeOut();
		        hideLoader('images');
		        var url = 'admin?get=imgs&page=' + $('#imagesAjax > .panel > .panel-body > .pagination > .active').find('span').text();		       
		        getImages(url);
		    }
		});

	};

	/////////////////
	// SUBSCRIBERS //
	/////////////////

	// ajax pagination for subscribers
	function paginationHandlersSubscribers(e) {

		// remove events until ajax call is finished
	    $('#imagesAjax .pagination a').off('click', paginationHandlersSubscribers);

	    $('#load a').css('color', '#dfecf6');
	   	$('#loaderAjaxSubscribers').css('visibility', 'visible');

	    var url = $(this).attr('href');  
	    getSubscribers(url);
	    window.history.pushState("", "", url);

	}

	function getSubscribers(url) {

	    $.ajax({
	        url : url  
	    }).done(function (data) {
	    	
			$('#loaderAjaxSubscribers').css('visibility', 'hidden'); 

	   	 	$('#subscribersAjax').html(data);

	   	 	assignSubscribersHandlers();

	    }).fail(function () {
			
	    	assignSubscribersHandlers();
			            
	    });
	}

	function assignSubscribersHandlers() {

		$('#subscribersAjax .pagination a').click(function(e) {
			e.preventDefault();
		});

		$('#subscribersAjax .checkbox input').change(function() {

			$('#loaderAjaxSubscribers').css('visibility', 'visible');
			
			if ($(this).attr('checked') === undefined) {
				
				$.post('/unsubscribe',

				{
					id: $(this).val()
				}, 

				function(data, textStatus, xhr) {

					var $active = $('#subscribersAjax .panel-heading > p:nth-child(2) > span');
					var $activeNum = parseInt($active.text());
					
					var $inactive = $('#subscribersAjax .panel-heading > p:nth-child(3) > span');
					var $inactiveNum = parseInt($inactive.text());

					$active.text($activeNum - 1);

					$inactive.text($inactiveNum + 1);

					$('#loaderAjaxSubscribers').css('visibility', 'hidden');
					
				});
			}

			if ($(this).attr('checked') === 'checked') {
				
				$.post('/subscribe',

				{
					id: $(this).val()
				}, 

				function(data, textStatus, xhr) {

					var $active = $('#subscribersAjax .panel-heading > p:nth-child(2) > span');
					var $activeNum = parseInt($active.text());
					
					var $inactive = $('#subscribersAjax .panel-heading > p:nth-child(3) > span');
					var $inactiveNum = parseInt($inactive.text());

					$active.text($activeNum + 1);

					$inactive.text($inactiveNum - 1);

					$('#loaderAjaxSubscribers').css('visibility', 'hidden');		
					
				});
			}
	
		});

		$('#subscribersAjax .pagination a').click(paginationHandlersSubscribers);

	}

	function initAdminPlugins() {

		// init slicknav
		$('#menu').slicknav({
			label: 'MENU',
			duration: 800,
			easingOpen: "swing",
			easingClose: "easeOutBounce"
		});

		// init select2
		$('#selectCategories').select2();


    	$('[data-toggle="popover"]').popover();

	};

	////////////////
	//NAV DROPDOWN//
	////////////////

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
});