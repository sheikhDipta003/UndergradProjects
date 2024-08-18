$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";

  $(document).on("click", ".share-action", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var profilePic = $(this).data("profilepic");
    var profileid = $(this).data("profileid");

    var nf_1 = $(this).parents(".nf-4").siblings(".nf-1").html();
    var nf_2 = $(this).parents(".nf-4").siblings(".nf-2").html();

    $(".top-box-show").html(
        '<article class="top-box profile-dialog-show" style="overflow: hidden;background-color: rgb(236, 236, 236);">' +
            '<section class="edit-post-header align-middle" style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray; font-size: 14px; font-weight: 600;">' +
                '<div class="edit-post-text">Share Post</div>' +
                '<div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div>' +
            '</section>' +
            '<section class="edit-post-value">' +
                '<div class="status-med">' +
                    '<div class="status-prof">' +
                        '<div class="top-pic">' +
                            '<img src="' + profilePic + '" alt="">' +
                        '</div>' +
                    '</div>' +
                    '<div class="status-prof-textarea">' +
                        '<textarea data-autoresize rows="5" columns="5" placeholder="Tell something about the post.." name="textStatus" class="shareText align-middle" style="padding-top: 10px;"></textarea>' +
                    '</div>' +
                '</div>' +
            '</section>' +
            '<section class="news-feed-text" style="display: flex; flex-direction: column; align-items: baseline; margin: 5px; box-shadow: 0 0 2px darkgray; overflow: hidden;">' +
                nf_1 + " " + nf_2 +
            '</section>' +
            '<section class="edit-post-submit" style="position: absolute; right:0; bottom: 0; display: flex; align-items: center; margin: 10px; z-index: 1;">' +
                '<div class="status-privacy-wrap">' +
                    '<div class="status-privacy" style="background-color: #f5f6f8;">' +
                        '<div class="privacy-icon align-middle">' +
                            '<img src="assets/image/profile/publicIcon.JPG" alt="">' +
                        '</div>' +
                        '<div class="privacy-text">Public</div>' +
                        '<div class="privacy-downarrow-icon align-middle">' +
                            '<img src="assets/image/watchmore.png" alt="">' +
                        '</div>' +
                    '</div>' +
                    '<div class="status-privacy-option"></div>' +
                '</div>' +
                '<div class="post-Share" style="padding: 3px 15px; background-color: #4267bc; color: white; font-size: 14px; margin-left: 5px; cursor:pointer;"' +
                     'data-postid="' + postid + '"' +
                     'data-userid="' + userid + '"' +
                     'data-profileid="' + profileid + '">Share</div>' +
            '</section>' +
            '<section style="position: absolute; bottom: 0; height: 43px; width: 100%; text-align: center; background: lightgrey; box-shadow: -1px -1px 5px grey;"></section>' +
        '</article>'
    );

    $(".nf-1-right-dott").hide();
  });

  $(document).on("click", ".post-Share", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var profileid = $(this).data("profileid");
    var shareText = $(this)
      .parents(".edit-post-submit")
      .siblings(".edit-post-value")
      .find(".shareText")
      .val();

    $.post(
      BASE_URL + "core/ajax/share.php",
      {
        shareText: shareText,
        profileid: profileid,
        postid: postid,
        userid: userid,
      },
      function (data) {
        $(".top-box-show").empty();
      }
    );
  });

  $(document).on("click", ".share-container", function () {
    var userLink = $(this).data("userlink");
    window.location.href = BASE_URL + "profile.php?username=" + userLink + "";
  });

  $(document).on("click", ".shared-post-option", function () {
    $(".shared-post-option").removeAttr("id");
    $(".post-option").removeAttr("id");
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    $(this).attr("id", "opt-click");

    var postDetails = $(this).siblings(".shared-post-option-details-container");
    $(postDetails)
      .show()
      .html(
        '<div class="shared-post-option-details"><ul style="padding:0;"><li class="shared-post-edit" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '">Edit</li><li class="shared-post-delete" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '">Delete</li><li class="post-privacy" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '">privacy</li></ul></div>'
      );
  });

  $(document).on("click", "li.shared-post-edit", function () {
    var statusTextContainer = $(this)
        .parents(".nf-1")
        .siblings(".nf-2")
        .find(".nf-2-text-span");
    var addId = $(statusTextContainer).attr("id", "editPostPut");
    var getPostText1 = $(statusTextContainer).text();
    var getPostText = getPostText1.replace(/\s+/g, " ").trim();
    var postid = $(statusTextContainer).data("postid");
    var userid = $(statusTextContainer).data("userid");
    var getPostImg = $(this)
        .parents(".nf-1")
        .siblings(".nf-2")
        .find(".nf-2-img");
    var profilepic = $(statusTextContainer).data("profilepic");

    $(".top-box-show").html(
        '<div class="top-box profile-dialog-show" style="top: 12.5%; left: 22.5%; width: 55%;">' +
            '<div class="edit-post-header align-middle" style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray; font-size: 14px; font-weight: 600;">' +
                '<div class="edit-post-text">Edit Post</div>' +
                '<div class="shared-edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div>' +
            '</div>' +
            '<div class="edit-post-value" style="border-bottom: 1px solid lightgray;">' +
                '<div class="status-med">' +
                    '<div class="status-prof">' +
                        '<div class="top-pic">' +
                            '<img src="' + profilepic + '" alt="">' +
                        '</div>' +
                    '</div>' +
                    '<div class="status-prof-textarea">' +
                        '<textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="sharedEditStatus align-middle" style="font-family:sens-serif; font-weight: 400; padding: 5px;">' +
                            getPostText +
                        '</textarea>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="edit-post-submit" style="position: absolute; right: 0; bottom: 0; display: flex; align-items: center; margin: 10px;">' +
                '<div class="status-privacy-wrap">' +
                    '<div class="status-privacy">' +
                        '<div class="privacy-icon align-middle">' +
                            '<img src="assets/image/profile/publicIcon.JPG" alt="">' +
                        '</div>' +
                        '<div class="privacy-text">Public</div>' +
                        '<div class="privacy-downarrow-icon align-middle">' +
                            '<img src="assets/image/watchmore.png" alt="">' +
                        '</div>' +
                    '</div>' +
                    '<div class="status-privacy-option"></div>' +
                '</div>' +
                '<div class="shared-edit-post-save" style="padding: 3px 15px; background-color: #4267bc; color: white; font-size: 14px; margin-left: 5px; cursor:pointer;"' +
                    'data-postid="' + postid + '"' +
                    'data-userid="' + userid + '"' +
                    'data-tag="' + getPostImg + '">Save' +
                '</div>' +
            '</div>' +
        '</div>'
    );
  });

  $(document).on("click", ".shared-edit-post-save", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var editedText = $(this)
      .parents(".edit-post-submit")
      .siblings(".edit-post-value")
      .find(".sharedEditStatus");
    var editedTextVal = $(editedText).val();
    $.post(
      BASE_URL + "core/ajax/sharedEditPost.php",
      {
        sharedPostid: postid,
        userid: userid,
        editedTextVal: editedTextVal,
      },
      function (data) {
        $("#editPostPut").html(data).removeAttr("id");
        $(".top-box-show").empty();
      }
    );
  });

  $(document).on("click", ".shared-post-delete", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var postContainer = $(this).parents(".profile-timeline");
    var r = confirm("Do you want to delete the post?");

    if (r == true) {
      $.post(
        BASE_URL + "core/ajax/sharedEditPost.php",
        {
          deletePost: postid,
          userid: userid,
        },
        function (data) {
          $(postContainer).empty();
        }
      );
    }
  });
});
