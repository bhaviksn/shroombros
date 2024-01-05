<?php

/**
 * Template Name: Account
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php shroom_bros_banner( array(
        'variant'     =>  is_user_logged_in() ? 'banner--account' : 'banner--bg-none',
		'content'     =>  'banner-content--inline',
        'prepend'     => __( 'My', 'shroom-bros' ),
        'heading'     => __( 'Account', 'shroom-bros' ),
		'background' => get_field( 'background'),
    ) ); ?>

	<div class="content">
		<div class="container">
			<div class="row">
				<div class="column">
					<article class="article">
						<div class="article-content w-richtext">
							<?php the_content(); ?>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer();