<?php

$footer = get_field( 'footer', 'option' );

if( $info = $footer['info'] ): ?>

    <div class="footer-info">
        <div class="footer-info__about">
            <?php echo $info['description']; ?>
        </div>

        <div class="footer-info__tagline">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon-heart.png" loading="lazy" alt="" class="footer-info__tagline__icon">

            <div class="footer-info__tagline__text">
                <?php echo $info['tagline']; ?>
            </div>
            
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon-mushroom.png" loading="lazy" alt="" class="footer-info__tagline__icon">
        </div>

        <?php
            wp_nav_menu( array(
                'menu'              => "footer",
                'menu_class'        => false,
                'container'         => false,
                'container_class'   => false,
                'items_wrap'        => '<ul id="%1$s" class="footer-links">%3$s</ul>',
                'fallback_cb'       => false,
                'before'            => "",
                'after'             => "",
                'link_before'       => "",
                'link_after'        => "",
                'depth'             => 1,
                'theme_location'    => "footer"
            ) );
        ?>
    </div>

<?php endif; ?>
