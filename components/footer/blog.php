<?php 

$footer = get_field( 'footer', 'option' );
$blog = $footer['blog'];

$limit = 12;
$query = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => $limit
) ); 

?>

<?php if( $query->have_posts() ): $index = 1; ?>

	<div class="footer-blog">
		<div class="container container--large">
			<div class="section-intro">
				<div class="section-intro__prepend">
					<?php echo $blog[ 'heading' ]; ?>
				</div>

				<h5 data-w-id="66e75ba3-0a3f-4551-e351-934656b54a96" class="section-intro__heading section-intro__heading--large heading-psy">
					<?php echo $blog[ 'subheading' ]; ?>
				</h5>
			</div>

			<div data-animation="slide" data-easing="ease-in-sine" data-nav-spacing="15" data-duration="500" data-infinite="1" data-w-id="a2402182-5a86-e99b-b6e7-cf363b79c408" class="slider slider--blog w-slider">
				<div class="slider-mask w-slider-mask">
					<div class="slider-slide slider-slide--blog w-slide">
						<div class="slider-slide__grid">
							<?php while( $query->have_posts() ): $query->the_post(); ?>

								<a href="<?php the_permalink(); ?>" class="blog-post w-inline-block">
									<?php the_post_thumbnail( 
										'blog_thumb', 
										array( 
											'loading' => 'lazy',
											'class'   => 'blog-post__thumbnail'
										) ); 
									?>

									<div class="blog-post__content">
										<h5 class="blog-post__heading">
											<?php echo get_the_title(); ?>
										</h5>

										<div class="blog-post__separator"></div>
										
										<div class="blog-post__excerpt">
											<?php echo get_the_excerpt(); ?>
										</div>
									</div>
								</a>

								<?php if( $index % 3 === 0 && $index !== $limit ): ?>
										</div>
									</div>

									<div class="slider-slide slider-slide--blog w-slide">
										<div class="slider-slide__grid">
								<?php endif; ?>

							<?php $index++; endwhile; ?>
						</div>
					</div>

					<?php wp_reset_postdata(); ?>
				</div>

				<div class="slider-arrow slider-arrow--left w-slider-arrow-left">
					<img src="<?php echo get_template_directory_uri(); ?>/images/slider-arrow__left.png" loading="lazy" alt="Left Slider Arrow" class="footer-blog__arrow__image">
				</div>

				<div class="slider-arrow slider-arrow--right w-slider-arrow-right">
					<img src="<?php echo get_template_directory_uri(); ?>/images/slider-arrow__right.png" loading="lazy" alt="Right Slider Arrow" class="footer-blog__arrow__image">
				</div>

				<div class="slider-dots w-slider-nav"></div>
			</div>
		</div>
	</div>

<?php endif; ?>