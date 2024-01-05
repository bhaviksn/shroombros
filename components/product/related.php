<?php

global $product;

if ( ! $product ) {
    return;
}

$limit = 3; 
$columns = 3;
$orderby = 'rand';
$order = 'desc';

// Handle the legacy filter which controlled posts per page etc.
$args = apply_filters(
    'woocommerce_upsell_display_args',
    array(
      'posts_per_page' => $limit,
      'orderby'        => $orderby,
      'order'          => $order,
      'columns'        => $columns,
    )
);

wc_set_loop_prop( 'name', 'up-sells' );
wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );

$orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
$order   = apply_filters( 'woocommerce_upsells_order', isset( $args['order'] ) ? $args['order'] : $order );
$limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );

// Get visible upsells then sort them at random, then limit result set.
$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;

// Get other related products if necessary.
if( sizeof( $upsells ) < $limit ) {
    $difference = $limit - sizeof( $upsells );

    // Get visible related products then sort them at random.
    $related_products = array_filter( 
        array_map( 
            'wc_get_product', 
            wc_get_related_products( 
                $product->get_id(), 
                $difference, 
                $product->get_upsell_ids() 
            ) 
        ), 
        'wc_products_array_filter_visible' 
    );

    // Handle orderby.
    $related_products = wc_products_array_orderby( $related_products, 'rand', 'desc' );

    // Merge the two arrays.
    $upsells = array_merge( $upsells, $related_products );
}

// Display the related products.
if( $upsells ): ?>

    <div class="subsection">

        <div class="section-intro section-intro--mb-large">
            <div class="section-intro__prepend">
                <?php esc_html_e( 'Similar', 'shroom-bros' ); ?>
            </div>

            <h2 data-w-id="14906375-dcbf-1907-0cba-a31667b67327" class="section-intro__heading heading-psy">
                <?php esc_html_e( 'Strains', 'shroom-bros' ); ?>
            </h2>
        </div>

        <div class="shop-products">
            <div class="shop-grid">
                <?php foreach ( $upsells as $related_product ) : 
                    $post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object ); ?>
                    
                    <?php shroom_bros_woocommerce_content_product( true ); ?>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

<?php endif; ?>

<?php wp_reset_query(); ?>