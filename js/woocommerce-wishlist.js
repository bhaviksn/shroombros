/* globals shrk: true, yith_wcwl_l10n: false */

jQuery(document).ready(function ($) {
  update_wishlist_items();

  $(".hide_wishlist_widget_if_empty")
    .closest(".widget_wishlist")
    .addClass("hide_wishlist_widget_if_empty");

  $(".widget_wishlist").on("click", "a.remove", function () {
    remove_item_from_wishlist($(this));
    return false;
  });

  // Bind to YITH Wishlist events
  $("body").on(
    "added_to_wishlist removed_from_wishlist moved_to_another_wishlist",
    function () {
      update_wishlist_items();
    }
  );

  $("body").on("added_to_wishlist", function (e, t, el_wrap) {
    if ("undefined" === typeof el_wrap || !el_wrap.length) {
      return;
    }

    el_wrap.each(function () {
      $(this)
        .find(".yith-wcwl-wishlistaddedbrowse")
        .removeClass("hide")
        .addClass("show");
    });
  });

  function update_wishlist_items() {
    if (
      $(".header-wishlist-button").length === 0 &&
      $(".widget_wishlist_content").length === 0
    ) {
      return false;
    }

    $.post(
      shrk.ajax.ajaxurl,
      {
        action: "get_wishlist_items",
        _ajax_nonce: shrk.ajax.nonce,
      },
      function (response) {
        if (response.count === 0) {
          $(".widget_wishlist_content")
            .closest(".widget_wishlist")
            .addClass("empty_wishlist");

          // Update counter
          $(".header-wishlist-button").removeClass("has-items");
          $(".header-wishlist-button .product-count").html(0);
        } else {
          $(".widget_wishlist_content")
            .closest(".widget_wishlist")
            .removeClass("empty_wishlist");

          // Update counter
          $(".header-wishlist-button").addClass("has-items");
          $(".header-wishlist-button .product-count").html(
            parseInt(response.count, 10)
          );
        }
        $(".widget_wishlist_content").html(response.html);
      }
    );
  }

  /**
   * Remove a product from the wishlist.
   *
   * @param object el
   * @return void
   * @since 1.0.0
   */
  function remove_item_from_wishlist(el) {
    var table = el.parents("ul.product_list_widget"),
      pagination = table.data("pagination"),
      per_page = table.data("per-page"),
      current_page = table.data("page"),
      row = el.parents("li"),
      data_row_id = row.data("row-id"),
      wishlist_id = table.data("id"),
      wishlist_token = table.data("token"),
      data = {
        action: yith_wcwl_l10n.actions.remove_from_wishlist_action,
        remove_from_wishlist: data_row_id,
        pagination: pagination,
        per_page: per_page,
        current_page: current_page,
        wishlist_id: wishlist_id,
        wishlist_token: wishlist_token,
      };

    if (typeof $.fn.block !== "undefined") {
      table.fadeTo("400", "0.6").block({
        message: null,
        overlayCSS: {
          background:
            "transparent url(" +
            yith_wcwl_l10n.ajax_loader_url +
            ") no-repeat center",
          backgroundSize: "16px 16px",
          opacity: 0.6,
        },
      });
    }

    $.post(yith_wcwl_l10n.ajax_url + " #yith-wcwl-form", data, function () {
      update_wishlist_items();
    });
  }
});
