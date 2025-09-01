(function ($) {
  ("use strict");

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

  $(".mkdf-sp-close").on("click", function (e) {
    localStorage.setItem("disabledPopup", "yes");
  });
  $(document).keyup(function (e) {
    if (e.keyCode === 27) {
      //KeyCode for ESC button is 27
      localStorage.setItem("disabledPopup", "yes");
    }
  });

  //  ! ******Кастомная смена текстов и линков для кнопки добавить в избранное *********
  function getBrowseWishlistText() {
    var htmlLang = document.documentElement.getAttribute("lang");

    if (htmlLang === "uk") {
      return "Переглянути список бажань";
    } else if (htmlLang === "ru-RU") {
      return "Просмотреть список желаний";
    } else {
      return "Browse wishlist";
    }
  }
  function getBrowseWishlistLink() {
    var htmlLang = document.documentElement.getAttribute("lang");

    if (htmlLang === "uk") {
      return "/wishlist";
    } else if (htmlLang === "ru-RU") {
      return "/ru/wishlist-ru";
    } else {
      return "/en/wishlist-en";
    }
  }

  function changeWishlistText() {
    var browseText = getBrowseWishlistText();
    var browseLink = getBrowseWishlistLink();

    var wishlistButtons = document.querySelectorAll(".qwfw-add-to-wishlist");

    wishlistButtons.forEach(function (button) {
      if (button.classList.contains("qwfw--added") || button.classList.contains("added") || button.getAttribute("data-added") === "true") {
        var textElement = button.querySelector(".qwfw-m-text");

        if (textElement) {
          textElement.textContent = browseText;

          if (textElement.hasAttribute("data-label")) {
            textElement.setAttribute("data-label", browseText);
          }
        }
        $(button).attr("href", browseLink);
      }
    });
  }

  function handleWishlistAction() {
    setTimeout(changeWishlistText, 100);
  }

  $(document).ajaxComplete(function (event, xhr, settings) {
    if (settings.url && (settings.url.includes("wishlist") || (settings.data && settings.data.includes("wishlist")))) {
      handleWishlistAction();
    }
  });

  // ***********
})(jQuery);
