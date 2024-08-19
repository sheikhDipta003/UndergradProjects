$(document).ready(function () {
  $(document).on("click", ".friend-tab", function () {
    $(this)
      .parents(".friend-follow-tab")
      .siblings(".about-main-sib")
      .find(".friend-tab-open")
      .show();
    $(this)
      .parents(".friend-follow-tab")
      .siblings(".about-main-sib")
      .find(".follower-tab-open")
      .hide();
  });

  $(document).on("click", ".follower-tab", function () {
    $(this)
      .parents(".friend-follow-tab")
      .siblings(".about-main-sib")
      .find(".follower-tab-open")
      .show();
    $(this)
      .parents(".friend-follow-tab")
      .siblings(".about-main-sib")
      .find(".friend-tab-open")
      .hide();
  });
});
