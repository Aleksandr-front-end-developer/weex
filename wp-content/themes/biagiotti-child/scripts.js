(function ($) {
  "use strict";

  $(document).ajaxComplete(function (event, xhr, settings) {
    if (settings.data.includes("filter")) {
      mkdfInitSelect2();
    }
  });
})(jQuery);
