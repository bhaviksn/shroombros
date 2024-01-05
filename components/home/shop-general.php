<section class="section section--large">
    <div class="content content--pull">
        <div class="container container--large">
            <div data-duration-in="300" data-duration-out="100" class="tabs w-tabs">
                <div class="list-inline list-inline--large w-tab-menu">
                    <a data-w-tab="Latest" class="list-inline__item w-inline-block w-tab-link w--current">
                        <div class="list-inline__link">
                            <?php esc_html_e( 'Latest Products', 'shroom-bros' ); ?>
                        </div>
                    </a>

                    <a data-w-tab="Best Sellers" class="list-inline__item w-inline-block w-tab-link">
                        <div class="list-inline__link">
                            <?php esc_html_e( 'Best Sellers', 'shroom-bros' ); ?>
                        </div>
                    </a>

                    <a data-w-tab="Sale" class="list-inline__item list-inline__item--last w-inline-block w-tab-link">
                        <div class="list-inline__link">
                            <?php esc_html_e( 'Shroom Sale', 'shroom-bros' ); ?>
                        </div>
                    </a>
                </div>

                <div class="w-tab-content">
                    <div data-w-tab="Latest" class="w-tab-pane w--tab-active">
                        <?php $query = new WP_Query( array(
                            'post_type'      => 'product',
                            'posts_per_page' => 12,
                            'orderby'        => 'publish_date',
                            'meta_query'     => array(
                                'relation' => 'AND',
                                array(
                                    'key'           => '_stock_status',
                                    'value'         => 'instock'
                                ),
                                array(
                                    'key'           => '_backorders',
                                    'value'         => 'no'
                                ),
                            )
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
                                <?php esc_html_e( 'No products available at the moment.', 'shroom-bros' ); ?>
                            </p>
                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>
                    </div>

                    <div data-w-tab="Best Sellers" class="w-tab-pane">
                        <?php $query = new WP_Query( array(
                            'post_type'      => 'product',
                            'posts_per_page' => 12,
                            'meta_key'       => 'total_sales',
                            'orderby'        => 'meta_value_num',
                            'meta_query'     => array(
                                'relation' => 'AND',
                                array(
                                    'key'           => '_stock_status',
                                    'value'         => 'instock'
                                ),
                                array(
                                    'key'           => '_backorders',
                                    'value'         => 'no'
                                ),
                            )
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
                                <?php esc_html_e( 'No best sellers available at the moment.', 'shroom-bros' ); ?>
                            </p>
                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>
                    </div>

                    <div data-w-tab="Sale" class="w-tab-pane">
                    <?php $query = new WP_Query( array(
                            'post_type'      => 'product',
                            'posts_per_page' => 12,
                            'orderby'        => 'last_inventory_date_change',
                            'meta_query'     => array(
                                'relation' => 'AND',
                                array(
                                    'key'           => 'last_inventory_date_change',
                                    'compare'         => 'EXIST'
                                ),
                                array(
                                    'key'           => '_stock_status',
                                    'value'         => 'instock'
                                ),
                                array(
                                    'key'           => '_backorders',
                                    'value'         => 'no'
                                ),
                            )
                        ) );

                        if ( $query->have_posts() ): ?>
                            <div class="shop-products">
                                <div class="shop-grid">
                                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                        <?php 
                                            $post_meta=get_post_meta(get_the_id());
                                            $display_product=false;

                                            if(isset($post_meta['_sale_price'])){
                                                $display_product=true;
                                            }else{
                                                $product = wc_get_product(get_the_id());
                                                $current_products_variations = $product->get_children();
                                            
                                                if($post_meta['shared_variation_inventory'][0]){
                                                                                            
                                                    foreach($current_products_variations as $variation){
                                                            
                                                            $variation_meta=get_post_meta($variation);
                                                            if(isset($variation_meta['_sale_price'])){
                                                                $display_product=true;
                                                                break;
                                                            }
                                                    }
                                                }
                                            }   

                                            if($display_product){         
                                            wc_get_template_part( 'content', 'product' ); 
                                            }
                                        ?>
                                       
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <p>
                                <?php esc_html_e( 'No products on sale available at the moment.', 'shroom-bros' ); ?>
                            </p>
                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>