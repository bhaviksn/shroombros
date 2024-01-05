<?php 

if( !function_exists( 'shroom_bros_banner' ) ) {
	/**
 	 * 
 	 */
	function shroom_bros_banner( $args = array() ) { 
		if( $args[ 'background' ] === false ) { ?>
			<div class="<?php echo $args['variant'] ? "banner " . $args['variant'] : 'banner'; ?>">
		<?php } else { 
			$background = isset( $args['background'] ) && $args['background'] != '' ? $args['background'] : get_field('banner', 'option')['background']; ?>
			<div class="<?php echo $args['variant'] ? "banner " . $args['variant'] : 'banner'; ?>" style="background-image: url(<?php echo $background; ?>);">
		<?php } ?>
			<div class="container <?php echo isset( $args['container'] ) && $args['container'] !== 'large' ? $args['container'] : 'container--large'; ?>">
				<div class="banner-content <?php echo isset( $args['content'] ) ? $args['content'] : '' ?>">
                    <?php if( isset( $args['prepend'] ) ): ?>
                        <div class="banner-prepend">
                            <?php echo $args['prepend']; ?>
                        </div>
                    <?php endif; ?>

                    <?php if( isset( $args['heading'] ) ): ?>
                        <h1 class="banner-heading heading-psy <?php echo isset( $args['heading']['variant'] ) ? $args['heading']['variant'] : ''; ?>">
                            <?php echo is_string( $args['heading'] ) ? $args['heading'] : $args['heading']['value']; ?>
                        </h1>
                    <?php endif; ?>

                    <?php if( isset( $args['subheading'] ) ): ?>
                        <div class="banner__subtitle <?php echo isset( $args['subheading']['variant'] ) ? $args['subheading']['variant'] : ''; ?>">
                            <?php echo is_string( $args['subheading'] ) ? $args['subheading'] : $args['subheading']['value']; ?>
                        </div>
                    <?php endif; ?>
				</div>
			</div>
			
			<?php if( $args[ 'background' ] !== false ): ?>
				<?php if ( !is_checkout() && !is_cart() ) : ?>
           <img src="<?php echo get_template_directory_uri(); ?>/images/banner-mask.png" loading="lazy" sizes="95vw" srcset="<?php echo get_template_directory_uri(); ?>/images/banner-mask-p-500.png 500w, <?php echo get_template_directory_uri(); ?>/images/banner-mask-p-800.png 800w, <?php echo get_template_directory_uri(); ?>/images/banner-mask-p-1080.png 1080w, <?php echo get_template_directory_uri(); ?>/images/banner-mask.png 1365w" role="decorative" class="banner-overlay <?php echo isset( $args['overlay'] ) ? $args['overlay'] : ''; ?>">
        <?php endif; ?>
			<?php endif; ?>
			
    	</div>
			<?php if( $args[ 'background' ] !== false ): ?>
				<?php if ( is_checkout() || is_cart() ) : ?>
					<div class="plane-animation">
						<img src="<?php echo get_template_directory_uri(); ?>/images/plane-animation-backgound-2.png" loading="lazy" sizes="100vw" alt="" class="plane-animation-bg">
					
						<div class="plane" data-animation="<?php echo get_template_directory_uri(); ?>/lottie/plane.json"></div>
					</div>
        <?php endif; ?>
			<?php endif; ?>
			
			<?php if (is_order_received_page()) { ?>
				<canvas class="confetti"></canvas>
				<audio id="order-recieved-audio" src="<?=get_field('checkout_audio', 'option')?>"></audio>
<!-- 				<iframe id="order-recieved-iframe" src="<?php echo get_template_directory_uri(); ?>/audio/order-received.mp3" allow="autoplay" style="display: none;"></iframe> -->
			<?php } ?>
	<?php }
}
?>