function popupDiv(div_id) {
  var $div_obj = $("#" + div_id);
  var windowWidth = $(window).width();
  var windowHeight = $(window).height();
  var popupHeight = $div_obj.height();
  var popupWidth = ($(window).width() - $div_obj.width()) / 2;
  $div_obj.css("left", popupWidth);
  $("<div id='bg'></div>").width(windowWidth)
    .height(windowHeight).click(function() {}).appendTo("body").fadeIn(200);
  $div_obj.css({
    "position": "absloute"
  }).animate({
    top: (windowHeight / 2 - popupHeight / 2) * 0.7,
    opacity: "show"
  }, 400);
  $div_obj.children("pop-box-body").find().show();
}

function hideDiv(div_id) {
  $("#bg").fadeOut(200);
  $("#bg").remove();
  $("#" + div_id).animate({
    top: 0,
    opacity: "hide"
  }, 300);
}

function popError(reason) {
  popupDiv('pop-div');
  $("#errorReason").text(reason);
}
function popSucceed(info) {
  popupDiv("pop-succeed");
  $("#succeed-info").text(info);
}