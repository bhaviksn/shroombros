<?php
/**
 * Shroom Bros functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shroom_Bros
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.2' );
}

if ( ! function_exists( 'shroom_bros_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shroom_bros_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shroom Bros, use a find and replace
		 * to change 'shroom-bros' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shroom-bros', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header' => esc_html__( 'Header', 'shroom-bros' ),
				'footer' => esc_html__( 'Footer', 'shroom-bros' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'shroom_bros_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Add support for additional image sizes.
		 */		
		add_image_size( 'blog_thumb', 430, 242, true );
	}
endif;
add_action( 'after_setup_theme', 'shroom_bros_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shroom_bros_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shroom_bros_content_width', 640 );
}
add_action( 'after_setup_theme', 'shroom_bros_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shroom_bros_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'shroom-bros' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'shroom-bros' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'shroom_bros_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shroom_bros_scripts() {
    global $wp_query;

	wp_enqueue_style( 'shroom-bros-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory(). '/style.css') );
	wp_style_add_data( 'shroom-bros-style', 'rtl', 'replace' );
	
	wp_enqueue_style( 'shroom-bros-car', get_template_directory_uri().'/overrides.css', array(), filemtime(get_template_directory(). '/overrides.css') );
	
	if ( is_front_page() ) {
	
		wp_enqueue_script( 'shroom-bros-car-js', get_template_directory_uri().'/car/js/car.js', array('jquery'), filemtime(get_template_directory(). '/car/js/car.js') );
		
		wp_enqueue_script( 'shroom-bros-cat-js', get_template_directory_uri().'/js/category-animation.js', array('jquery'), filemtime(get_template_directory(). '/js/category-animation.js') );
		
		wp_enqueue_script( 'shroom-bros-lottie-js', get_template_directory_uri().'/js/lottie-animation.js', array('jquery', 'lottie-svg-min'), filemtime(get_template_directory(). '/js/lottie-animation.js') );
	
	}
		
	if ( is_checkout() || is_cart() ) {
		wp_enqueue_script( 'shroom-bros-lottie-plane-js', get_template_directory_uri().'/js/plane-animation.js', array('jquery'), filemtime(get_template_directory(). '/js/plane-animation.js') );
	}	
	
	if (is_order_received_page()) {
		wp_enqueue_script( 'shroom-bros-confetti-js', get_template_directory_uri().'/js/confetti.js', array('confetti-canvas'), filemtime(get_template_directory(). '/js/confetti.js') );
		wp_enqueue_script( 'shroom-bros-order-recieved-js', get_template_directory_uri().'/js/order-recieved-audio.js', array('confetti-canvas'), filemtime(get_template_directory(). '/js/order-recieved-audio.js') );
	
		wp_enqueue_script( 'confetti-canvas', get_template_directory_uri().'/js/confetti-browser.js', array(), filemtime(get_template_directory(). '/js/confetti-browser.js') );
	}
		
	wp_enqueue_script( 'shroom-bros-lottie-tree-js', get_template_directory_uri().'/js/tree-animation.js', array('jquery'), filemtime(get_template_directory(). '/js/tree-animation.js') );
		
	wp_enqueue_script( 'shroom-bros-calculator', get_template_directory_uri().'/js/shroom-dose-calculator.js', array('jquery'), filemtime(get_template_directory(). '/js/shroom-dose-calculator.js') );
	
	if (is_product()) {
		wp_enqueue_script( 'sb_shipping_counter', get_template_directory_uri().'/js/amazon-counter.js', array('jquery'), filemtime(get_template_directory(). '/js/amazon-counter.js') );
	  wp_localize_script( 'sb_shipping_counter', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	}
	
	wp_enqueue_script( 'lottie-svg-min', 'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.5.9/lottie.min.js');
	//wp_enqueue_script( 'lottie-min', 'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.14/lottie_svg.min.js');
	
	wp_enqueue_script( 'shroom-bros-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'shroom-bros-webflow', get_template_directory_uri() . '/js/webflow.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'shroom-bros-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery', 'woocommerce' ), filemtime( get_template_directory(). '/js/custom.js'), true );
    wp_localize_script(
        'shroom-bros-custom',
        'globals',
        array(
            'query'                 => wp_json_encode( $wp_query->query_vars ), // everything about your loop is here.
            'current_page'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1, // current page number.
            'max_page'              => $wp_query->max_num_pages, // max page number.
            'ajaxurl'               => admin_url( 'admin-ajax.php' ), // WordPress AJAX.
            'paged'                 => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
            'spinner' => get_stylesheet_directory_uri() . '/images/spinner.gif'
        )
    );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shroom_bros_scripts' );

function shroombros_admin_style() {
  wp_enqueue_style('shroombros-admin-styles', get_template_directory_uri().'/admin.css',array(), filemtime(get_template_directory(). '/admin.css'));
 
}
add_action('admin_enqueue_scripts', 'shroombros_admin_style');

/**
 * Implement the Options page.
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/**
 * Infinite scroll AJAX handler.
 */

function shroom_bros_load_more() {
    global $wpdb;
    
    $result = array();

    if ( isset( $_POST['base_scrole_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['base_scrole_nonce'], 'infinite_nonce_action' ) ) ) ) {
            print 'Sorry, your nonce did not verify.';
            exit;
    }

    if ( isset( $_POST['wp_query'] ) ) {
        // Build query.
				$result['intact'] = 'Query Running';
        $wp_query = json_decode( sanitize_meta( '', wp_unslash( $_POST['wp_query'] ), '' ), true );
				$result['query'] = sanitize_meta( '', wp_unslash( $_POST['wp_query'] ), '' );
    }
     
    // Get posts per page.
    $pages_post = $wp_query['posts_per_page'];
    if ( ! empty($pages_post ) ) {
        // Also have to set posts_per_page, otherwise offset is ignored.
        $args['posts_per_page'] = sanitize_text_field( wp_unslash( $pages_post ) );
         

    }
    if ( isset( $_POST['current_page'] ) ) {
        $wp_query['paged'] = sanitize_text_field( wp_unslash( $_POST['current_page'] ) );

         
    }

    $ajax_query = new WP_Query( $wp_query );
    
    $paged = 1;
    if ( isset( $_POST['paged'] ) ) {
        $paged = sanitize_text_field( wp_unslash( $_POST['paged'] ) );
    }

    if ( $ajax_query->have_posts() ) {
        $count_results = $ajax_query->found_posts;

        $results_html = '';
        ob_start();

        while ( $ajax_query->have_posts() ) {
            $ajax_query->the_post();
            wc_get_template_part( 'content', 'product' );
        }
          woocommerce_pagination();
        // "Save" results' HTML as variable.
        //echo wp_kses_post( ob_get_clean() );
        $result['products'] = wp_kses_post( ob_get_clean() );
				
        ob_start();
        woocommerce_pagination();
        //echo wp_kses_post( ob_get_clean() );
        //die();
        $result['pagination'] = wp_kses_post( ob_get_clean() );
    }
		
		wp_send_json( $result );
    die();

}

add_action( 'wp_ajax_shroom_bros_load_more', 'shroom_bros_load_more' );
add_action( 'wp_ajax_nopriv_shroom_bros_load_more', 'shroom_bros_load_more' );


function json_mime_types($mimes) {
    $mimes['json'] = 'application/json';
    return $mimes;
   }
add_filter('upload_mimes', 'json_mime_types');

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
   }
add_filter('upload_mimes', 'cc_mime_types');

define( 'ALLOW_UNFILTERED_UPLOADS', true );

/**
* sb_shipping_counter
* @param none
* @return shipping_counter
* @author Joshua R Davies <team@annexcore.com>
* @since 10/20/21
*/
if ( !function_exists( 'sb_shipping_counter' ) ) {
	function sb_shipping_counter() {
		global $woocommerce;
		$result = array();
		$wc_cart_total = $woocommerce->cart->total;
		//$wc_cart_total = floatval( preg_replace( '#[^\d.]#', '', $wc_cart_total ) );
		$shipping_counter = '';
		$today = date('Y-m-d H:i:s');
		$today_at_6 = date('Y-m-d H:i:s', strtotime(date('Y-m-d').' 18:00:00'));
		$tomorrow_at_6 = date('Y-m-d H:i:s', strtotime(date('Y-m-d').' 18:00:00 +1 day'));
		
		$free = 'Free';
		
		//return $today_at_6;
		if ($today > $today_at_6 ) {
		
			$date1 = date_create($today);
			$date2 = date_create($tomorrow_at_6);
			
			$interval = date_diff($date1, $date2);
			if ($interval->format('%H') > 0){
				$shipping_counter = 'Delivery Tomorrow if ordered in the next <div class="pink">'.$interval->format('%H').'</div> hours and <div class="pink">'.$interval->format('%i').'</div> mins';
			} else {
				$shipping_counter = 'Delivery Tomorrow if ordered in the next <div class="pink">'.$interval->format('%i').'</div> mins';
			}	
			// Check if the user gets free shipping.	
			if ($wc_cart_total > 150) {
				$shipping_counter = $free . ' ' . $shipping_counter;
			}
			//$shipping_counter = '';
			$result['text'] = $shipping_counter;
			$result = json_encode($result);
			echo $result;
			die();
		}
		
		$date1 = date_create($today);
		$date2 = date_create($today_at_6);
		
		$interval = date_diff($date1, $date2);
		if ($interval->format('%H') > 0){
			$shipping_counter = 'Delivery Today if ordered in the next <div class="pink">'.$interval->format('%H').'</div> hours and <div class="pink">'.$interval->format('%i').'</div> mins';
		} else {
			$shipping_counter = 'Delivery Today if ordered in the next <div class="pink">'.$interval->format('%i').'</div> mins';
		}
		// Check if the user gets free shipping.	
		if ($wc_cart_total > 150) {
			$shipping_counter = $free . ' ' . $shipping_counter;
		}
		$result['cart_total'] = $wc_cart_total;
		$result['text'] = $shipping_counter;
		$result = json_encode($result);
		echo $result;
		die();
	}

add_action("wp_ajax_sb_shipping_counter", "sb_shipping_counter");
add_action("wp_ajax_nopriv_sb_shipping_counter", "sb_shipping_counter");
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Dynamic blocks.
 */
require get_template_directory() . '/inc/dynamic-blocks.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


add_filter('posts_clauses', 'order_by_stock_status');
function order_by_stock_status($posts_clauses) {
    global $wpdb;
    // only change query on WooCommerce loops
    if (is_woocommerce() && (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy())) {
        $posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
        $posts_clauses['orderby'] = " istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
        $posts_clauses['where'] = " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
    }
    return $posts_clauses;
}

function getTagList(){
	echo "<section  class='widget widget_meta'>";
		echo "<h2 class='widget-title'>Blog Tags</h2>";
		echo "<ul id=\"Genre-List\">";
		
			$tags = get_tags();
			foreach ( $tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );
		
		echo "<li>";
		echo "<a href='".$tag_link."' title='".$tag->name."' class='". $tag->slug."'>".$tag->name."</a>";
		echo "</li>";
		
			}
		
		echo "</ul>";
	echo "</section>";
}
add_shortcode('tagsList', 'getTagList');





add_action( 'pre_post_update', 'shroombros_inventory_check',10,2);

function shroombros_inventory_check($post_ID,$data){
    
    
	if($_POST['_stock'] !== $_POST['_original_stock']){
		update_post_meta($post_ID,'last_inventory_date_change',date('Y-m-d H:i:s'));
	}

	if(!empty($_POST['wsvi_inv_quantity'])){
		$wsvi_inventory = get_post_meta($post_ID, 'wsvi_inventory', true); 
		$current_inventory=false;
		foreach($wsvi_inventory as $index => $group_data){
					

					if(!empty($_POST['wsvi_inv_quantity'][$index])){
						
						if($_POST['wsvi_inv_quantity'][$index] !== $group_data['quantity']){
							$current_inventory=true;
							update_post_meta($post_ID,'last_inventory_date_change',date('Y-m-d H:i:s'));
						}
					}
		}
		if(!$current_inventory){
			update_post_meta($post_ID,'last_inventory_date_change',date('Y-m-d H:i:s'));
		}
		
	}
}


add_action( 'admin_init', 'shroom_shared_ajax_inventory', 10, 2);

function shroom_shared_ajax_inventory() {
    if( defined('DOING_AJAX') && DOING_AJAX && current_user_can('manage_options') ) {

        if ( isset($_POST['shared_variation_inventory']) && isset($_POST['product_id']) ) {

			

			parse_str( urldecode( html_entity_decode( wp_kses( $_POST['quantities'], 'strip' ) ) ), $quantities );
			$quantities = reset( $quantities );
			$current_inventory = get_post_meta($_POST['product_id'], 'wsvi_inventory', true);

			if(!empty($current_inventory)){
				foreach($current_inventory as $index => $group_data){
					

					if(!empty($quantities[$index])){
						
						if($quantities[$index] !== $group_data['quantity']){
							update_post_meta($_POST['product_id'],'last_inventory_date_change',date('Y-m-d H:i:s'));
						}
					}
				}
			}else{
				update_post_meta($_POST['product_id'],'last_inventory_date_change',date('Y-m-d H:i:s'));
			}
			

			
		}
    }
}

add_filter( 'woocommerce_get_catalog_ordering_args', 'shroombros_postmeta_orderby_args',9999 ,3);

function shroombros_postmeta_orderby_args( $args_sort_shroombros ,$orderby, $order ) {
	

	$shroombros_orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) :
	apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

	switch( $shroombros_orderby_value ) {
	  case 'latest_inventory_added':
		
		$args_sort_shroombros['order'] = 'DESC';
		
		$args_sort_shroombros['meta_key'] = 'last_inventory_date_change';
		
		break;
		 
	}


		
	return $args_sort_shroombros;
   }
   



add_filter( 'woocommerce_default_catalog_orderby_options', 'shroombros_orderby_args' );
add_filter( 'woocommerce_catalog_orderby', 'shroombros_orderby_args' );

function shroombros_orderby_args( $sortby ) {
	$sortby['latest_inventory_added'] = __( 'Sort by Latest Inventory Added', 'woocommerce' );
	
	return $sortby;
}



if ( defined( 'WP_CLI' ) && WP_CLI ) {
	
	function update_inventory_date_change(){

		$products = wc_get_products( array( 'status' => 'publish', 'limit' => -1 ) );
		foreach($products as $product){
			$check_if_exist = get_post_meta($product->get_id(), 'last_inventory_date_change', true);
			if(empty($check_if_exist)){
				update_post_meta($product->get_id(),'last_inventory_date_change',date('Y-m-d H:i:s'));
			}
		}

	}
	WP_CLI::add_command( 'inventory_date_change', 'update_inventory_date_change' );
}

// Show price under variation price dropdown even if all variations are the same price
add_filter( 'woocommerce_show_variation_price', function() { return TRUE;} );

function mobile_popup_options(){
    global $popup_buttons;
    $popup_buttons = get_field('popup_buttons', 'option');
}

// Define it immediately after `init` in a high priority.
add_action('init', 'mobile_popup_options', 1, 1);