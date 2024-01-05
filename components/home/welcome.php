<?php if( $hero = get_field('welcome') ): ?>
    
    <?php if ($hero['banner_type'] == 'Image'): ?>
        <?php if ( wp_is_mobile() ) : ?>
            <section class="banner banner--home" style="background-image: url(<?=$hero['mobile_background']['url']?>);">
        <?php else: ?>
            <section class="banner banner--home" style="background-image: url(<?=$hero['background']?>);">
        <?php endif; ?>
    <?php else: ?>
        <section class="banner banner--home-video banner--home" style="background-image: none;">
    <?php endif; ?>
        
        <div class="canvas">
            <div class="container container--large">
                <div class="banner-content banner-content--small">
                        <?php if (empty($hero['animation'])) : ?>
                    
                        <div class="banner-prepend">
                            <?php esc_html_e( $hero['title'] ); ?>
                        </div>
                        
                        <?php echo wp_get_attachment_image( $hero['badge'], 'full', false, array( 'class' => 'banner__logo', 'loading' => 'lazy' ) ); ?>
                                    
                                    <?php else : ?>
                                        
                                        <div class="animated-banner-logo" data-animation="<?=$hero['animation']?>">
                                            <h1>Buy Magic Mushrooms Online in Canada</h1>
                                        </div>
                                    
                                    <?php endif; ?>
                                    
                    <div class="banner__description" >
                        <?php esc_html_e( $hero['subtitle'] ); ?>
                    </div>

                    <?php if( !is_user_logged_in() ): ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="button button--banner w-button">
                            <?php esc_html_e( $hero['button_visitors'] ); ?>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="button button--banner w-button">
                            <?php esc_html_e( $hero['button_members'] ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($hero['banner_type'] == 'Video'): ?>
                <?php if ( wp_is_mobile() ) : ?>
                    <?php if ($hero['background_video_mobile_mp4']) : ?>
                        <div  class="w-video">
                            <video playsinline defaultmuted autoplay muted loop poster="<?=$hero['background_video_poster_mobile']['url']?>">
                                <?php if ($hero['background_video_mobile_mp4']) : ?>
                                    <source src="<?=$hero['background_video_mobile_mp4']['url']?>" type="video/mp4">
                                <?php endif; ?>
                                <?php if ($hero['background_video_mobile_ogv']) : ?>
                                    <source src="<?=$hero['background_video_mobile_ogv']['url']?>" type="video/ogg">
                                <?php endif; ?>
                                <?php if ($hero['background_video_mobile_webm']) : ?>
                                    <source src="<?=$hero['background_video_mobile_webm']['url']?>" type="video/webm">
                                <?php endif; ?>
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if ($hero['background_video_desktop_mp4']) : ?>
                        <div  class="w-video">
                            <video playsinline defaultmuted autoplay muted loop poster="<?=$hero['background_video_poster']['url']?>">
                                <?php if ($hero['background_video_desktop_mp4']) : ?>
                                    <source src="<?=$hero['background_video_desktop_mp4']['url']?>" type="video/mp4">
                                <?php endif; ?>
                                <?php if ($hero['background_video_desktop_ogv']) : ?>
                                    <source src="<?=$hero['background_video_desktop_ogv']['url']?>" type="video/ogg">
                                <?php endif; ?>
                                <?php if ($hero['background_video_desktop_webm']) : ?>
                                    <source src="<?=$hero['background_video_desktop_webm']['url']?>" type="video/webm">
                                <?php endif; ?>
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php if( $perks = $hero['perks'] ): ?>
            <div class="banner-footer">
                <div class="banner-footer__content">
                    <div class="container container--large">
                        <div class="row row--m">
                            <?php $index = 1; foreach( $perks as $perk ): ?>
                                <div class="column <?php echo $index !== 2 ? 'column--pull-t-xl' : ''; ?> column--center column--tight column--m-4">
                                    <div class="media media--center">
                                        <div class="media-image">
                                            <?php echo wp_get_attachment_image( $perk['icon'], 'full', false, array( 'class' => 'media-image__icon', 'loading' => 'lazy' ) ); ?>
                                        </div>

                                        <div class="media-content">
                                            <?php if( $label = $perk['heading'] ): ?>
                                                <div class="media-label">
                                                    <?php echo $label; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="media-title">
                                                <?php echo $perk['label']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $index++; endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="banner-footer__mask"></div>
            </div>
        <?php endif; ?>
    </section>

<?php endif; ?>