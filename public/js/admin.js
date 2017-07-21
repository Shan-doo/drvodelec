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

////////////
///LOADERS//
////////////

function showLoader(message, table) {

	if (table === 'conversations') {

		$('#loaderAjaxConversation').find('p').text(message);
		$('#loaderAjaxConversation').css('visibility', 'visible');

	} else if(table === 'images') {

		$('#loaderAjaxImages').find('p').text(message);
		$('#loaderAjaxImages').css('visibility', 'visible');

	} else if (table === 'subscribers') {

		$('#loaderAjaxSubscribers').find('p').text(message);
		$('#loaderAjaxSubscribers').css('visibility', 'visible');
	}
};

function hideLoader(table) {

	if (table === 'conversations') {

		$('#loaderAjaxConversation').css('visibility', 'hidden');
		
	} else if(table === 'images') {

		$('#loaderAjaxImages').css('visibility', 'hidden');

	} else if (table === 'subscribers') {

		$('#loaderAjaxSubscribers').css('visibility', 'hidden');
	}
};



