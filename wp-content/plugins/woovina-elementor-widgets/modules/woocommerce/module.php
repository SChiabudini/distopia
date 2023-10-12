<?php
namespace wvnElementor\Modules\Woocommerce;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Woo_Add_To_Cart',
			'Woo_Products',
			'Woo_Categories',
			'Woo_Slider',
			'Woo_MenuCart'
		];
	}

	public function get_name() {
		return 'wew-woocommerce';
	}

	public function register_wc_hooks() {
		wc()->frontend_includes();
	}

	public function fix_query_offset(&$query) {
		if(! empty($query->query_vars['offset_to_fix'])) {
			if($query->is_paged) {
				$query->query_vars['offset'] = $query->query_vars['offset_to_fix'] + (($query->query_vars['paged'] - 1) * $query->query_vars['posts_per_page']);
			} else {
				$query->query_vars['offset'] = $query->query_vars['offset_to_fix'];
			}
		}
	}

	public function fix_query_found_posts($found_posts, $query) {
		$offset_to_fix = $query->get('offset_to_fix');

		if($offset_to_fix) {
			$found_posts -= $offset_to_fix;
		}

		return $found_posts;
	}

	function add_to_cart_product_ajax() {
		$product_id   = isset($_POST['product_id']) ? sanitize_text_field($_POST['product_id']) : 0;
		$variation_id = isset($_POST['variation_id']) ? sanitize_text_field($_POST['variation_id']) : 0;
		$quantity     = isset($_POST['quantity']) ? sanitize_text_field($_POST['quantity']) : 0;

		if($variation_id) {
			WC()->cart->add_to_cart($product_id, $quantity, $variation_id);
		} else {
			WC()->cart->add_to_cart($product_id, $quantity);
		}
		die();
	}

	public function __construct() {
		parent::__construct();

		// In Editor Woocommerce frontend hooks before the Editor init.
		add_action('admin_action_elementor', [ $this, 'register_wc_hooks' ], 9);

		add_action('pre_get_posts', [ $this, 'fix_query_offset' ], 1);
		add_filter('found_posts', [ $this, 'fix_query_found_posts' ], 1, 2);

		add_action('wp_ajax_wew_add_to_cart_product', array($this, 'add_to_cart_product_ajax'));
		add_action('wp_ajax_nopriv_wew_add_to_cart_product', array($this, 'add_to_cart_product_ajax'));
		
		add_action('elementor/editor/before_enqueue_scripts', [ $this, 'maybe_init_cart' ]);
		add_filter('woocommerce_add_to_cart_fragments', [ $this, 'menu_cart_fragments' ]);
	}
	
	public static function render_menu_cart() {
		if ( null === WC()->cart ) {
			return;
		}

		$widget_cart_is_hidden = apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() );
		$product_count = WC()->cart->get_cart_contents_count();
		$sub_total = WC()->cart->get_cart_subtotal();
		$cart_items = WC()->cart->get_cart();

		$toggle_button_link = $widget_cart_is_hidden ? wc_get_cart_url() : '#';
		/** workaround WooCommerce Subscriptions issue that changes the behavior of is_cart() */
		$toggle_button_classes = 'elementor-button elementor-size-sm';
		$toggle_button_classes .= $widget_cart_is_hidden ? ' woovina-menucart-hidden' : '';
		$counter_attr = 'data-counter="' . $product_count . '"';

		?>
		<div class="woovina-menucart__wrapper">
			<?php if ( ! $widget_cart_is_hidden ) : ?>
			<div class="woovina-menucart__container elementor-lightbox">
				<form class="woovina-menucart__main woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
					<h3 class="woovina-menucart-title">
						<?php esc_html_e( 'My Cart', 'woovina-elementor-widgets' ); ?>
						<span class="woovina-menucart__close-button"></span>
					</h3>
					<?php self::render_cart_content( $cart_items, $sub_total ); ?>
				</form>
			</div>
			<?php endif; ?>

			<div class="woovina-menucart__toggle elementor-button-wrapper">
				<a href="<?php echo esc_attr( $toggle_button_link ); ?>" class="<?php echo $toggle_button_classes; ?>">
					<span class="elementor-button-text"><?php echo $sub_total; ?></span>
					<span class="elementor-button-icon" <?php echo $counter_attr; ?>>
						<i class="eicon" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php esc_html_e( 'Cart', 'woovina-elementor-widgets' ); ?></span>
					</span>
				</a>
			</div>
		</div>
		<?php
	}
	
	private static function render_cart_empty() {
		?>
		<div class="woocommerce-mini-cart__empty-message"><?php esc_attr_e( 'No products in the cart.', 'woovina-elementor-widgets' ); ?></div>
		<?php
	}

	private static function render_cart_content( $cart_items, $sub_total ) {
		if ( empty( $cart_items ) ) {
			self::render_cart_empty();
			return;
		}
		?>
		<div class="woovina-menucart__products woocommerce-mini-cart cart woocommerce-cart-form__contents">
			<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( $cart_items as $cart_item_key => $cart_item ) {
				self::render_cart_item( $cart_item_key, $cart_item );
			}

			do_action( 'woocommerce_mini_cart_contents' );
			?>
		</div>

		<div class="woovina-menucart__subtotal">
			<strong><?php echo translate( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo $sub_total; ?>
		</div>
		<div class="woovina-menucart__footer-buttons">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="elementor-button elementor-button--view-cart elementor-size-md">
				<span class="elementor-button-text"><?php echo translate( 'View cart', 'woocommerce' ); ?></span>
			</a>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="elementor-button elementor-button--checkout elementor-size-md">
				<span class="elementor-button-text"><?php echo translate( 'Checkout', 'woocommerce' ); ?></span>
			</a>
		</div>
		<?php
	}
	
	private static function render_cart_item( $cart_item_key, $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$is_product_visible = ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) );

		if ( ! $is_product_visible ) {
			return;
		}

		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
		?>
		<div class="woovina-menucart__product woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

			<div class="woovina-menucart__product-image product-thumbnail">
				<?php
				$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

				if ( ! $product_permalink ) :
					echo wp_kses_post( $thumbnail );
				else :
					printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
				endif;
				?>
			</div>

			<div class="woovina-menucart__product-name product-name" data-title="<?php esc_attr_e( 'Product', 'woovina-elementor-widgets' ); ?>">
				<?php
				if ( ! $product_permalink ) :
					echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
				else :
					echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
				endif;

				do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

				// Meta data.
				echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
				?>
			</div>

			<div class="woovina-menucart__product-price product-price" data-title="<?php esc_attr_e( 'Price', 'woovina-elementor-widgets' ); ?>">
				<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
			</div>

			<div class="woovina-menucart__product-remove product-remove">
				<?php
				echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
					'<a href="%s" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"></a>',
					esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
					__( 'Remove this item', 'woovina-elementor-widgets' ),
					esc_attr( $product_id ),
					esc_attr( $cart_item_key ),
					esc_attr( $_product->get_sku() )
				), $cart_item_key );
				?>
			</div>
		</div>
		<?php
	}
	
	public function menu_cart_fragments( $fragments ) {
		$has_cart = is_a( WC()->cart, 'WC_Cart' );
		if ( ! $has_cart ) {
			return $fragments;
		}

		ob_start();
		self::render_menu_cart();
		$menu_cart_html = ob_get_clean();

		if ( ! empty( $menu_cart_html ) ) {
			$fragments['body:not(.elementor-editor-active) div.elementor-element.elementor-widget.elementor-widget-wew-woo-menucart div.woovina-menucart__wrapper'] = $menu_cart_html;
		}

		return $fragments;
	}

	public function maybe_init_cart() {
		$has_cart = is_a( WC()->cart, 'WC_Cart' );

		if ( ! $has_cart ) {
			$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
			WC()->session = new $session_class();
			WC()->session->init();
			WC()->cart = new \WC_Cart();
			WC()->customer = new \WC_Customer( get_current_user_id(), true );
		}
	}
}
