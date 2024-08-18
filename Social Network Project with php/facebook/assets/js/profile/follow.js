$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";

  $(document).on("click", ".profile-follow-button", function () {
    $(this)
      .removeClass()
      .addClass("profile-unfollow-button")
      .html(
        ' <img src="assets/image/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>'
      );
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");

    $.post(
      BASE_URL + "core/ajax/follow.php",
      {
        follow: profileid,
        userid: userid,
      },
      function (data) {}
    );
  });
  
  $(document).on("click", ".profile-unfollow-button", function () {
    $(this)
      .removeClass()
      .addClass("profile-follow-button")
      .html(
        ' <img src="assets/image/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>'
      );
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");

    $.post(
      BASE_URL + "core/ajax/follow.php",
      {
        unfollow: profileid,
        userid: userid,
      },
      function (data) {}
    );
  });
});
