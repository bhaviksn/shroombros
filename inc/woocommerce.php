<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Shroom_Bros
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * WooCommerce Categories
 */ 
function shroom_bros_woocommerce_show_categories() {
	$product_categories = get_terms(array(
		'taxonomy'   => "product_cat",
		'number'     => 4,
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true
	));
	
	$taxonomy = get_query_var( 'taxonomy' );
    $queried_object = get_queried_object();
    $term_id = (int) $queried_object->term_id;
	
	if( $product_categories ) { ?>
		<ul role="list" class="shop-filters">
			<?php foreach( $product_categories as $category ) { ?>
				<li class="shop-filter">
					<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" aria-current="page" class="shop-filter__button <?php echo $category->term_id === $queried_object->term_id ? 'w--current' : ''; ?>">
						<?php echo $category->name; ?> (<?php echo $category->count; ?>)
					</a>
				</li>
			<?php } ?>
		</ul>
	<?php }
}
add_action( 'woocommerce_before_shop_loop', 'shroom_bros_woocommerce_show_categories' );

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function shroom_bros_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'shroom_bros_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function shroom_bros_woocommerce_scripts() {
	wp_enqueue_style( 'shroom-bros-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'shroom-bros-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'shroom_bros_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function shroom_bros_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'shroom_bros_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function shroom_bros_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'shroom_bros_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 */

if ( ! function_exists( 'shroom_bros_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function shroom_bros_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		shroom_bros_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'shroom_bros_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'shroom_bros_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function shroom_bros_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'shroom-bros' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'shroom-bros' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if( !function_exists( 'shroom_bros_woocommerce_wishlist_icon' ) ):
	/**
	 * 
	 */
	function shroom_bros_woocommerce_wishlist_icon( $args = array() ) {
		if ( !class_exists( 'YITH_WCWL' ) ) {
			return;
		}

		$wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>

		<a href="<?php echo esc_url( $wishlist_url ); ?>" class="header-icon header-icon--<?php echo $args['class'] || 'extras'; ?> w-inline-block">
			<img src="<?php echo get_template_directory_uri(); ?>/images/icon-favorites.png" loading="lazy" alt="" class="header-icon__image">
			<span class="header-icon__count product-count"></span>
		</a>	
	<?php }
endif;

if( !function_exists( 'shroom_bros_woocommerce_header_cart' ) ) {
	/**
 	 * 
 	 */
	function shroom_bros_woocommerce_header_cart() {
		global $woocommerce;
		
//		$cartCount = absint( $woocommerce->cart->cart_contents_count ); ?>

		<span class="header-icon header-icon--cart w-inline-block">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/icon-cart.png" loading="lazy" alt="" class="header-icon__image">

<?php /*
				<span class="header-icon__count product-count"><?php echo $cartCount > 0 ? $cartCount : 0; ?></span>
 */ ?>
			</a>

			<div class="header-icon__dropdown">
				<div class="cart-dropdown">
					<?php if( !is_cart() && !is_checkout() ) {
						the_widget( 'WC_Widget_Cart', array(
							'title' => '',
						) ); 						
					} else {
						echo 'You are already on the cart or checkout page. Complete your checkout to continue!';
					} ?>
				</div>
			</div>
		</span>
	<?php }
}

if( !function_exists( 'shroom_bros_woocommerce_content_product' ) ) {
	/**
 	 * 
 	 */
	function shroom_bros_woocommerce_content_product( $dark = false ) {

		global $product;
		global $post;

		// Ensure visibility.
		if ( empty( $product ) || ! $product->is_visible() ) {
			return;
		} ?>

		<div data-w-id="d6f4e586-4cc4-4f5b-cb43-6eaf0d68ba2b" <?php wc_product_class( $dark ? 'product--dark' : '', $product ); ?>>
			<a href="<?php the_permalink(); ?>" class="product-link <?php echo $dark ? 'product-link--dark' : ''; ?> w-inline-block">
				<div class="product-thumb">
					<?php wc_get_template( 'loop/sale-flash.php' ); ?>
					<?php 
						echo '<span class="nostock">' . esc_html__( 'Out of Stock!', 'woocommerce' ) . '</span>'; 
					?>
					<?php 
						$size = 'large';
						$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size ); 

						if ( has_post_thumbnail() ) { 
							$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post ); 

							the_post_thumbnail( $image_size, array( 
								'title' => $props['title'],  
								'alt'   => $props['alt'],  
								'class' => 'product-thumb__image'
							) ); 
						} elseif ( wc_placeholder_img_src() ) { 
							echo wc_placeholder_img( $image_size ); 
						}
					?>
				</div>

				<h2 class="product-name">
					<?php echo get_the_title(); ?>
				</h2>
			</a>

			<div class="product-meta">
				<div class="product-price">
					<?php wc_get_template( 'loop/price.php' ); ?>
				</div>
				
				<div class="product-reviews">
					<?php wc_get_template( 'loop/rating.php' ); ?>
				</div>

				<div class="product-buttons">
                    <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>

					<?php echo apply_filters(
						'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
						sprintf(
							'<a href="%s" data-quantity="%s" class="%s">%s</a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( 1 ),
							esc_attr( 'button button--icon product-icon product-icon--cart w-inline-block' ),
							'<img src="' . get_template_directory_uri() . '/images/icon-cart.svg" loading="lazy" height="16" alt="Add to Cart" class="button--icon__image" height="56" width="186">'
						),
						$product,
					); ?>
				</div>
			</div>
		</div>
	<?php }
}


add_action( 'woocommerce_after_add_to_cart_button', 'shroom_bros_woocommerce_after_add_to_cart_button' );

if( !function_exists( 'shroom_bros_woocommerce_after_add_to_cart_button' ) ):
	/*
	* Content below "Add to cart" Button.
	*/
	function shroom_bros_woocommerce_after_add_to_cart_button() { 
		
		global $product; ?>

		<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>

		<div class="product-cart__inline">
			<span class="product-cart__button product-cart__button--share w-inline-block">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icon-share.png" loading="lazy" alt="" class="product-cart__button__icon">

				<?php shroom_bros_woocommerce_share(); ?>
            </span>
		</div>  

	<?php }
endif;

add_filter( 'woocommerce_checkout_fields' , 'shroom_bros_override_billing_checkout_fields', 20, 1 );

if( !function_exists( 'shroom_bros_override_billing_checkout_fields' ) ){
	/*
	* Content below "Add to cart" Button.
	*/
	function shroom_bros_override_billing_checkout_fields( $fields ) {
		$fields['billing']['billing_first_name']['placeholder'] = 'First Name';
		$fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
		$fields['billing']['billing_company']['placeholder'] = 'Company Name (optional)';
		$fields['billing']['billing_country']['placeholder'] = 'Country / Region';
		$fields['billing']['billing_address_1']['placeholder'] = 'House number and street name';
		$fields['billing']['billing_address_2']['placeholder'] = 'Appartment, Suite, Unit, etc. (optional)';
		$fields['billing']['billing_city']['placeholder'] = 'Town / City';
		$fields['billing']['billing_state']['placeholder'] = 'Province';
		$fields['billing']['billing_postcode']['placeholder'] = 'Postal code';
		$fields['billing']['billing_email']['placeholder'] = 'Email address';
		$fields['order']['order_comments']['placeholder'] = 'Order notes (optional)';

		return $fields;
	}
}

add_action( 'woocommerce_order_details_before_order_table', 'shroom_bros_woocommerce_order_details_before_order_table' );

function shroom_bros_woocommerce_order_details_before_order_table( $order ) { 

		$method = wp_kses_post( $order->get_payment_method_title() ); ?>

	<div class="checkout-confirmation">
				<?php if( $method === 'Interac Email Transfer' ): ?>
						<div class="checkout-confirmation__details">
								<p class="checkout-confirmation__info">
										After placing your order, please send an email money
										transfer to following:
								</p>

								<div>
										<img
										class="checkout-confirmation__icon"
										src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-email.png"
										/>
										<p class="checkout-confirmation__item">
											 Send payment via Interac to: <b><?=get_field('emt_email', 'option')?></b>
										</p>
								</div>
								
								<div>
										<img
										class="checkout-confirmation__icon"
										src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-email.png"
										/>
										<p class="checkout-confirmation__item">
											Your transfer message: <b><?php echo $order->get_order_number(); ?></b>
										</p>
								</div>
								
								<div>
										<img
										class="checkout-confirmation__icon"
										src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-letter-a.png"
										/>

										<p class="checkout-confirmation__item">
											Secret Question: <b><?php echo $order->get_order_number(); ?></b>
										</p>
								</div>
								<div>
										<img
										class="checkout-confirmation__icon"
										src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-letter-a.png"
										/>
										<p class="checkout-confirmation__item">
											Secret Answer: <b>CANADA</b>
										</p>
										
								</div>
								
								<div>
									<p class="checkout-confirmation__item">
										<b>PLEASE MAKE SURE YOU DO NOT USE THE WORDS “SHROOMBROS” OR “SHROOMS” ANYWHERE IN YOUR E TRANSFER.</b>
									</p>
									
									<p class="checkout-confirmation__item">
										Make sure you include your <b>Order Number</b> in the transfer message so we can process your order.
									</p>
								</div>

<!--
								<div>
										<img
										class="checkout-confirmation__icon"
										src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-letter-a.png"
										/>
										<p class="checkout-confirmation__item">
										Secret Answer: <b><?php echo esc_attr( get_the_author_meta( 'emt_secret_answer', get_current_user_id() )); ?></b>
										</p>
								</div>
-->
						</div>
				<?php endif; ?>

				<div class="checkout-confirmation__notice">
					<h3 class="checkout-confirmation__title">
						Thank you for choosing Shroom Bros!
					</h3>
					<p class="checkout-confirmation__description">
						<sup>*</sup> Due to COVID & the high volume of online
						shoppers, Canada Post has been experiencing delays with
						some orders and is no longer guranteeing delivery times so
						please be patient in case order is few days late.
					</p>
				</div>
			</div>
<?php }

/**
 * @snippet       Sort Products By Stock Status - WooCommerce Shop
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_filter( 'woocommerce_get_catalog_ordering_args', 'shroom_bros_first_sort_by_stock_amount', 9999 );

function shroom_bros_first_sort_by_stock_amount( $args ) {
   $args['orderby'] = 'meta_value';
   $args['order'] = 'ASC';
   $args['meta_key'] = '_stock_status';
   return $args;
}

add_filter( 'woocommerce_get_availability', 'shroombros_display_stock_availability', 1, 2);

function shroombros_display_stock_availability( $availability, $_product ) {
	
   global $product;
 
   // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('In stock', 'woocommerce');
    }
 
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
    	$availability['availability'] = __('Sold Out', 'woocommerce');
    }
 
    return $availability;
}

