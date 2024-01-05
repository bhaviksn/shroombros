<?php if( $faq = get_field('faqs') ): ?>

    <section class="section section--large section--gray section--faq">
        <div class="container container--large">
            <div class="faq">
                <div data-w-id="6a9a9ede-75aa-c23b-700e-9f1dd2ce2bbf" class="faq-illustration">
                    <?php echo wp_get_attachment_image( $faq['image'], 'full', false, array( 'loading' => 'lazy' ) ); ?>
                </div>

                <?php if( $questions = $faq['content'] ): ?>
                    <div class="accordion accordion--faq">
                        <?php $index = 1; foreach( $questions as $group ): ?>
                            <div class="accordion-panel accordion-panel--faq <?php echo $index === 1 ? 'accordion-panel--open' : '' ; ?> w-dropdown" data-delay="0">
                                <div class="accordion-trigger w-dropdown-toggle">
                                    <div class="accordion-trigger__title"><?php echo $group['question']; ?></div>

                                    <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-dots-right.png" loading="lazy" width="10.5" class="accordion-trigger__icon" role="decorative">
                                </div>

                                <nav class="accordion-content w-dropdown-list">
                                    <div class="accordion-content__wrapper">
                                        <div class="accordion-content__body w-richtext"><?php echo $group['answer']; ?></div>
                                    </div>
                                </nav>
                            </div>
                        <?php $index++; endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>
