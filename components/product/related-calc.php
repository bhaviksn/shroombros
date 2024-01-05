<?php

$args = array(
    'posts_per_page'   => 3,
    'orderby'          => 'rand',
    'post_type'        => 'product' ); 

$random_products = get_posts( $args );

// Display the related products.
if( $random_products ): ?>

    <div class="related-products">

        <div class="section-intro section-intro--mb-large">
            <div class="section-intro__prepend">
                <?php esc_html_e( 'Related', 'shroom-bros' ); ?>
            </div>

            <h2 data-w-id="14906375-dcbf-1907-0cba-a31667b67327" class="section-intro__heading heading-psy">
                <?php esc_html_e( 'Products', 'shroom-bros' ); ?>
            </h2>
        </div>

        <div class="shop-products">
            <div class="shop-grid">
                <?php foreach ( $random_products as $related_product ) : 
                    $post_object = get_post( $related_product->ID );
										setup_postdata( $GLOBALS['post'] =& $post_object ); ?>
                    
                    <?php shroom_bros_woocommerce_content_product( true ); ?>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

<?php endif; ?>

<?php wp_reset_query(); ?>