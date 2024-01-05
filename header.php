<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shroom_Bros
 */

?>

<!doctype html>

<html <?php language_attributes(); ?> <?php wf_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">  
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
		<script type="text/javascript">WebFont.load({ google: { families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"] }});</script>
		<!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
		<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
		<link href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" rel="shortcut icon" type="image/x-icon">
		<link href="<?php echo get_template_directory_uri(); ?>/images/webclip.png" rel="apple-touch-icon">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class('body'); ?>>
		
		<?php wp_body_open(); ?>

			<?php /*
			<a class="skip-link screen-reader-text" href="#primary">
				<?php esc_html_e( 'Skip to content', 'shroom-bros' ); ?>
			</a> */ ?>

			<header class="header">
				<div class="container container--large">
					<div class="header-content">
						<div class="header-left">
							<?php the_custom_logo(); ?>
						</div>

						<div class="header-navigation">
							<div data-collapse="medium" data-animation="default" data-duration="400" data-doc-height="1" role="banner" class="header-navbar w-nav">
								<nav role="navigation" class="header-navbar__menu w-nav-menu">
									<?php
										wp_nav_menu( array(
											'menu'              => "header",
											'menu_class'        => false,
											'container'         => false,
											'container_class'   => false,
											'items_wrap'        => '<div id="%1$s" class="header-navbar__menu__list">%3$s</div>',
											'fallback_cb'       => false,
											'before'            => "",
											'after'             => "",
											'link_before'       => "",
											'link_after'        => "",
											'depth'             => 2,
											'theme_location'    => "header"
										) );
									?>

									<a href="<?php echo get_search_link(); ?>" class="header-icon header-icon--search header-icon--desktop w-inline-block">
										<img src="<?php echo get_template_directory_uri(); ?>/images/icon-search.png" loading="lazy" alt="Search Icon" class="header-icon__image">
									</a>
									
									<div class="header-navbar__extras">
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="header-icon header-icon--extras w-inline-block">
											<img src="<?php echo get_template_directory_uri(); ?>/images/icon-account.png" loading="lazy" alt="Account Icon" class="header-icon__image">
										</a>

										<?php shroom_bros_woocommerce_wishlist_icon(); ?>

										<a href="<?php echo get_search_link(); ?>" class="header-icon header-icon--extras header-icon--search w-inline-block">
											<img src="<?php echo get_template_directory_uri(); ?>/images/icon-search.png" loading="lazy" alt="Search Icon" class="header-icon__image">
										</a>
									</div>
								</nav>

								<div class="header-navbar__button w-nav-button">
									<div class="header-navbar__icon w-icon-nav-menu"></div>
								</div>
								
								<a href="<?php echo get_search_link(); ?>" class="header-icon header-icon--search header-icon--desktop-h w-inline-block">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icon-search.png" loading="lazy" alt="Search Icon" class="header-icon__image">
								</a>
							</div>

							<?php woocommerce_breadcrumb( array(
								'wrap_before' => '<nav class="header-breadcrumb">',  
								'wrap_after'  => '</nav>',  
								'before' => '',  
								'after' => '',  
							) ); ?>
						</div>

						<div class="header-right">
							<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="header-icon header--account w-inline-block">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icon-account.png" loading="lazy" alt="" class="header-icon__image">
							</a>

							<?php shroom_bros_woocommerce_wishlist_icon( array(
								'class' => 'favorites'
							) ); ?>

							<?php shroom_bros_woocommerce_header_cart(); ?>
						</div>
					</div>
				</div>
			</header>

			<main class="<?php echo shroom_bros_main_classes(); ?>">
