(function($) {

	$(document).ready(function($){

		// Hide Custom Url if image link is not set to custom url
		$('body').on('change', '.woovina-container select[id$="images_link"]', function(e){
			var images_link = $(this);
			if ( images_link.val() != 'custom_url' ) {
				images_link.closest('.woovina-container').find('input[id$="custom_url"]').val('').parent().animate({opacity: 'hide' , height: 'hide'}, 200);
			} else {
				images_link.closest('.woovina-container').find('input[id$="custom_url"]').parent().animate({opacity: 'show' , height: 'show'}, 200);
			}
		});

		// Modfiy options when search for is changed
		$('body').on('change', '.woovina-container input:radio[id$="search_for"]', function(e){
			var search_for = $(this);
			if ( search_for.val() != 'username' ) {
				search_for.closest('.woovina-container').find('select[id$="images_link"] option[value="user_url"]').animate({opacity: 'hide' , height: 'hide'}, 200);
				search_for.closest('.woovina-container').find('select[id$="images_link"]').val('image_url');
				search_for.closest('.woovina-container').find('input[id$="blocked_users"]').closest('p').animate({opacity: 'show' , height: 'show'}, 200);
				search_for.closest('.woovina-container').find('.woovina-header-wrap').animate({opacity: 'hide' , height: 'hide'}, 200);
			} else {
				search_for.closest('.woovina-container').find('select[id$="images_link"] option[value="user_url"]').animate({opacity: 'show' , height: 'show'}, 200);
				search_for.closest('.woovina-container').find('select[id$="images_link"]').val('image_url');
				search_for.closest('.woovina-container').find('input[id$="blocked_users"]').closest('p').animate({opacity: 'hide' , height: 'hide'}, 200);
				search_for.closest('.woovina-container').find('.woovina-header-wrap').animate({opacity: 'show' , height: 'show'}, 200);
			}
		});

		// Hide header infos if display header is not set to yesurl
		$('body').on('change', '.woovina-container select[id$="display_header"]', function(e){
			var display_header = $(this);
			if ( display_header.val() != 'yes' ) {
				display_header.closest('.woovina-container').find('.woovina-display-header-options').animate({opacity: 'hide' , height: 'hide'}, 200);
			} else {
				display_header.closest('.woovina-container').find('.woovina-display-header-options').animate({opacity: 'show' , height: 'show'}, 200);
			}
		});

	}); // Document Ready

})(jQuery);