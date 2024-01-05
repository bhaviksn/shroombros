<?php 

global $post; 
global $product;

$overview = get_field( 'overview' );

if( $terms = get_the_terms( $post->ID, 'product_cat' ) ) {
    $category = $terms[0]->name;
} else {
    $category = '';
} ?>

<div class="banner banner--product">

    <div class="container">

        <?php /**
         * Hook: woocommerce_before_single_product.
         *
         * @hooked woocommerce_output_all_notices - 10
         */
        do_action( 'woocommerce_before_single_product' ); ?>

        <div class="row row-m--reverse">

            <div class="column">

                <div class="product-header">

                    <h1 data-w-id="26b40c7e-91ef-54f1-c960-fbe08a5b0bcb" style="opacity:0" class="product-header__title">
                        <span class="product-header__name">
                            <?php echo isset( $overview[ 'heading' ] ) && $overview[ 'heading' ] !== '' ? $overview[ 'heading' ] : get_the_title(); ?>
                        </span> 
                        
                        <?php echo isset( $overview[ 'subheading' ] ) && $overview[ 'subheading' ] !== '' ? $overview[ 'subheading' ] : $category; ?>
                    </h1>

                    <div data-w-id="800186bd-d5b7-7aa1-d0b9-8d40c9f396d3" style="opacity:0" class="product-header__meta">
                        <div class="product-header__wrapper">
                            <div class="product-header__price">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            
                            <div class="product-header__payment">
                                <img class="product-header__transfer" src="/wp-content/plugins/woocommerce-email-money-transfer-gateway/images/e-transfer.jpg" />
                                <img class="product-header__crypto" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-monero.svg" />
                                <img class="product-header__crypto" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-ethereum.svg" />
                                <img class="product-header__crypto" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-bitcoin.svg" />
                                <img class="product-header__crypto" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-doge.svg" />
                            </div>
                        </div>

                        <?php if ( !$product->is_in_stock() ): ?>
                            <div data-w-id="a0dd2399-42cc-ac23-45d6-4a3f67ad85a1" style="opacity:0" class="product-header__badges">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/badge-soldout.png" loading="lazy" alt="" class="product-header__badge">
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if( isset( $overview[ 'intro' ] ) && $overview[ 'intro' ] !== '' ): ?>
                        <div data-w-id="4f05dd65-236a-d9ff-1cff-2895e90c7b37" style="opacity:0" class="product-header__subtitle">
                            <?php echo $overview[ 'intro' ]; ?>
                        </div>
                    <?php endif; ?>
                
                    <?php if( $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ): ?>
                        <div data-w-id="b9e9f1a4-7674-9992-ca80-bc81012c38bf" style="opacity:0" class="product-header__excerpt">
                            <?php echo $short_description; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div data-w-id="09900999-b5a2-cb5a-d552-93b51acffb8b" style="opacity:0" class="product-cart w-form">
	                <div class="shipping-counter">
		                <p></p>
	                </div>
                    <?php if( $product->is_type( 'simple' ) ): ?>
                        <div class="woocommerce-variation single_variation">
                            <div class="woocommerce-variation-price">
                                <span class="price">
                                    <span class="woocommerce-Price-amount amount">
                                        <?php echo $product->get_price_html(); ?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
            </div>

            <div class="column">
                <div data-w-id="d84bcd2b-70fd-ca11-2219-bafe6e2489aa" style="opacity:0" class="product-header__stage">
                    <?php 
						$size = 'large';
						$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size ); 

						if ( has_post_thumbnail() ) { 
							$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post ); 

							the_post_thumbnail( $image_size, array( 
								'title' => $props['title'],  
								'alt'   => $props['alt'],  
								'class' => 'product-header__thumbnail'
							) ); 
						} elseif ( wc_placeholder_img_src() ) { 
							echo wc_placeholder_img( $image_size ); 
						}
					?>
                </div>
            </div>

        </div>
        
    </div>
    
    <img src="<?php echo get_template_directory_uri(); ?>/images/banner-mask.png" loading="lazy" sizes="(max-width: 991px) 100vw, 85vw" srcset="<?php echo get_template_directory_uri(); ?>/images/banner-mask-p-500.png 500w, <?php echo get_template_directory_uri(); ?>/images/banner-mask-p-800.png 800w, <?php echo get_template_directory_uri(); ?>/images/banner-mask-p-1080.png 1080w, <?php echo get_template_directory_uri(); ?>/images/banner-mask.png 1365w" alt="" class="banner-overlay banner-overlay--tall banner-overlay--hide-tablet">
    
</div>
