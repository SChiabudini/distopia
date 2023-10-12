var $j = jQuery.noConflict();

$j(document).ready(function() {

	if ( typeof woovinaLocalize === 'undefined' ) {
		return false;
	}

	// Vars
	var qv_modal 		= $j( '#wvn-qv-wrap' ),
		qv_content 		= $j( '#wvn-qv-content' );

	/**
	 * Open quick view.
	 */
	$j( document ).on( 'click', '.wvn-quick-view', function( e ) {
		e.preventDefault();

		var $this 		= $j( this ),
			product_id  = $j( this ).data( 'product_id' );

		$this.parent().addClass( 'loading' );

		$j.ajax( {
			url: woovinaLocalize.ajax_url,
			data: {
				action : 'woovina_product_quick_view',
				product_id : product_id
			},
			success: function( results ) {

				var innerWidth = $j( 'html' ).innerWidth();
				$j( 'html' ).css( 'overflow', 'hidden' );
				var hiddenInnerWidth = $j( 'html' ).innerWidth();
				$j( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );
				$j( 'html' ).addClass( 'wvn-qv-open' );

				qv_content.html( results );

				// Display modal
				qv_modal.fadeIn();
				qv_modal.addClass( 'is-visible' );

				// Variation Form
				var form_variation = qv_content.find( '.variations_form' );

				form_variation.trigger( 'check_variations' );
				form_variation.trigger( 'reset_image' );

				var var_form = qv_content.find( '.variations_form' );

				if ( var_form.length > 0 ) {
					var_form.wc_variation_form();
					var_form.find( 'select' ).change();
				}

  				var image_slider_wrap = qv_content.find( '.wvn-qv-image' );

  				if(image_slider_wrap.find('li').length > 1 && 
				  (woovinaLocalize.quickviewGalleryStyle == 'gallery-slider' || woovinaLocalize.isMobile == 'true' || innerWidth < 1024)) {
	  				image_slider_wrap.flexslider();
  				}
				else {
					qv_content.addClass('gallery-scroller');
					setTimeout(function() {
						qv_content.find('ul.wvn-qv-slides').css('max-height', qv_content.find('.summary.entry-summary').innerHeight());						
					}, 250);
				}

  				// If grouped product
  				var grouped = qv_content.find( 'form.grouped_form' );
  				if ( grouped ) {
  					var grouped_product_url = qv_content.find( 'form.grouped_form' ).attr( 'action' );
					grouped.find( '.group_table, button.single_add_to_cart_button' ).hide();
					grouped.append( ' <a href="' + grouped_product_url + '" class="button">' + woovinaLocalize.grouped_text + '</a>' );
				}

			}

		} ).done( function() {
			$this.parent().removeClass( 'loading' );
		} );

	} );

	/**
	 * Close quick view function.
	 */
	var wvnCloseQuickView = function() {
		$j( 'html' ).css( {
			'overflow': '',
			'margin-right': ''
		} );
		$j( 'html' ).removeClass( 'wvn-qv-open' );

		qv_modal.fadeOut();
		qv_modal.removeClass( 'is-visible' );

		setTimeout( function() {
			qv_content.html( '' );
		}, 600);
	};

	/**
	 * Close quick view.
	 */
	$j( '.wvn-qv-overlay, .wvn-qv-close' ).on( 'click', function( e ) {
		e.preventDefault();
		wvnCloseQuickView();
	} );

	/**
	 * Check if user has pressed 'Esc'.
	 */
	$j( document ).keyup( function( e ) {
    	if ( e.keyCode == 27 ) {
			wvnCloseQuickView();
		}
	} );

	$j.fn.serializeArrayAll = function () {

		var rCRLF = /\r?\n/g;
		return this.map(function () {
			return this.elements ? jQuery.makeArray(this.elements) : this;
		}).map(function (i, elem) {
			var val = jQuery(this).val();

			if (val == null) {
				return val == null

			//If checkbox is unchecked
			} else if (this.type == "checkbox" && this.checked == false) {
				return {name: this.name, value: this.checked ? this.value : ''}

			} else if (this.type == "radio" && this.checked == false) {
				return {name: this.name, value: this.checked ? this.value : ''}

			//default: all checkboxes = on
			} else {
				return jQuery.isArray(val) ?
						jQuery.map(val, function (val, i) {
							return {name: elem.name, value: val.replace(rCRLF, "\r\n")};
						}) :
						{name: elem.name, value: val.replace(rCRLF, "\r\n")};
			}
		}).get();
	};

	/**
	 * AddToCartHandler class.
	 */
	var wvnQVAddToCartHandler = function() {
		$j( document.body )
			.on( 'click', '#wvn-qv-content .product:not(.product-type-external) .single_add_to_cart_button', this.onAddToCart )
			.on( 'added_to_cart', this.updateButton );
	};

	/**
	 * Handle the add to cart event.
	 */
	wvnQVAddToCartHandler.prototype.onAddToCart = function( e ) {
		e.preventDefault();

		var button	  = $j( this ),
			$form 	  = $j( this ).closest('form.cart'),
			data      = $form.serializeArrayAll();

		var is_valid = false;

		$j.each(data, function (i, item) {
			if (item.name === 'add-to-cart') {
				is_valid = true;
        		return false;
			}
		})

		if( is_valid ){
        	e.preventDefault();
        }
        else{
        	return;
        }

		$j(document.body).trigger('adding_to_cart', [button, data]);

		button.removeClass( 'added' );
		button.addClass( 'loading' );

		// Ajax action.
		$j.ajax ({
			url: woovinaLocalize.wc_ajax_url,
			type: 'POST',
			data : data,

			success:function(results) {
				$j( document.body ).trigger( 'wc_fragment_refresh' );
				$j( document.body ).trigger( 'added_to_cart', [ results.fragments, results.cart_hash, button ] );

				// Redirect to cart option
				if ( woovinaLocalize.cart_redirect_after_add === 'yes' ) {
					window.location = woovinaLocalize.cart_url;
					return;
				}
			}
		});
	};

	/**
	 * Update cart page elements after add to cart events.
	 */
	wvnQVAddToCartHandler.prototype.updateButton = function( e, fragments, cart_hash, $button ) {
		$button = typeof $button === 'undefined' ? false : $button;

		if ( $button ) {
			$button.removeClass( 'loading' );
			$button.addClass( 'added' );

			// View cart text.
			if ( ! woovinaLocalize.is_cart && $button.parent().find( '.added_to_cart' ).length === 0 ) {
				$button.after( ' <a href="' + woovinaLocalize.cart_url + '" class="added_to_cart wc-forward" title="' +
					woovinaLocalize.view_cart + '">' + woovinaLocalize.view_cart + '</a>' );
			}
		}
	};

	/**
	 * Init wvnAddToCartHandler.
	 */
	new wvnQVAddToCartHandler();
});