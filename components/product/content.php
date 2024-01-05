<?php 

global $product; 

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

?>

<section class="section section--product-content">
    <div class="container">
        <div class="product-bar">
            <div class="product-bar__heading">                
                <?php esc_html_e( 'Description', 'shroom-bros' ); ?>
            </div>

            <div class="product-bar__right">
                <div class="product-bar__group product-bar__group--review">
                    <a href="#reviews" class="button button--review w-button">
                        <?php esc_html_e( 'Reviews', 'shroom-bros' ); ?>
                    </a>
                </div>

                <div class="product-bar__group">
                    <a href="#greviews" class="w-inline-block">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icons8-google.svg" loading="lazy" width="30" height="30" alt="">
                    </a>
                </div>

                <div class="product-bar__group">
                    <a href="#reviews" class="w-inline-block">
                        <?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
                    </a>
                </div>

                <div class="product-bar__group">
                    <a href="#reviews" class="product-bar__link w-inline-block">
                        <?php esc_html_e( 'Based on', 'shroom-bros' ); ?>  
                        <?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '<strong>' . esc_html( $review_count ) . '</strong>' ); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column column--8">
                <div data-w-id="a894fddf-dec0-f282-a332-356aeff16691" style="opacity:0" class="product-description">
                    <div class="product-description__content w-richtext">
                        <?php the_content(); ?>
                    </div>
                </div>

                <a href="/shroom-dose-calculator" data-w-id="7d5d5dec-932a-2678-ec07-6436d2cbf912" style="opacity:0" class="button button--tertiary button--rounded button--calculator w-button">
                    <?php esc_html_e( 'Shroom Dose Calculator', 'shroom-bros' ); ?>
                </a>
            </div>

            <div class="column column--4">
                <?php if( ( $description = get_field( 'description' ) ) && $description[ 'feature' ] !== '' ): ?>
                    <div data-w-id="102b32b4-ef56-44eb-23fa-5a8cabf507ef" style="opacity:0" class="product-type">
                        <?php echo $description[ 'feature' ]; ?>
                    </div>
                <?php endif; ?>
                
                <img src="<?php echo get_template_directory_uri(); ?>/images/product-banner.png" loading="lazy" style="opacity:0" data-w-id="de2edbcc-c2fd-4c3e-aa49-a56b4b55169e" alt="" class="product-banner">
            </div>
        </div>
    </div>
</section>