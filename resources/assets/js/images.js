////////////
	// IMAGES //
	////////////
$(document).ready(function() {

	assignImagesHandlers();

	initAdminPlugins();

	$('#account').click(toggleNavDropdown);

	$('html').click(hideDropdown);

	function assignImagesHandlers() {

		$('#imagesAjax .pagination a').click(function(e) {

			e.preventDefault();
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
		        var url = '/admin/images?page=' + $('#imagesAjax > .panel > .panel-body > .table-responsive > .pagination > .active').find('span').text();
		        console.log(url)
		        getImages(url);
		    }
		});

	};

	/////////////////
	//ADMIN PLUGINS//
	/////////////////

	function initAdminPlugins() {

		// init slicknav
		$('#menu').slicknav({
			label: 'MENU',
			duration: 800,
			easingOpen: "swing",
			easingClose: "easeOutBounce"
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

		// init select2
		$('#selectCategories').select2();


    	$('[data-toggle="popover"]').popover();

	};

});