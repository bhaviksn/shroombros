<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Shroom_Bros
 */

get_header(); ?>

	<?php 
    
    $banner = get_field( 'banner', 'option' );
    
    shroom_bros_banner( array(
        'prepend'     => __( 'Error', 'shroom-bros' ),
        'background' => $banner['background_404'],
    ) ); ?>

	<div class="content">
		<div class="container container--small">
			<div class="row">
				<div class="column">
					<article class="article">
						<div class="article-content w-richtext">
							<p class='notice-404__message'>
								<span class="notice-404__oops">Oops</span>
								
								<?php esc_html_e( 'We can’t seem to find a page you are looking for', 'shroom-bros' ); ?>
							</p>

							<div class="notice-404__back"><span>Back to</span> <a class="notice-404__link" href="/">home</a></div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>

<?php get_footer();