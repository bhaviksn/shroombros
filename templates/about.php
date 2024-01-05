<?php

/**
 * Template Name: About
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php shroom_bros_banner( array(
        'variant'     => 'banner--about',
        'prepend'     => get_field( 'heading' ),
        'heading'     => array( 
            'value'   => get_field( 'subheading' ),
            'variant' => 'banner-heading--xl'
        ),
        'subheading'  => array(
            'value'   => get_field( 'description' ),
            'variant' => 'banner__subtitle--small'
        ),
		'background' => get_field( 'background' ),
    ) ); ?>

    <section class="section section--first section--center section--z-3 section--transparent">

        <div class="container container--small">

            <?php if( $overview = get_field('overview') ): ?>
                <div class="section-header">
                    <h2 class="section-title section-title--m-left">
                        <?php echo $overview['title']; ?>
                    </h2>

                    <p class="section-paragraph">
                        <?php echo $overview['content']; ?>
                    </p>
                </div>
            <?php endif; ?>
            
            <img src="<?php echo get_template_directory_uri(); ?>/images/mushrooms.png" loading="lazy" alt="" class="center-block mb">

            <?php if( $intro = get_field('intro') ): ?>
                <div class="section-intro">
                    <div class="section-intro__prepend">
                        <?php echo $intro['heading']; ?>
                    </div>

                    <h2 class="section-title">
                        <?php echo $intro['subheading']; ?>
                    </h2>
                </div>

                <p class="section-paragraph">
                    <?php echo $intro['content']; ?>
                </p>

                <?php if( $button = $intro['button'] ): ?>
                    <div class="section-footer">
                        <a href="<?php echo $button[ 'url' ]; ?>" class="button button--primary button--rounded button--contact w-button">
                            <?php echo $button[ 'title' ]; ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

	<div class="section section--about section--pull"></div>

<?php endwhile; ?>

<?php get_footer();
