<?php

$footer = get_field( 'footer', 'option' );

if( $banner = $footer['banner'] ): ?>

    <div class="footer-top" style="background-image: url('<?=$footer['background_image']?>');">
        <div class="container container--large">
            <div class="section-intro">
                <div class="section-intro__prepend">
                    <?php echo $banner[ 'heading' ]; ?>
                </div>

                <h5 data-w-id="66e75ba3-0a3f-4551-e351-934656b54a96" class="section-intro__heading section-intro__heading--large heading-psy">
                    <?php echo $banner[ 'subheading' ]; ?>
                </h5>
            </div>
        </div>
    </div>

<?php endif; ?>
