<?php if( $methods = get_field('methods') ): ?>

    <section class="section section--first">
        <div class="container">
            <h2 class="section-title">
                <?php echo $methods['title']; ?>
            </h2>

            <div class="contact-methods">
                <?php if( ( $email = $methods[ 'email' ] ) && $email[ 'value' ] ): ?>
                    <a href="mailto:<?php echo antispambot( esc_attr( $email[ 'value' ] ) ); ?>" class="contact-method w-inline-block">
                        <div class="contact-method__figure">
                            <?php echo wp_get_attachment_image( $email['image'], 'full', false, array( 'class' => 'contact-method__thumb', 'loading' => 'lazy' ) ); ?>
                        </div>

                        <h3 class="contact-method__heading">
                            <?php echo antispambot( $email[ 'value' ] ); ?>
                        </h3>
                    </a>
                <?php endif; ?>

                <?php if( ( $location = $methods[ 'location' ] ) && $location[ 'link' ] ): ?>
                    <a href="<?php echo esc_attr( $location[ 'link' ] ); ?>" target="_blank" class="contact-method w-inline-block">
                        <div class="contact-method__figure">
                            <?php echo wp_get_attachment_image( $location['image'], 'full', false, array( 'class' => 'contact-method__thumb', 'loading' => 'lazy' ) ); ?>
                        </div>

                        <h3 class="contact-method__heading">
                            <?php echo $location[ 'address' ]; ?>
                        </h3>
                    </a>
                <?php endif; ?>
                
                <?php if( ( $chat = $methods['chat'] ) && $chat[ 'link' ] ): ?>
                    <a href="<?php echo esc_attr( $chat[ 'link' ] ); ?>" target="_blank" class="contact-method w-inline-block">
                        <div class="contact-method__figure">
                            <?php echo wp_get_attachment_image( $chat['image'], 'full', false, array( 'class' => 'contact-method__thumb', 'loading' => 'lazy' ) ); ?>
                        </div>

                        <h3 class="contact-method__heading">
                            <?php esc_html_e( 'Start Live Chat', 'shroom-bros' ); ?>
                        </h3>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>