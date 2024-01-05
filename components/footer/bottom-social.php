<?php

$footer = get_field( 'footer', 'option' );

if( $social = $footer['social'] ): ?>

    <div class="footer-social">
        <h4 class="footer-social__heading">
            <?php esc_html_e( 'Follow us on', 'shroom-bros' ); ?>
        </h4>

        <div class="footer-social__links">
            <a href="<?php echo $social['youtube']; ?>" target="_blank" class="footer-social__link w-inline-block">
                <img src="<?php echo get_template_directory_uri(); ?>/images/youtube.svg" loading="lazy" alt="" class="footer-social__icon" width="36" height="36">
            </a>

            <a href="<?php echo $social['twitter']; ?>" target="_blank" class="footer-social__link w-inline-block">
                <img src="<?php echo get_template_directory_uri(); ?>/images/twitter.svg" loading="lazy" alt="" class="footer-social__icon" width="36" height="36">
            </a>

            <a href="<?php echo $social['instagram']; ?>" target="_blank" class="footer-social__link w-inline-block">
                <img src="<?php echo get_template_directory_uri(); ?>/images/instagram.svg" loading="lazy" alt="" class="footer-social__icon" width="36" height="36">
            </a>
        </div>

        <div class="footer-social__copyright">
            &copy; <?php echo date('Y'); ?> <?php echo bloginfo('name'); ?>
        </div>
    </div>

<?php endif; ?>
