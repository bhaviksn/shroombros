<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shroom_Bros
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php shroom_bros_banner( array(
			'prepend'    => get_field( 'heading_custom' ) === true ? get_field( 'heading' ) : '',
			'heading'    => get_field( 'heading_custom' ) === true ? get_field( 'subheading' ) : get_the_title(),
			'overlay'    => 'banner-overlay--tall',
			'background' => get_field( 'background' ) ? get_field( 'background' ) : get_field('banner', 'option')['background'],
		) ); ?>

		<div class="content">
			<div class="container">
				<div class="row">
					<div class="column column--8">
						<article class="article">
							<div class="article-content w-richtext">
								<?php the_content(); ?>
							</div>

							<?php shroom_bros_entry_footer(); ?>

							<?php the_post_navigation(
								array(
									'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'shroom-bros' ) . '</span> <span class="nav-title">%title</span>',
									'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'shroom-bros' ) . '</span> <span class="nav-title">%title</span>',
								)
							); ?>

							<?php if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif; ?>
						</article>
					</div>
					
					<div class="column column--4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>

	<?php endwhile; ?>

<?php get_footer(); ?>
