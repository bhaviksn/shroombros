<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

	<article id="comment-<?php comment_ID(); ?>" class="product-review" data-w-id="1c275bc8-4c6f-71b6-9f0a-aaea0f62a419">
		<div class="product-review__header">
			<div class="product-review__avatar">
				<?php
				/**
				 * The woocommerce_review_before hook
				 *
				 * @hooked woocommerce_review_display_gravatar - 10
				 */
				do_action( 'woocommerce_review_before', $comment );
				?>
			</div>

			<div class="product-review__meta">
				<div class="product-review__rating">
					<?php /**
					 * The woocommerce_review_before_comment_meta hook.
					 *
					 * @hooked woocommerce_review_display_rating - 10
					 */
					do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>
				</div>

				<h3 class="product-review__name">
					<?php do_action( 'woocommerce_review_meta', $comment ); ?>
				</h3>
			</div>
		</div>

		<div class="product-review__main">
			<div class="product-review__left">
				<div class="product-review__separator"></div>
				
				<div class="product-review__content">
					<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
					<?php do_action( 'woocommerce_review_comment_text', $comment ); ?>
					<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
				</div>
			</div>

			<div class="product-review__right">
				<div class="media">
					<img src="<?php echo get_template_directory_uri(); ?>/images/review-icon-1.png" loading="lazy" alt="" class="media-image media-image--small">
					
					<div class="media-content media-content--dark">
						<div class="media-title">
							<?php esc_html_e( 'Relax', 'shroom-bros' ); ?>
						</div>
					</div>
				</div>

				<div class="media"><img src="<?php echo get_template_directory_uri(); ?>/images/review-icon-3.png" loading="lazy" alt="" class="media-image media-image--small">
					<div class="media-content media-content--dark">
						<div class="media-title">
							<?php esc_html_e( 'Energy', 'shroom-bros' ); ?>
						</div>
					</div>
				</div>

				<div class="media">
					<img src="<?php echo get_template_directory_uri(); ?>/images/review-icon-2.png" loading="lazy" alt="" class="media-image media-image--small">

					<div class="media-content media-content--dark">
						<div class="media-title">
							<?php esc_html_e( 'Spiritual', 'shroom-bros' ); ?>
						</div>
					</div>
				</div>

				<div class="media">
					<img src="<?php echo get_template_directory_uri(); ?>/images/review-icon-4.png" loading="lazy" alt="" class="media-image media-image--small">

					<div class="media-content media-content--dark">
						<div class="media-title">
							<?php esc_html_e( 'Sleep', 'shroom-bros' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="product-review__footer">
			<?php /*

			<div class="product-review__button">
				<a href="#" class="button button--link button--small w-inline-block">
					<div class="button__icon">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icon-review_1.png" loading="lazy" alt="">
					</div>
					
					<div class="button__label">Full Review</div>
				</a>
			</div>

			<div class="product-review__button">
				<a href="#" class="button button--link button--small w-inline-block">
					<div class="button__icon">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icon-helpful.png" loading="lazy" alt="">
					</div>

					<div class="button__label">
						Helpful
					</div>
				</a>
			</div>

			*/ ?>

			<div class="product-review__button">
				<a href="<?php echo home_url( 'contact-us' ); ?>" class="button button--link button--small button-link--primary w-inline-block">
					<div class="button__label">
						<?php esc_html_e( 'Report', 'shroom-bros' ); ?>
					</div>
				</a>
			</div>
		</div>
	</article>

