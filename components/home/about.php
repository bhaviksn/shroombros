<?php if( $how = get_field( 'how' ) ): ?>

    <section class="section section--how section--pull section--large section--dark section--z2">
        <div class="container container--large">
            <div class="section-intro">
                <div class="section-intro__prepend">
                    <?php echo $how['title']; ?>
                </div>

                <h5 data-w-id="66e75ba3-0a3f-4551-e351-934656b54a96" class="section-intro__heading section-intro__heading--large heading-psy">
                    <?php echo $how['subtitle']; ?>
                </h5>
            </div>

            <div class="section-content section-content-t-xl">

                <div class="grid grid---3">

                    <?php if( $feature = $how['step_1'] ): ?>
                        <div class="feature">
                            <div data-w-id="7eb55f2f-adac-4fa9-0df2-7189ec75815f" class="feature__figure">
                                <?php echo wp_get_attachment_image( $feature['image'], 'full', false, array( 'class' => 'feature__image', 'loading' => 'lazy' ) ); ?>
                            </div>

                            <div class="feature__content">
                                <h3 data-w-id="0d57dd9f-d489-f653-b0f2-5df181c5900e" style="opacity:0" class="feature__title">
                                    <span class="feature__title__alt">1.</span> 
                                    <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ?>">
                                        <?php echo $feature[ 'title' ]; ?>
                                    </a>
                                </h3>

                                <p data-w-id="0d57dd9f-d489-f653-b0f2-5df181c5900f" style="opacity:0" class="feature__subtitle">
                                    <?php echo $feature[ 'subtitle' ]; ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if( $feature = $how['step_2'] ): ?>
                        <div class="feature">
                            <div class="feature__figure">
                                <?php echo wp_get_attachment_image( $feature['image'], 'full', false, array( 'class' => 'feature__image', 'loading' => 'lazy' ) ); ?>
                            </div>

                            <div class="feature__content">
                                <h3 data-w-id="9160a457-eae1-bccd-64e2-f115fc3a636a" style="opacity:0" class="feature__title">
                                    2. 
                                    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ) ?>">
                                        <span class="feature__title__alt"><?php echo $feature[ 'title' ]; ?></span>
                                    </a>
                                </h3>

                                <p data-w-id="9160a457-eae1-bccd-64e2-f115fc3a636c" style="opacity:0" class="feature__subtitle">
                                    <?php echo $feature[ 'subtitle' ]; ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if( $feature = $how['step_3'] ): ?>
                        <div class="feature">
                            <div data-w-id="edd60433-c991-4d23-8b3f-dd496b10adb2" style="opacity:0" class="feature__figure">
                                <?php echo wp_get_attachment_image( $feature['image'], 'full', false, array( 'class' => 'feature__image', 'loading' => 'lazy' ) ); ?>
                            </div>

                            <div class="feature__content">
                                <h3 data-w-id="edd60433-c991-4d23-8b3f-dd496b10adb5" style="opacity:0" class="feature__title">
                                    <span class="feature__title__alt">3.</span> <?php echo $feature[ 'title' ]; ?>
                                </h3>

                                <p data-w-id="edd60433-c991-4d23-8b3f-dd496b10adb7" style="opacity:0" class="feature__subtitle">
                                    <?php echo $feature[ 'subtitle' ]; ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="section-footer section-footer--center">
                <?php if( !is_user_logged_in() ): ?>
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="button button--primary button--rounded button--arrow w-button">
                        <?php esc_html_e( 'Sign Up Now', 'shroom-bros' ); ?>
                    </a>
                <?php else: ?>
                    <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="button button--primary button--rounded button--arrow w-button">
                        <?php esc_html_e( 'Browse Shop', 'shroom-bros' ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>