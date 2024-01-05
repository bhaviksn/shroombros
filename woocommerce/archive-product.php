<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
 
 get_header(); 
 
 $shop_page_id = wc_get_page_id( 'shop' );
 $shop_page_title = woocommerce_page_title( false );
 $shop_page_heading = get_field( 'heading', $shop_page_id );
 $term = get_queried_object();
 
 $banner_settings = array(
     'variant'     => 'banner--shop',
     'prepend'     => $shop_page_heading ? $shop_page_heading : $shop_page_title,
     'heading'     => get_field( 'subheading', $shop_page_id ),
     'subheading'  => get_field( 'description', $shop_page_id ),
     'overlay'     => 'banner-overlay--tall',
     'background'  => wp_get_attachment_url( get_field('background', $shop_page_id ) ),
 );
 
 if ($header_background = get_field('header_background', $term)) {
     $banner_settings['prepend'] = '';
     $banner_settings['heading'] = $shop_page_title;
     $banner_settings['subheading'] = '';
     $banner_settings['overlay'] = 'banner-overlay--tall';
     $banner_settings['background'] = wp_get_attachment_url( $header_background );
 }
 
 shroom_bros_banner($banner_settings); 
 
 ?>

<div class="content content--pull-md">
    <div class="shop-wrapper">
        <div class="container container--large">

            <?php 
            /**
             * Hook: woocommerce_before_main_content.
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             * @hooked WC_Structured_Data::generate_website_data() - 30
             */
            do_action( 'woocommerce_before_main_content' ); ?>

            <?php if ( woocommerce_product_loop() ) { ?>

                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' ); ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php if ( wc_get_loop_prop( 'total' ) ) { ?>

					<?php while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					} ?>

                <?php } ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php
                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' ); ?>

            <?php } else { ?>

                <?php
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' ); ?>

            <?php } ?>

            <?php
            /**
             * Hook: woocommerce_after_main_content.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' ); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
