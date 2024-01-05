<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Shroom_Bros
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses shroom_bros_header_style()
 */
function shroom_bros_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'shroom_bros_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'shroom_bros_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'shroom_bros_custom_header_setup' );

if ( ! function_exists( 'shroom_bros_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see shroom_bros_custom_header_setup().
	 */
	function shroom_bros_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;


add_filter( 'get_custom_logo', 'shroom_bros_logo_class' );

if ( ! function_exists( 'shroom_bros_logo_class' ) ) :
	function shroom_bros_logo_class( $html ) {
		$html = str_replace( 'custom-logo-link', 'header-logo w-inline-block w--current', $html );
		$html = str_replace( 'custom-logo', 'header-logo__image', $html );

		return $html;
	}
endif;


add_filter( 'nav_menu_link_attributes', 'shroom_bros_menu_add_class', 10, 3 );

if ( ! function_exists( 'shroom_bros_menu_add_class' ) ) :
	function shroom_bros_menu_add_class( $atts, $item, $args ) {
		if( $args->menu === 'header' ) {
			$atts['class'] = 'header-navbar__link w-nav-link';
		}

		if( $args->menu === 'footer' ) {
			$atts['class'] = 'footer-links__link';
		}

		return $atts;
	}
endif;

add_filter('nav_menu_css_class', 'shroom_bros_menu_add_li_class', 1, 3);

if( !function_exists( 'shroom_bros_menu_add_li_class' ) ) :
	function shroom_bros_menu_add_li_class($classes, $item, $args) {
		if( $args->menu === 'footer' ) {
			$classes[] = 'footer-links__item';
		}

		return $classes;
	}
endif;
