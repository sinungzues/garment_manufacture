var handleEmailToInput = function () {
  $("#email-to").tagit({
    availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"],
  });
};
var handleEmailContent = function () {
  $(".summernote").summernote({ placeholder: "Type your message here" });
};
var handleAddCc = function () {
  $(document).on("click", '[data-click="add-cc"]', function (e) {
    e.preventDefault();
    var targetName = $(this).attr("data-name");
    var targetId = "email-cc-" + targetName + "";
    var targetHtml =
      "" +
      '	<div class="mailbox-to">' +
      '		<label class="control-label">' +
      targetName +
      ":</label>" +
      '		<ul id="' +
      targetId +
      '" class="primary line-mode"></ul>' +
      "	</div>";
    $('[data-id="extra-cc"]').append(targetHtml);
    $("#" + targetId).tagit();
    $(this).remove();
  });
};
var EmailCompose = (function () {
  "use strict";
  return {
    init: function () {
      handleEmailToInput();
      handleEmailContent();
      handleAddCc();
    },
  };
})();
$(document).ready(function () {
  EmailCompose.init();
});
