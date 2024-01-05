<?php

/**
 * Template Name: Contact
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php shroom_bros_banner( array(
		'variant'   => 'banner--contact',
		'container' => 'container--default',
		'content'   => 'banner-content--left',
		'prepend'   => get_field( 'heading' ),
		'heading'   => array(
			'variant' => 'banner-heading--small',
			'value'   => get_field( 'subheading' )
		),
		'subheading' => array(
			'variant' => 'banner__subtitle--small',
			'value'   => get_field( 'description' )
		),
		'overlay'   => 'banner-overlay--tall',
		'background' => get_field( 'background' ),
	) ); ?>

	<?php get_template_part( 'components/contact/methods' ); ?>

	<?php get_template_part( 'components/contact/form' ); ?>

<?php endwhile; ?>

<?php get_footer();
