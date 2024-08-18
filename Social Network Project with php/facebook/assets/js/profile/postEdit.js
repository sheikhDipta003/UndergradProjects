$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";

  $(document).on("click", ".post-option", function () {
    $(".post-option").removeAttr("id");
    $(this).attr("id", "opt-click");
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");

    var postDetails = $(this).siblings(".post-option-details-container");
    $(postDetails)
      .show()
      .html(
        '<div class="post-option-details">' +
          "<ul>" +
          '<li class="post-edit" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '">Edit</li>' +
          '<li class="post-delete" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '">Delete</li>' +
          '<li class="post-privacy" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '">Privacy</li>' +
          "</ul>" +
          "</div>"
      );
  });

  $(document).on("click", "li.post-edit", function () {
    // https://www.w3schools.com/jquery/jquery_ref_traversing.asp
    var $nf2Container = $(this).parents(".nf-1").siblings(".nf-2");
    var statusTextContainer = $nf2Container.find(".nf-2-text");
    var addId = statusTextContainer.attr("id", "editPostPut");
    var getPostText = statusTextContainer.text().replace(/\s+/g, " ").trim(); // https://www.w3schools.com/jsref/jsref_replace.asp, https://www.w3schools.com/jsref/jsref_obj_regexp.asp
    var postid = statusTextContainer.data("postid");
    var userid = statusTextContainer.data("userid");
    var getPostImg = $nf2Container.find(".nf-2-img");

    $(".top-box-show").html(
      '<section class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;">' +
        '<section class="edit-post-header align-middle" style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600;">' +
        '<div class="edit-post-text">Edit Post</div>' +
        '<div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div>' +
        "</section>" +
        '<section class="edit-post-value" style="border-bottom: 1px solid lightgray;">' +
        '<article class="status-med">' +
        '<div class="status-prof-textarea">' +
        '<textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' +
        getPostText +
        "</textarea>" +
        "</div>" +
        "</article>" +
        "</section>" +
        '<section class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;">' +
        '<div class="status-privacy-wrap">' +
        '<div class="status-privacy">' +
        '<div class="privacy-icon align-middle"><img src="assets/image/profile/publicIcon.JPG" alt=""></div>' +
        '<div class="privacy-text">Public</div>' +
        '<div class="privacy-downarrow-icon align-middle"><img src="assets/image/watchmore.png" alt=""></div>' +
        "</div>" +
        '<div class="status-privacy-option"></div>' +
        "</div>" +
        '<div class="edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' +
        postid +
        '" data-userid="' +
        userid +
        '" data-tag="' +
        getPostImg +
        '">Save</div>' +
        "</section>" +
        "</section>"
    );
  });

  $(document).on("click", ".edit-post-save", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var editedText = $(this)
      .parents(".edit-post-submit")
      .siblings(".edit-post-value")
      .find(".editStatus");
    var editedTextVal = editedText.val();

    $.post(
      BASE_URL + "core/ajax/editPost.php",
      {
        editedTextVal: editedTextVal,
        postid: postid,
        userid: userid,
      },
      function (data) {
        $("#editPostPut").html(data).removeAttr("id");
        $(".top-box-show").empty();
      }
    );
  });

  $(document).on("click", ".post-delete", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var postContainer = $(this).parents(".profile-timeline");
    var r = confirm("Do you want to delete the post?");

    if (r == true) {
      $.post(
        BASE_URL + "core/ajax/editPost.php",
        {
          postid: postid,
          userid: userid,
        },
        function (data) {
          postContainer.empty();
        }
      );
    }
  });
});
