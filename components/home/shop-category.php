<?php if( $featured = wc_get_featured_product_ids() ): ?>

    <section class="section section--large section--gray">
        <div class="container container--large">
            <div class="section-intro section-intro--mb-large">
                <div class="section-intro__prepend">
                    <?php esc_html_e( 'Featured Sale', 'shroom-bros' ); ?>
                </div>

                <h3 data-w-id="fb8d1758-7a1a-5985-0145-4686bbbfb91c" class="section-intro__heading section-intro__heading--slate">
                    <?php esc_html_e( 'Products', 'shroom-bros' ); ?>
                </h3>
            </div>

            <?php $query = new WP_Query( array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'posts_per_page'      => 3,
                'post__in'            => $featured
            ) );

            if ( $query->have_posts() ): ?>
                <div class="shop-products">
                    <div class="shop-grid">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>
                    <?php esc_html_e( 'No featured products available at the moment.', 'shroom-bros' ); ?>
                </p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </section>

<?php endif; ?>