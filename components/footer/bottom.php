<?php $footer = get_field( 'footer', 'option' ); ?>

<div class="footer-bottom">
    <?php get_template_part( 'components/footer/bottom', 'newsletter' ); ?>

    <div class="footer-company">
        <div class="container container--large">
            <div class="footer-bottom__content">
                <?php if( $info = $footer['info'] ): ?>
                    <a href="<?php echo home_url(); ?>" aria-current="page" class="footer-logo w-inline-block w--current">
                        <?php echo wp_get_attachment_image( $info['logo'], 'full', false, array( 'class' => 'footer-logo__image', 'loading' => 'lazy' ) ); ?>
                    </a>
                <?php endif; ?>

                <?php get_template_part( 'components/footer/bottom', 'info' ); ?>

                <?php get_template_part( 'components/footer/bottom', 'social' ); ?>
            </div>
        </div>
    </div>
</div>
