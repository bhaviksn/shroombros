<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shroom_Bros
 */

get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>

		<?php shroom_bros_banner( array(
			'prepend' => get_field( 'heading_custom' ) === true ? get_field( 'heading' ) : '',
			'heading' => get_field( 'heading_custom' ) === true ? get_field( 'subheading' ) : get_the_title(),
			'background' => get_field( 'background' ) ? get_field( 'background' ) : get_field('banner', 'option')['background'],
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
