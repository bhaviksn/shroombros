<?php if( $effects = get_field('effects') ): ?>

<section class="section section--dark-bg section--large section--boat">

    <?php get_template_part( 'components/common/boat' ); ?>

    <div class="container container--large">

        <?php if( $effects[ 'enable' ] === true ): ?>
            <div class="subsection">
                <div class="section-intro section-intro--mb-large">
                    <div class="section-intro__prepend">
                        <?php esc_html_e( 'Magic Mushroom', 'shroom-bros' ); ?>
                    </div>
                    
                    <h2 data-w-id="769a2968-5595-878b-88a4-90a7ab3b38a4" class="section-intro__heading heading-psy">
                        <?php esc_html_e( 'Effects', 'shroom-bros' ); ?>
                    </h2>
                </div>

                <div class="row">

                    <?php if( $mental = $effects[ 'mental' ] ): ?>
                        <div class="column">
                            <div class="perks">
                                <h4 class="perks-title">
                                    <?php esc_html_e( 'Mental Effects', 'shroom-bros' ); ?>
                                </h4>

                                <div class="perks-list perks-list--primary">
                                    
                                    <?php if( $value = $mental[ 'distorted' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-1.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Temporal Distortion', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $value = $mental[ 'focus' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-6.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Focus', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $value = $mental[ 'social' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-5.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Social Stimulation', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $value = $mental[ 'hallucinations' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-3.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Visual Hallucination', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $value = $mental[ 'spiritual' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-4.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Introspection', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $value = $mental[ 'therapeutic' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-2.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Therapeutic', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if( $physical = $effects[ 'physical' ] ): ?>
                        <div class="column">
                            <div class="perks">
                                <h4 class="perks-title perks-title--secondary">
                                    <?php esc_html_e( 'Physical Effects', 'shroom-bros' ); ?>
                                </h4>

                                <div class="perks-list perks-list--secondary">
                                    
                                    <?php if( $value = $physical[ 'energy' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-7.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Energy levels', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $value = $physical[ 'couch' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-9.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Couch Lock', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( $value = $physical[ 'stimulation' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-10.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Physical Stimulation', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( $value = $physical[ 'synesthesia' ] ): ?>
                                        <div class="perks-item">
                                            <div class="perks-item__icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/product-effects-8.png" loading="lazy" height="50" alt="" class="perks-item__image">
                                            </div>

                                            <div class="perks-item__content">
                                                <div class="perks-item__name">
                                                    <?php esc_html_e( 'Synesthesia', 'shroom-bros' ); ?>
                                                </div>

                                                <div class="perks-item__progress">
                                                    <div data-value="<?php echo $value; ?>" class="perks-item__progress__bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endif; ?>

        <?php get_template_part( 'components/product/related' ); ?>
    </div>
</section>

<?php endif; ?>