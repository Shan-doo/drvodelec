//////////////	
	// MESSAGES //
	//////////////

	$(document).ready(function($) {

		assignMessagesHandlers();

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
			        var url = '/admin/messages?page=' + $('#messagesAjax .pagination .active').find('span').text();
			        console.log(url)		       
			        getMessages(url);		        
			    }
			});

		};

	});