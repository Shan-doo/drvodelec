////////////
// IMAGES //
////////////

$(document).ready(function() {

	initAdminPlugins();
	
	assignImagesHandlers();

	function assignImagesHandlers() {

		console.log('called handlers')

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

	function initAdminPlugins() {

		console.log('called plugins')

		// init slicknav
		$('#menu').slicknav({
			label: 'MENU',
			duration: 800,
			easingOpen: "swing",
			easingClose: "easeOutBounce"
		});

		// init select2
		$('#selectCategories').select2();

	};

});