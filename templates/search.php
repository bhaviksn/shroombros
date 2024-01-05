<?php 

/**
 * Template Name: Search
 */

get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="banner banner--bg-none">
			<div class="container container--small">
				<div class="banner-content">
                    <div class="banner-prepend">
						<?php esc_html_e( 'Search', 'shroom-bros' ); ?>
					</div>

					<h1 class="banner-heading heading-psy">
						<?php esc_html_e( 'What are you looking for?', 'shroom-bros' ); ?>
					</h1>

                    <br /><br />

                    <?php get_search_form(); ?> 
				</div>
			</div>
			
			<img src="images/banner-mask.png" loading="lazy" sizes="95vw" srcset="images/banner-mask-p-500.png 500w, images/banner-mask-p-800.png 800w, images/banner-mask-p-1080.png 1080w, images/banner-mask.png 1365w" alt="" class="banner-overlay">
		</div>

	<?php endwhile; ?>

<?php get_footer();
