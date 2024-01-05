<section class="section section--survey section--large">

    <div class="container container--large">

        <div class="row row--t-vertical">

            <?php if( $about = get_field('about') ): ?>
                <div class="column column--7 column--m-12 column--t-mb">
                    <div class="section-intro section-intro--left section-intro--mb-large">
                        <div class="section-intro__prepend">
                            <?php echo $about['title']; ?>
                        </div>

                        <h3 data-w-id="afb107b0-71b3-34f5-e451-099117bded96" class="section-intro__heading section-intro__heading--slate">
                            <?php echo $about['subtitle']; ?>
                        </h3>
                    </div>
                    
                    <div class="article article--mb-small article--w-smaller">
                        <div class="article-content w-richtext">
                            <?php echo $about['content']; ?>
                        </div>
                    </div>

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
            <?php endif; ?>

            <?php if( $survey = get_field('survey') ): ?>
                <div class="column column--5 column--m-12">
                    <div class="section-intro section-intro--mb-large section-intro--t-left">
                        <div class="section-intro__prepend">
                            <?php echo $survey['title']; ?>
                        </div>

                        <h3 data-w-id="53b10fd7-e6e1-f426-ac70-66dec2d29404" class="section-intro__heading section-intro__heading--slate">
                            <?php echo $survey['subtitle']; ?>
                        </h3>
                    </div>

                    <div class="survey">
                        <div data-w-id="f01a44d0-ae62-8ae5-c4f8-9b0407e7517b" class="survey-image">
                            <?php echo wp_get_attachment_image( $survey['image'], 'full', false, array( 'loading' => 'lazy' ) ); ?>
                        </div>

                        <div class="survey-content">
                            <div data-w-id="2accebfd-3b4b-841f-3018-0352b1a7c6c3" style="opacity:0" class="survey-progress">
                                <p class="survey-progress__title">
                                    <?php esc_html_e( 'Alcohol', 'shroom-bros' ); ?>

                                    <span class="survey-progress__score survey-progress__score--orange">
                                        <?php echo $survey['values']['alcohol']; ?>+
                                    </span>
                                </p>

                                <div class="survey-progress__bar">
                                    <div data-value="<?php echo $survey['values']['alcohol']; ?>" class="survey-progress__bar__status survey-progress__bar__status--orange"></div>
                                </div>
                            </div>

                            <div data-w-id="159893c6-40a7-3dc6-2f2c-09fcf523009d" style="opacity:0" class="survey-progress">
                                <p class="survey-progress__title">
                                    <?php esc_html_e( 'Cannabis', 'shroom-bros' ); ?>

                                    <span class="survey-progress__score survey-progress__score--green">
                                        <?php echo $survey['values']['cannabis']; ?>+
                                    </span>
                                </p>

                                <div class="survey-progress__bar">
                                    <div data-value="<?php echo $survey['values']['cannabis']; ?>" class="survey-progress__bar__status survey-progress__bar__status--green"></div>
                                </div>
                            </div>

                            <div data-w-id="3594596d-75fb-3cab-61b9-9e32bb5a55dd" style="opacity:0" class="survey-progress">
                                <p class="survey-progress__title">
                                    <?php esc_html_e( 'Magic Mushrooms', 'shroom-bros' ); ?>

                                    <span class="survey-progress__score survey-progress__score--purple">
                                        <?php echo $survey['values']['shrooms']; ?>+
                                    </span>
                                </p>

                                <div class="survey-progress__bar">
                                    <div data-value="<?php echo $survey['values']['shrooms']; ?>" class="survey-progress__bar__status survey-progress__bar__status--purple"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

</section>
