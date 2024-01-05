<?php if( $form = get_field('form') ): ?>

    <section class="section section--gray section--large section--boat-alt">

        <div class="container">

            <div class="section-intro">
                <div class="section-intro__prepend section-intro__prepend--pull">
                    <?php echo $form['heading']; ?>
                </div>

                <h2 class="section-title">
                    <?php echo $form['subheading']; ?>
                </h2>
            </div>

            <div class="contact-form w-form">
                <?php echo do_shortcode( '[ninja_form id="' . $form['form'] . '"]' ); ?>
            </div>

        </div>

    </section>

<?php endif; ?>
