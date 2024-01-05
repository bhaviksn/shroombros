<?php

$footer = get_field( 'footer', 'option' );

if( $newsletter = $footer['newsletter'] ): ?>

    <div class="footer-newsletter">
        <div class="footer-newsletter__mask"></div>

        <div class="container">
            <section id="subscribe-form" class="footer-newsletter__wrapper">
                <h4 data-w-id="af27a24f-6192-d4d0-e325-c4543b05b1cb" class="footer-newsletter__heading heading-psy heading-psy--secondary">
                    <?php echo $newsletter['heading']; ?>
                </h4>

                <div class="footer-newsletter__form w-form">
                    <?php echo do_shortcode( '[newsletter_signup_form id="' . $newsletter['form'] . '"]' ); ?>
                </div>
            </section>
        </div>
    </div>

<?php endif; ?>
