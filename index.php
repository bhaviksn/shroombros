<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shroom_Bros
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<?php shroom_bros_banner( array(
				'variant' => 'banner--blog-single',
				'prepend' => __( 'Shroom Bros', 'shroom-bros' ),
				'heading' => __( 'Blog', 'shroom-bros' ),
				'overlay' => 'banner-overlay--tall'
			) ); ?>
		<?php endif; ?>

		

		<div class="content">

			<div class="container container--m-shrink">

				<div class="row">

					<div class="column column--8">
						<h3 class="blog-title">
							<?php esc_html_e( 'Recent Blog Posts: ', 'shroom-bros' ); ?>
							Page  
							<?php esc_html_e( $paged = (get_query_var('paged')) ? get_query_var('paged') : 1, 'shroom-bros' ); ?>
						</h3>

						<?php while ( have_posts() ) : the_post(); ?>
							<a href="<?php the_permalink(); ?>" class="blog-post blog-post--archive w-inline-block">
								<div class="blog-post__figure blog-post__figure--archive">
									<?php the_post_thumbnail( 
										'blog_thumb', 
										array( 
											'loading' => 'lazy',
											'class'   => 'blog-post__thumbnail blog-post__thumbnail--archive'
										) ); 
									?>
								</div>
								
								<div class="blog-post__content blog-post__content--archive">
									<h5 class="blog-post__heading">
										<?php echo get_the_title(); ?>
									</h5>

									<div class="blog-post__separator"></div>

									<div class="blog-post__excerpt">
										<?php the_excerpt(); ?>
									</div>
								</div>
							</a>
						<?php endwhile; ?>

						<?php the_posts_navigation(); ?>
					</div>

					<div class="column column--4">
						<?php get_sidebar(); ?>
					</div>

				</div>

			</div>

		</div>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>
