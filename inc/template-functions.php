<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Shroom_Bros
 */

/**
 * Adds custom classes to the array of main classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function shroom_bros_main_classes() {
	$classes = array('main');

	if ( 
		is_product() || 
		is_page_template( array(
			'templates/contact.php' 
		) )
	) {
		$classes[] = 'main--tight';
	}

	if ( 
		is_product() || 
		is_archive() || 
		is_singular( array( 'post' ) ) || 
		is_404() || 
		is_page_template( array(
			'templates/account.php',
			'templates/search.php'
		) ) ||
		is_cart() || 
		is_account_page() || 
		is_home()
	) {
		$classes[] = 'main--boat';
	}

	return implode( ' ', $classes );
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function shroom_bros_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	
	// Adds a class for the account page.
	if( is_account_page() && !is_user_logged_in() ) {
		$classes[] = 'body--account';
	}
    
	return $classes;
}
add_filter( 'body_class', 'shroom_bros_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function shroom_bros_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'shroom_bros_pingback_header' );

if( !function_exists( 'wf_attributes' ) ) {
	/**
	 * Page identifiers used for custom animations.
	 */
	function wf_attributes() {
		if( is_front_page() ) {
			echo 'data-wf-page="60bf62f61f258830c1d12c40"';
		} elseif( function_exists( 'is_product' ) && is_product() ) {
			echo 'data-wf-page="60c1d78672330289fd5d36a8"';
		} elseif( function_exists( 'is_shop' ) && is_shop() ) {
			echo 'data-wf-page="60bf96a8a0669ce893a9f2ff"';
		}
	}
}






if ( ! function_exists( 'shroom_bros_woocommerce_share' ) ) {
	/**
	 * Echoes the share buttons div
	 */
	function shroom_bros_woocommerce_share() {
		global $post;

		$share_link_url        = esc_url( get_the_permalink() );
		$share_image_url       = esc_url( get_the_post_thumbnail_url( $post->ID, apply_filters( 'single_product_archive_thumbnail_size', 'large' ) ) );
		$share_link_title      = esc_attr( get_the_title() );
		$share_summary         = esc_html( get_the_excerpt() ); ?>

		<div class="product-cart__button__dropdown">
			<?php foreach (array( 'facebook', 'twitter', 'pinterest', 'googleplus', 'linkedin' ) as $provider) {
				switch ($provider) {
					case 'facebook':
						$fb_url = esc_url( '//www.facebook.com/sharer.php?u=' . $share_link_url ); ?> 
							<a target="_blank" class="icon facebook" href="<?php echo $fb_url; ?>" title="<?php esc_html_e( 'Facebook', 'shroom-bros' ) ?>" data-label="Facebook" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow">
								<?php esc_html_e( 'Facebook', 'shroom-bros' ); ?>
							</a>
						<?php break;
					case 'twitter':
						$twitter_url = '//twitter.com/share?url=' . $share_link_url . '&amp;text=' . $share_link_title; ?>
							<a target="_blank" class="icon twitter" href="<?php echo esc_url( $twitter_url ); ?>" title="<?php esc_html_e( 'Twitter', 'shroom-bros' ) ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow">
								<?php esc_html_e( 'Twitter', 'shroom-bros' ); ?>
							</a>
						<?php break;
					case 'pinterest':
						$pinterest_url = '//pinterest.com/pin/create/button/?url=' . $share_link_url . '&amp;description=' . $share_summary . '&amp;media=' . $share_image_url; ?>
							<a target="_blank" class="icon pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" title="<?php esc_html_e( 'Pinterest', 'shroom-bros' ) ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow">
								<?php esc_html_e( 'Pinterest', 'shroom-bros' ); ?>
							</a>
						<?php break;	
					default:
						break;
				}
			} ?>
		</div>
	<?php }
}