<?php

/**
 * Template Name: Shroom Dose Calculator
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php shroom_bros_banner( array(
        'variant'     => 'banner--about',
        'prepend'     => get_field( 'heading' ),
        'heading'     => array( 
            'value'   => get_field( 'subheading' ),
            'variant' => 'banner-heading--xl'
        ),
        'subheading'  => array(
            'value'   => get_field( 'description' ),
            'variant' => 'banner__subtitle--small'
        ),
		'background' => get_field( 'background' ),
    ) ); ?>

    <section class="section section--first section--center section--z-3 section--transparent">

        <div class="container container--small">
					<div class="calculator-top">	
						<div class="blue title">
							<h3><?=get_field('top_title')?></h3>
						</div>
						<div class="calc-content">
							<?=get_field('top_content')?>
						</div>
					</div>
					
					<div class="calculator">
						<form method="post" action="" id="shroom-dose-calculator">
							<label for="weight">What is Your Weight?</label>
							<input type="number" name="weight" id="weight" placeholder="Weight in Kilograms" />
							<label for="dose">Choose Type of Dose?</label>
							<div class="doses">
								<label for="micro" class="dose"><input type="radio" name="dose" class="dose" id="micro" value="micro"><span><i class="ic ic-micro"></i>Micro Dose</span></label>
								<label for="low" class="dose"><input type="radio" name="dose" class="dose" id="low" value="low"><span><i class="ic ic-low"></i>Low Dose</span></label>
								<label for="normal" class="dose"><input type="radio" name="dose" class="dose" id="normal" value="normal"><span><i class="ic ic-normal"></i>Normal Dose</span></label>
								<label for="high" class="dose"><input type="radio" name="dose" class="dose" id="high" value="high"><span><i class="ic ic-high"></i>High Dose</span></label>
							</div>
							<button type="submit" class="shroom-dose-submit">Lets Calculate</button>
							<div class="results">
								<div class="number">0</div>
								<div class="grams">grams</div>
							</div>
						</form>
					</div>
					
					<div class="calculator-bottom">	
						<div class="pink title">
							<h3><?=get_field('bottom_title')?></h3>
						</div>
						<div class="calc-content">
							<?=get_field('bottom_content')?>
						</div>
					</div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer();
