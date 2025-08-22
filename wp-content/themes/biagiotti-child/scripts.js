(function ($) {
  ("use strict");

  // $(document).ajaxComplete(function (event, xhr, settings) {
  //   if (settings.data.includes("filter")) {
  //     mkdfInitSelect2();
  //   }
  // });

  // $(".mkdf-pl-controls-holder").prepend($(".widget widget_wpc_sorting_widget").detach());

  $(".mkdf-shopping-cart-holder").on("click", function (e) {
    e.stopPropagation();
    $(".mkdf-sc-dropdown").css("right", "0");
    $("#mkdf-back-to-top").hide();
  });

  $(".mkdf-shopping-cart-holder-close").on("click", function (e) {
    e.stopPropagation();
    $(".mkdf-sc-dropdown").css("right", "-100%");
    $("#mkdf-back-to-top").show();
  });

  let switchLangPoly = false;

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".mkdf-sc-dropdown").length && !$(e.target).closest(".mkdf-shopping-cart-holder").length) {
      $(".mkdf-sc-dropdown").css("right", "-100%");
      $("#mkdf-back-to-top").show();
    }

    if (!$(e.target).closest(".mkdf-drop-down-mobile .second").length && switchLangPoly) {
      $(e.target).closest(".second").css({
        height: "0px",
        overflow: "hidden",
        visibility: "hidden",
        opacity: "0",
      });
      switchLangPoly = false;
    }
  });

  // $(".mkdf-sc-dropdown").on("click", function (e) {
  //   e.stopPropagation();
  // });
  $(".mkdf-shopping-cart-holder .mkdf-header-cart").on("click", function (e) {
    e.preventDefault();
  });

  $(".mkdf-drop-down-mobile .menu-item-has-children").on("click", function (e) {
    var dropDownHolder = $(this).find(".second"),
      dropDownHolderHeight = !mkdf.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;

    dropDownHolderHeight = dropDownHolder.outerHeight();
    e.stopPropagation();

    if (!switchLangPoly) {
      dropDownHolder.css({
        height: dropDownHolderHeight,
        overflow: "visible",
        visibility: "visible",
        opacity: "1",
      });
      switchLangPoly = true;
    } else {
      dropDownHolder.css({
        height: "0px",
        overflow: "hidden",
        visibility: "hidden",
        opacity: "0",
      });
      switchLangPoly = false;
    }
  });
})(jQuery);
