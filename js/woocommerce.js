/* globals shrk: true, initPhotoSwipeFromDOM: false */

"use strict";
var shrk = shrk || {};

jQuery(document).ready(function ($) {
  var swiperActive = typeof shrk.swipers !== "undefined";

  // Setup single product image swiper
  $(".product-images-slider").imagesLoaded(function () {
    if (swiperActive) {
      single_product_swipers();
    }

    if ($(".images.product-images .thumbnails").children().length > 1) {
      $(".images.product-images .thumbnails")
        .children()
        .on("click", function (e) {
          e.preventDefault();
          if (typeof $(this).attr("data-sw-index") !== "undefined") {
            shrk.woo.prodImage_swipeTo(
              $(this).attr("data-sw-index"),
              $(this).closest(".product-images").find(".product-images-slider")
            );
          }
          return false;
        });
    }
  });

  // On variations image set, swiper to 1st slide
  $(".variations_form")
    .closest(".product")
    .find(".images")
    .on("woocommerce_gallery_reset_slide_position", function () {
      shrk.woo.prodImage_swipeTo(0);
    });

  // Setup swipers in product-content (in loop)
  if (swiperActive) {
    shrk.woo.swipersLoopInit();

    // Initialize photoswipe
    $(".product-images-slider .swiper-wrapper").initPhotoSwipe();

    // Setup products sliders (shortcodes)
    shrk.swipers.initialize(
      $(".shrk-woo-slider").children(),
      {
        pagination: false,
        slidesPerView: 3,
      },
      "parent"
    );
    $(".shrk-woo-slider").children().addClass("small-arrows");

    // Initialize swiper in related products
    if (shrk.theme_options.woo_related_as_slider === "1") {
      var related_in_slider =
        typeof shrk.theme_options.woo_related_slider_visible_slides ===
        "undefined"
          ? "3"
          : shrk.theme_options.woo_related_slider_visible_slides;
      $(".related.products ul.products").wrap(
        '<div class="woocommerce"></div>'
      );
      shrk.swipers.initialize(
        $(".related.products > .woocommerce"),
        {
          pagination: false,
          slidesPerView: related_in_slider,
        },
        "parent"
      );
      $(".related.products > .woocommerce").addClass("small-arrows");
    }
  }

  // Bind to quickview loaded to init swipers and photoswipe
  $(window).on("qv_loader_stop", function () {
    $(".product-images-slider").imagesLoaded(function () {
      single_product_swipers();
      share_dropdown_direction();
      $(".product-images-slider .swiper-wrapper").initPhotoSwipe();

      // Animation QV after initial opacity transition
      setTimeout(function () {
        $("#yith-quick-view-modal").addClass("qv-shrk-show");
      }, 300);
    });
  });

  // Cleanup class from possible previous state
  $(window).on("qv_loading", function () {
    $("#yith-quick-view-modal").removeClass("qv-shrk-show");
  });

  // Bind to resize to take care of swiper arrows position and dropdown cart max-height
  $(window).on("shrk_resize", function () {
    shrk.woo.swiper_fix_nav_loc();
    shrk.woo.set_cart_max_height();
    shrk.woo.handleUnEvenProductRows();
  });

  // Bind event to isolate focus of hovered item when needed.
  $(".li-isolation:not(.touch-device) ul.products > li").hover(
    function () {
      $(this).addClass("hover");
      $(this).parent().addClass("child-hover");
    },
    function () {
      $(this).removeClass("hover");
      $(this).parent().removeClass("child-hover");
    }
  );

  // Take care of swiper arrows position
  shrk.woo.swiper_fix_nav_loc();

  // Take care of dropdown cart max-height
  shrk.woo.set_cart_max_height();

  /**
   * single_product_swipers initializes
   * swipers in single-product view
   */
  function single_product_swipers() {
    shrk.swipers.initialize($(".product-images-slider"), {
      slidesPerView: 1,
      spaceBetween: 0,
      breakpoints: false,
      loop: false,
      onImagesReady: null,
      onSlideChangeStart: function (swiper) {
        $(swiper.container)
          .closest(".images.product-images")
          .find(".thumbnails")
          .children()
          .removeClass("active");
        $(swiper.container)
          .closest(".images.product-images")
          .find(".thumbnails")
          .children('[data-sw-index="' + swiper.activeIndex + '"]')
          .addClass("active");
      },
      onClick: null,
    });
  }

  /**
   * set_product_cover_row_bg
   * Sets bg as background image in $row_bg
   * @param string bg
   * @param $ object $row_bg
   */
  function set_product_cover_row_bg(bg, $row_bg) {
    $row_bg.find(".bg-cover").addClass("remove");
    $row_bg.append(
      '<div class="bg-cover loading" style="background-image: url(' +
        bg +
        ');"></div>'
    );
    $row_bg.imagesLoaded({ background: ".bg-cover" }, function () {
      $row_bg.find(".loading").removeClass("loading");
      setTimeout(function () {
        $row_bg.find(".remove").remove();
      }, 1000);
    });
  }

  /**
   * Take care of custom rows backgrounds
   */
  $(".product-cover-target").each(function () {
    var $vc_row = $(this).hasClass("vc_row")
      ? $(this)
      : $(this).closest(".vc_row");
    var s =
      shrk.swipers.instances[
        shrk.swipers.getIndex($vc_row.find(".shrk-swiper-container").eq(0))
      ];
    var $target = $(this);

    $target.append('<div class="shrk-vc-row-bg"></div>');
    set_product_cover_row_bg(
      $(s.slides[s.activeIndex]).find(".page-cover-data").data("page-cover"),
      $target.find(".shrk-vc-row-bg")
    );

    s.on("onSlideChangeStart", function (s) {
      set_product_cover_row_bg(
        $(s.slides[s.activeIndex]).find(".page-cover-data").data("page-cover"),
        $target.find(".shrk-vc-row-bg")
      );
    });
  });

  /**
   * Set direction of share icons
   * dropdown in quickview
   */
  function share_dropdown_direction() {
    // overkill? sure.
    if ($(".yith-wcqv-wrapper .social-icons").length === 0) {
      return false;
    }

    var last_pos =
      $(".yith-wcqv-wrapper .social-icons").children().last().offset().top +
      $(".yith-wcqv-wrapper .social-icons").children().last().height();
    var cont_end =
      $(".yith-wcqv-wrapper").offset().top +
      jQuery(".yith-wcqv-wrapper").height();
    if (last_pos > cont_end) {
      $(".yith-wcqv-wrapper .social-icons").addClass("top");
    } else {
      $(".yith-wcqv-wrapper .social-icons").removeClass("top");
    }
  }

  /**
   * Prepare and show woocommerce notices
   */
  shrk.woo.showNotices(1000);

  /**
   * Hide notices that have the autohide class after interval
   */
  shrk.woo.autoHideNotices(
    parseInt(shrk.theme_options.woo_notices_hide_timeout, 10) * 1000
  );

  /**
   * Show woocommerce notices on checkout error (ajax)
   */
  $(document.body).on(
    "update_checkout updated_checkout checkout_error updated_wc_div updated_cart_totals updated_shipping_method  applied_coupon removed_coupon",
    function () {
      shrk.woo.showNotices();
    }
  );

  /**
   * Add a loading class to quickview button
   */
  if (typeof yith_qv !== "undefined") {
    setTimeout(function () {
      $(document).on("click", ".yith-wcqv-button", function () {
        $(this).addClass("loading");
      });
    }, 1000);

    $(document).on("qv_loader_stop", function () {
      $(".yith-wcqv-button").removeClass("loading");
    });
  }

  /**
   * Bind to grid/list view controls
   */
  $(".grid-list-controls a").on("click", function () {
    shrk.woo.setProductView($(this));
    return false;
  });

  $(".woocommerce-message-wrapper .close").on("click", function () {
    $(this).closest(".woocommerce-message-wrapper").slideUp();
  });

  /**
   * Bind to +/- qty buttons on single product & Cart page
   */
  $(".woocommerce").on(
    "click",
    ".quantity .qty-minus-btn, .quantity .qty-plus-btn",
    function (e) {
      var $qty = $(this).siblings("input.qty");
      var min = parseInt($qty.attr("min"), 10);
      var max = parseInt($qty.attr("max"), 10);
      var step = parseInt($qty.attr("step"), 10);
      var q = parseInt($qty.val(), 10);

      step = step ? step : 1;
      var d = $(this).hasClass("qty-plus-btn") ? q + step : q - step;

      if ((isNaN(min) || d >= min) && (isNaN(max) || d <= max)) {
        $qty.val(d);
      }

      if ($(this).closest(".woocommerce-cart-form").length) {
        $(".woocommerce-cart-form .cart_item :input").trigger("change");
      }

      e.stopPropagation();
      e.preventDefault();
    }
  );

  /**
   * Handle Select2 initialization
   */
  shrk.woo.select2_init();

  /**
   * Hide product columns that don't fill the whole row.
   * Only applies to children of the .only-full-row-products
   * custom css class
   */
  shrk.woo.handleUnEvenProductRows();
}); //end document ready

// Bind init to shrk event
jQuery(window).on("shrk_init_page", function () {
  shrk.woo.init();
});

// Bind to wc_fragrments changes events.
jQuery(document.body).on(
  "wc_fragments_refreshed wc_fragments_loaded",
  function () {
    shrk.woo.updateCounters();
  }
);

// Bind to add_to_cart event
jQuery(document.body).on("added_to_cart", function (e, fragments) {
  shrk.woo.updateCounters(parseInt(fragments[".woo-js-cart-count"], 10));
  shrk.woo.autoShowCart();
  shrk.woo.set_cart_max_height();
});

// Bind to header change state
jQuery(window).on("shrk_header_reset_height", function () {
  shrk.woo.set_cart_max_height();
});

shrk.woo = {
  init: function () {
    // Allow cart to auto show after delay
    if (jQuery("body").hasClass("auto_show_cart")) {
      setTimeout(function () {
        jQuery("body")
          .removeClass("auto_show_cart")
          .addClass("auto_show_cart_ready");
      }, 3000);
    }
  },

  updateCounters: function (cartCount) {
    var $ = jQuery;

    if (!$(".cart-icon .product-count").length) {
      return false; // No point.
    }

    shrk.shop_cart_count =
      typeof cartCount === "undefined"
        ? parseInt($(".cart-icon .product-count").data("product-count"), 10)
        : cartCount;

    if (parseInt(shrk.shop_cart_count, 10) > 0) {
      $(".cart-icon").addClass("has-items");
      shrk.woo.set_cart_max_height();
    } else {
      $(".cart-icon").removeClass("has-items");
    }
    shrk.debug__log("Cart updated. Cart count is: " + shrk.shop_cart_count);
  },

  autoShowCart: function () {
    var $ = jQuery;

    if (
      !(
        jQuery("body").hasClass("auto_show_cart_ready") &&
        parseInt(shrk.shop_cart_count, 10) > 0
      )
    ) {
      return;
    }

    if (
      jQuery("body").hasClass("woo-cart-dropdown") ||
      (jQuery("body").hasClass("woo-cart-auto") && jQuery(window).width() > 768)
    ) {
      $("header .cart-dropdown").addClass("force-show");

      if (!$(".site-header").hasClass("head-sticky-visible")) {
        $("body,html").animate({ scrollTop: 0 }, 1000);
      }

      setTimeout(function () {
        $("header .cart-dropdown").removeClass("force-show");
      }, 4000);
    }

    if (
      jQuery("body").hasClass("woo-cart-side") ||
      jQuery(window).width() < 768
    ) {
      shrk.sidepanels.open("#right-side-panel");
    }
  },

  /**
   * set_cart_max_height
   * dynamically set max-height to
   * not allow dropdown cart to overflow page
   */
  set_cart_max_height: function () {
    var $ = jQuery;

    $(".cart-dropdown").each(function () {
      var max_height =
        $(window).height() -
        $(".site-header").height() -
        $("#wpadminbar").height() -
        $(this).find(".cart-footer").height() -
        parseInt($(this).css("padding-top"), 10) -
        parseInt($(this).css("padding-bottom"), 10);
      $(this).find(".cart-products").css({ "max-height": max_height });
    });
  },

  showNotices: function (showAfter_ms) {
    var $ = jQuery;

    if (typeof showAfter_ms === "undefined") {
      var showAfter_ms = 800;
    }

    $(".woocommerce-message-wrapper").each(function () {
      if ($(this).children().length) {
        var $wrap = $(this);
        $wrap.css({
          "background-color": $wrap.children().eq(0).css("background-color"),
        });

        setTimeout(function () {
          $wrap.slideDown();
        }, showAfter_ms);
      }
    });
  },

  autoHideNotices: function (hideAfter_ms) {
    var $ = jQuery;

    if (isNaN(hideAfter_ms) || hideAfter_ms === 0) {
      return;
    }

    $(
      ".woocommerce-message-floating.autohide .woocommerce-message-wrapper"
    ).each(function () {
      if ($(this).children().length) {
        var $wrap = $(this);

        setTimeout(function () {
          $wrap.slideUp();
        }, hideAfter_ms);
      }
    });
  },

  select2_init: function () {
    if (typeof shrk.woo.select2 === "undefined" || shrk.woo.select2 === false) {
      return;
    }

    var $ = jQuery;
    var global_enabled =
      typeof shrk.woo.select2.global_enabled !== "undefined" &&
      shrk.woo.select2.global_enabled;
    var variations_enabled =
      typeof shrk.woo.select2.variations_enabled !== "undefined" &&
      shrk.woo.select2.variations_enabled;

    if (global_enabled) {
      $("select")
        .not('select[name="rating"]')
        .not(".woocommerce-checkout select")
        .not("table.variations select")
        .select2({ minimumResultsForSearch: Infinity, width: "100%" });
      variations_enabled = true;
    }

    if (variations_enabled) {
      $(".variations_form").each(function () {
        $(this).on("wc_variation_form", function () {
          $("table.variations select").select2({
            minimumResultsForSearch: Infinity,
            width: "100%",
          });
        });
      });
    }
  },

  prodImage_swipeTo: function (slide_index, $sw_cont) {
    var $ = jQuery;
    var sw, $sw_cont;

    if ($("#yith-quick-view-modal .product-images-slider").length) {
      $sw_cont = $("#yith-quick-view-modal .product-images-slider");
    } else {
      if (typeof $sw_cont === "undefined") {
        $sw_cont = $(".product-images-slider");
      }
    }

    sw = shrk.swipers.instances[shrk.swipers.getIndex($sw_cont)];

    if (typeof sw === "undefined") {
      return false;
    }

    sw.slideTo(parseInt(slide_index, 10));
    $sw_cont
      .closest(".images.product-images")
      .find(".thumbnails")
      .children()
      .removeClass("active");
    $sw_cont
      .closest(".images.product-images")
      .find(".thumbnails")
      .children('[data-sw-index="' + sw.activeIndex + '"]')
      .addClass("active");
  },

  setProductView: function ($ctrl) {
    var $wrap = $ctrl.parent();
    var view = $ctrl.hasClass("list") ? "list" : "grid";

    if (view === "list") {
      $wrap.parent().find("ul.products").removeClass("grid").addClass("list");
    } else {
      $wrap.parent().find("ul.products").removeClass("list").addClass("grid");
    }

    // Store user's choice
    typeof Cookies === "function" &&
      Cookies.set("products_style_view", view, { expires: 30, path: "/" });

    $wrap.find("a").removeClass("active");
    $ctrl.addClass("active");
    shrk.swipers.updateAll && shrk.swipers.updateAll();
  },

  /**
   * woo_swiper_fix_nav_loc calculate
   * best position of swiper arrows in
   * product-sliders
   */
  swiper_fix_nav_loc: function () {
    var $ = jQuery;

    $(".products.swiper-wrapper").each(function () {
      if ($(this).find(".product-thumb-wrapper").length > 0) {
        var $sw_wrap = $(this);
        $(this).imagesLoaded(function () {
          var d = parseInt(
            ($sw_wrap.find(".product-thumb-wrapper").eq(0).height() -
              $sw_wrap.height()) /
              2,
            10
          );
          $sw_wrap.siblings(".prev_swipe, .next_swipe").css({
            transform: "translateY(" + d + "px)",
          });
        });
      }
    });
  },

  handleUnEvenProductRows: function () {
    jQuery(".only-full-row-products .woocommerce > ul.products").each(
      function () {
        jQuery(this).children().removeClass("hidden");
        var $firstli = jQuery(this).find("li.product").eq(0);
        var cols = Math.round(
          jQuery(this).width() /
            ($firstli.width() + parseInt($firstli.css("padding-left")) * 2)
        );
        var rem = jQuery(this).children().length % cols;

        if (rem > 0) {
          jQuery(this).children().slice(-rem).addClass("hidden");
        }

        if (
          typeof shrk.swipers !== "undefined" &&
          jQuery(this).find(".product-grid-images-slider").length > 0
        ) {
          shrk.swipers.updateAll();
        }
      }
    );
  },

  swipersLoopInit: function () {
    var $ = jQuery;

    shrk.swipers.initialize(
      $(".product-grid-images-slider").not(
        ".no-inner-swiper .product-grid-images-slider"
      ),
      {
        slidesPerView: 1,
        breakpoints: false,
        loop: true,
        lazyLoading: true,
        showScrollbar: false,
        scrollbar: ".swiper-scrollbar",
        lazyLoadingOnTransitionStart: true,
        grabCursor: true,
      }
    );
  },
};
