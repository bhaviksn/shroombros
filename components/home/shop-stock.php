<section class="section section--dark-bg section--large section--boat">

    <?php get_template_part( 'components/common/boat' ); ?>

    <div class="container container--large">
        <div class="section-intro section-intro--mb-large">
            <div class="section-intro__prepend">
                <?php esc_html_e( 'In Stock', 'shroom-bros' ); ?>
            </div>
            
            <h3 data-w-id="68505c12-2985-0c90-518e-cca88e59b4d6" class="section-intro__heading heading-psy">
                <?php esc_html_e( 'Products', 'shroom-bros' ); ?>
            </h3>
        </div>

        <?php $query = new WP_Query( array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => '_stock_status',
                    'value' => 'instock'
                ),
                array(
                    'key' => '_backorders',
                    'value' => 'no'
                ),
            )
        ) );

        if ( $query->have_posts() ): ?>
            <div class="shop-products">
                <div class="shop-grid">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <?php shroom_bros_woocommerce_content_product( true ); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <p>
                <?php esc_html_e( 'No products in stock at the moment.', 'shroom-bros' ); ?>
            </p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
    
</section>