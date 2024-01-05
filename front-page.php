<?php

/**
 * Template Name: Front Page
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'components/home/welcome' ); ?>

    <?php get_template_part( 'components/home/categories' ); ?>

    <?php get_template_part( 'components/home/faq' ); ?>

    <?php get_template_part( 'components/common/car' ); ?>

    <?php get_template_part( 'components/home/shop', 'general' ); ?>

    <?php get_template_part( 'components/home/shop', 'stock' ); ?>

    <?php get_template_part( 'components/home/shop', 'category' ); ?>

    <?php get_template_part( 'components/home/survey' ); ?>

    <?php get_template_part( 'components/common/reviews' ); ?>

    <?php get_template_part( 'components/home/about' ); ?>

<?php endwhile; ?>

<?php get_footer();
