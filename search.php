<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Shroom_Bros
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if (have_posts()): ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php printf(esc_html__('Search Results for: %s', 'shroom-bros') , '<span>' . get_search_query() . '</span>'); ?>
				</h1>
			</header><!-- .page-header -->

			

			<h2 class="search-results__title">Products</h2>
			
			<div class="search-results__grid">
			<?php echo the_post(); ?>
							<?php while (have_posts()):
        the_post(); ?>
				<?php if ('product' === get_post_type()): ?>
					<div data-w-id="d6f4e586-4cc4-4f5b-cb43-6eaf0d68ba2b" <?php wc_product_class($dark ? 'product--dark' : '', $product); ?>>
			<a href="<?php the_permalink(); ?>" class="product-link <?php echo $dark ? 'product-link--dark' : ''; ?> w-inline-block">
				<div class="product-thumb">
					<?php wc_get_template('loop/sale-flash.php'); ?>

					<?php
            $size = 'large';
            $image_size = apply_filters('single_product_archive_thumbnail_size', $size);

            if (has_post_thumbnail())
            {
                $props = wc_get_product_attachment_props(get_post_thumbnail_id() , $post);

                the_post_thumbnail($image_size, array(
                    'title' => $props['title'],
                    'alt' => $props['alt'],
                    'class' => 'product-thumb__image'
                ));
            }
            elseif (wc_placeholder_img_src())
            {
                echo wc_placeholder_img($image_size);
            }
?>
				</div>

				<h2 class="product-name">
					<?php echo get_the_title(); ?>
				</h2>
			</a>

			<div class="product-meta">
				<div class="product-price">
					<?php wc_get_template('loop/price.php'); ?>
				</div>
				
				<div class="product-reviews">
					<?php wc_get_template('loop/rating.php'); ?>
				</div>

				<div class="product-buttons">
					<a href="#" class="button button--icon product-icon w-inline-block">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icon-favorite.svg" loading="lazy" height="20" alt="Add to Favorites" class="button--icon__image">
					</a>

					<?php echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" data-quantity="%s" class="%s">%s</a>', esc_url($product->add_to_cart_url()) , esc_attr(1) , esc_attr('button button--icon product-icon w-inline-block') , '<img src="' . get_template_directory_uri() . '/images/icon-cart.svg" loading="lazy" height="16" alt="Add to Cart" class="button--icon__image" height="56" width="186">') , $product,); ?>
				</div>
			</div>
		</div>
				<?php
        endif; ?>
							

							
						<?php
    endwhile; ?>
						</div>

						<h2 class="search-results__title">Blog Posts</h2>

						<?php while (have_posts()):
        the_post(); ?>
			<?php if ('post' === get_post_type()): ?>		
			<a href="<?php the_permalink(); ?>" class="blog-post blog-post--archive w-inline-block">
								<div class="blog-post__figure blog-post__figure--archive">
									<?php the_post_thumbnail('blog_thumb', array(
                'loading' => 'lazy',
                'class' => 'blog-post__thumbnail blog-post__thumbnail--archive'
            ));
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
							
							<?php
        endif; ?>
							
							<?php
    endwhile; ?>
			
			<?php
    /* Start the Loop */
    // while ( have_posts() ) :
    // 	the_post();
    

    // 	/**
    // 	 * Run the loop for the search to output the results.
    // 	 * If you want to overload this in a child theme then include a file
    // 	 * called content-search.php and that will be used instead.
    // 	 */
    // 	get_template_part( 'template-parts/content', 'search' );
    // endwhile;
    the_posts_navigation();

else:

    get_template_part('template-parts/content', 'none');

endif;
?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

