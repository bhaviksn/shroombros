/* eslint-disable */

function isOnScreen(elem) {
	// if the element doesn't exist, abort
	if (elem.length == 0) {
		return;
	}
	var $window = jQuery(window);
	var viewport_top = $window.scrollTop();
	var viewport_height = $window.height();
	var viewport_bottom = viewport_top + viewport_height;
	var $elem = jQuery(elem);
	var top = $elem.offset().top;
	var height = $elem.height();
	var bottom = top + height;

	return (
		(top >= viewport_top && top < viewport_bottom) ||
		(bottom > viewport_top && bottom <= viewport_bottom) ||
		(height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
	);
}

/**
 * jQuery Loaded
 */

jQuery(document).ready(function ($) {
	/**
	 * Infinite Scroll on Shop
	 */

	// Get variables from locals.
	var current_page = globals.current_page;
	var max_page = globals.max_page;

	// Replace pagination with spinners.
	$('.woocommerce-pagination').html(
		'<img src="' +
			globals.spinner +
			'" class="woocommerce-pagination__spinner" alt="Loading More" width="25" height="25" />',
	);
	$('.woocommerce-pagination').find('.woocommerce-pagination__spinner').hide();

	// Hide the total results count.
	$('.woocommerce-result-count').hide();

	// Bind the scroll and touch events.
	$(document).on('scroll touchmove', function () {
		$('.woocommerce-pagination').each(function () {
			if (isOnScreen($(this))) {
				current_page = parseInt(current_page) + 1;
				//console.log(globals.query);
				if (parseInt(max_page) < parseInt(current_page)) {
					return;
				}

				var spinner = $(this).find('.woocommerce-pagination__spinner');

				spinner.show();
				//console.log(globals.query);
				$.ajax({
					url: globals.ajaxurl,
					type: 'POST',
					data: {
						action: 'shroom_bros_load_more',
						wp_query: globals.query,
						current_page: current_page,
						max_page: max_page,
					},
					success: function (response) {
						console.log(response);
						$('ul.products').append(response.products);
						spinner.hide();
					},
				});
			}
		});
	});

	/**
	 * Store Notice: Push Content Down for Fixed Header
	 */

	if ($('.woocommerce-store-notice').length) {
		var height = $('.woocommerce-store-notice').outerHeight(true);

		$('body').css('padding-top', height + 'px');

		$('.woocommerce-store-notice__dismiss-link').on('click', function () {
			$('body').css('padding-top', 0);
		});

		if ($('.woocommerce-store-notice').is(':hidden')) {
			$('body').css('padding-top', 0);
		}
	}

	// Change the order received text.
	if ($('.woocommerce-thankyou-order-received').length) {
		$('.woocommerce-thankyou-order-received').text(
			'Your order has been received',
		);
	}

	// Change the order received referrals program text.
	if ($('.aw-referrals-share-widget-text').length) {
		$('.aw-referrals-share-widget-text h3').html(
			'<span>Give</span> $10, <span>Get</span> $10',
		);
	}

	/**
	 * Header: Mobile Menu
	 */

	$(window).on('load resize', function (e) {
		if ($(window).width() < 992) {
			$('.menu-item-has-children').on('click', function (e) {
				$(this).toggleClass('menu-item-has-children-open');
			});
		}
	});

	/**
	 * Home: FAQs
	 */

	$('.accordion-panel').on('click', function (e) {
		$(this).siblings().css({ zIndex: null }).removeClass('accordion-panel--open');

		$(this).toggleClass('accordion-panel--open').css({ zIndex: 901 });
	});

	/**
	 * Product: Animated Bars
	 */
	$(window).on('load scroll', function (e) {
		$('.perks-item').each(function () {
			if (isOnScreen($(this))) {
				if (!$(this).is('data-loaded')) {
					const bar = $(this).find('.perks-item__progress__bar');
					const value = bar.data('value');

					bar.css({
						maxWidth: value + '%',
					});

					$(this).attr('data-loaded', true);
				}
			}
		});

		$('.survey-progress__bar').each(function () {
			if (isOnScreen($(this))) {
				if (!$(this).is('data-loaded')) {
					const bar = $(this).find('.survey-progress__bar__status');
					const value = bar.data('value');

					bar.css({
						maxWidth: value + '%',
					});

					$(this).attr('data-loaded', true);
				}
			}
		});
	});

	/**
	 * Product: Form
	 */

	$(window).on('load', function () {
		$('.product-cart form').addClass('product-cart__form');

		$('.product-cart label').addClass('product-cart__label');

		$('.product-cart select').addClass(
			'product-cart__input product-cart__input--select w-select',
		);

		$('.product-cart .quantity label')
			.removeClass('screen-reader-text')
			.text('Qty');

		$('.product-cart .quantity input[type="number"]').addClass(
			'product-cart__input product-cart__input--number w-input',
		);

		$(".product-cart [type='submit']")
			.addClass('button button--primary button--rounded button--cart w-button')
			.wrap(
				"<div class='product-cart__inline product-cart__inline--button'></div>",
			);

		$('.section--reviews .submit').addClass(
			'button button--primary button--rounded',
		);
	});

	/**
	 * Footer: Newsletter
	 */

	// Wrapper
	$('.footer-newsletter__form .mailster-form-fields').addClass(
		'footer-newsletter__control',
	);

	// Label
	$('.footer-newsletter__form label').hide();

	// Field
	$(".footer-newsletter__form input[type='email']")
		.addClass('footer-newsletter__input w-input')
		.attr('placeholder', 'Enter Your Email Address');

	// Submit Button
	$('.footer-newsletter__form .submit-button').addClass(
		'button--primary footer-newsletter__button w-button',
	);

	/**
	 * Footer: CTA Popup By Bhavik
	 */

	$('.mobile-cont__click').on('click', function () {
		if ($('.mobile-cont').hasClass('active')) {
			$('.mobile-cont').removeClass('active');
		} else {
			$('.mobile-cont').addClass('active');
		}
	});

	$('.mobile-cont__link')
		.mouseenter(function () {
			let classNaame = $(this).attr('data-img');
			$('.mobile-cont__img-cont .mobile-cont__img').removeClass('active');
			$('.mobile-cont__img-cont .mobile-cont__img.' + classNaame).addClass(
				'active',
			);
		})
		.mouseleave(function () {
			if ($('.mobile-cont__link[data-if-video="true"]').hasClass('active')) {
				let classNaame = $('.mobile-cont__link[data-if-video="true"]').attr(
					'data-img',
				);
				$('.mobile-cont__img-cont .mobile-cont__img').removeClass('active');
				$('.mobile-cont__img-cont .mobile-cont__img.' + classNaame).addClass(
					'active',
				);
			}
		});

	$('.mobile-cont__link[data-if-video="true"]').click(function (e) {
		e.preventDefault();
		if (!$(this).hasClass('active')) {
			let classNaame = $(this).attr('data-img');
			$(this).addClass('active');
			$('.mobile-cont__img-cont .mobile-cont__img.' + classNaame)[0].src +=
				'?autoplay=1';
		}
	});
});
