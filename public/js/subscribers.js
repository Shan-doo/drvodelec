/////////////////
// SUBSCRIBERS //
/////////////////

$(document).ready(function() {

	$('[data-toggle="popover"]').popover();

	$('#account').click(toggleNavDropdown);

	$('html').click(hideDropdown);

	assignSubscribersHandlers();
	
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

	// delete a subscriber

	function deleteSubscriber(ev) {
		
		showLoader('Brisanje...', 'subscribers');

		var subscriber_id = $(ev.target).data('subscriber-id');
		var tableRow = $(this).closest('tr');

		$.ajax({
		    url: '/admin/subscribers/' + subscriber_id,
		    type: 'delete',
		    success: function() {

		        tableRow.fadeOut();
				hideLoader('subscribers');        
		        var url = '/admin/subscribers?page=' + $('#subscribersAjax .pagination .active').find('span').text();
		        console.log(url)		       
		        getSubscribers(url);		        
		    }
		});

	};

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

		$('.deleteSubscriber').click(deleteSubscriber);

		$('#subscribersAjax .pagination a').click(paginationHandlersSubscribers);

	}

});