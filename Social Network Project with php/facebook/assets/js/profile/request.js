$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";

  $(document).on("click", ".profile-add-friend", function () {
    $(this)
      .parents(".profile-action")
      .find(".profile-follow-button")
      .removeClass()
      .addClass("profile-unfollow-button")
      .html(
        '<img src="assets/image/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>'
      );
    $(this).find(".edit-profile-button-text").text("Friend Request Sent");
    $(this).removeClass().addClass("profile-friend-sent");
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");

    $.post(
      BASE_URL + "core/ajax/request.php",
      {
        request: profileid,
        userid: userid,
      },
      function (data) {}
    );

    $.post(
      BASE_URL + "core/ajax/follow.php",
      {
        follow: profileid,
        userid: userid,
      },
      function (data) {}
    );
  });

  $(document).on("click", ".accept-req", function () {
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");

    $(this)
      .parent()
      .empty()
      .html(
        '<div class="con-req align-middle"><img src="assets/image/rightsignGray.JPG" alt="">Friend</div><div class="request-unfriend" data-userid="' +
          userid +
          '" data-profileid="' +
          profileid +
          '">Unfriend</div>'
      );

    $.post(
      BASE_URL + "core/ajax/request.php",
      {
        confirmRequest: profileid,
        userid: userid,
      },
      function (data) {}
    );
  });

  $(document).on("click", ".profile-friend-sent", function () {
    $(this)
      .parents(".profile-action")
      .find(".profile-unfollow-button")
      .removeClass()
      .addClass("profile-unfollow-button")
      .html(
        '<img src="assets/image/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>'
      );
    $(this).find(".edit-profile-button-text").text("Add Friend");
    $(this).removeClass().addClass("profile-add-friend");
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");

    $.post(
      BASE_URL + "core/ajax/request.php",
      {
        cancelSentRequest: profileid,
        userid: userid,
      },
      function (data) {}
    );

    $.post(
      BASE_URL + "core/ajax/follow.php",
      {
        unfollow: profileid,
        userid: userid,
      },
      function (data) {}
    );
  });

  $(document).on("click", ".request-cancel", function () {
    $(this)
      .parents(".profile-friend-confirm")
      .removeClass()
      .addClass("profile-add-friend")
      .html(
        ' <img src="assets/image/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>'
      );
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");
    $.post(
      BASE_URL + "core/ajax/request.php",
      {
        cancelSentRequest: userid,
        userid: profileid,
      },
      function (data) {}
    );
  });

  $(document).on("click", ".request-unfriend", function () {
    $(this)
      .parents(".profile-friend-confirm")
      .removeClass()
      .addClass("profile-add-friend")
      .html(
        ' <img src="assets/image/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>'
      );
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");
    $.post(
      BASE_URL + "core/ajax/request.php",
      {
        unfriendRequest: profileid,
        userid: userid,
      },
      function (data) {}
    );
  });

  $(document).on("mouseenter", ".edit-profile-confirm-button", function () {
    var reqCancel = $(this).find(".request-cancel");
    var reqUnfriend = $(this).find(".request-unfriend");
    $(reqCancel).show();
    $(reqUnfriend).show();
  });

  $(document).on("mouseleave", ".profile-friend-confirm", function () {
    var reqCancel = $(this).find(".request-cancel");
    var reqUnfriend = $(this).find(".request-unfriend");
    $(reqCancel).hide();
    $(reqUnfriend).hide();
  });
});
