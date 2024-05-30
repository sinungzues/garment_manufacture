var handleLoginPageChangeBackground = function () {
  var toggleAttr = '[data-toggle="login-change-bg"]';
  var toggleImageAttr = '[data-id="login-cover-image"]';
  var toggleImageSrcAttr = "data-img";
  var toggleItemClass = ".login-bg-list-item";
  var toggleActiveClass = "active";
  $(document).on("click", toggleAttr, function (e) {
    e.preventDefault();
    $(toggleImageAttr).css(
      "background-image",
      "url(" + $(this).attr(toggleImageSrcAttr) + ")"
    );
    $(toggleAttr).closest(toggleItemClass).removeClass(toggleActiveClass);
    $(this).closest(toggleItemClass).addClass(toggleActiveClass);
  });
};
var LoginV2 = (function () {
  "use strict";
  return {
    init: function () {
      handleLoginPageChangeBackground();
    },
  };
})();
$(document).ready(function () {
  LoginV2.init();
});
