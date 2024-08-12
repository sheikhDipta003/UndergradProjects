$(document).ready(function () {
  var u_id = $(".u_p_id").data("uid");
  var p_id = $(".u_p_id").data("pid");
  var BASE_URL = "http://localhost/facebook/";

  $(document).on("click", ".comment-action", function () {
    $(this)
      .parents(".nf-4")
      .siblings(".nf-5")
      .find("input.comment-input-style")
      .focus();
  });

  $(".comment-submit").keyup(function (e) {
    if (e.keyCode == 13) { //'enter' key
      var inputNull = $(this);
      var comment = $(this).val();
      var postid = $(this).data("postid");
      var userid = $(this).data("userid");
      var commentPlaceholder = $(this).parents(".nf-5").find("ul.add-comment");

      if (comment == "") {
        alert("Please Enter Some Text");
      } else {
        $.ajax({
          type: "POST",
          url: BASE_URL + "/core/ajax/comment.php",
          data: {
            comment: comment,
            userid: userid,
            postid: postid,
            profileid: p_id,
          },
          cache: false,
          success: function (html) {
            $(commentPlaceholder).append(html);
            $(inputNull).val("");
            commentHover();
          },
        });
      }
    }
  });

  commentHover();

  function commentHover() {
    $(".com-like-react").hover(
      function () {
        var mainReact = $(this).find(".com-react-bundle-wrap");
        $(mainReact).html(
          '<article class="react-bundle align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><section class="com-like-react-click align-middle"><img class="com-main-icon-css" src="' +
            BASE_URL +
            'assets/image/react/like.png " alt=""></section><section class="com-love-react-click align-middle"><img class="com-main-icon-css" src="' +
            BASE_URL +
            'assets/image/react/love.png " alt=""></section><section class="com-haha-react-click align-middle"><img class="com-main-icon-css" src="' +
            BASE_URL +
            'assets/image/react/haha.png " alt=""></section><section class="com-wow-react-click align-middle"><img class="com-main-icon-css" src="' +
            BASE_URL +
            'assets/image/react/wow.png " alt=""></section><section class="com-sad-react-click align-middle"><img class="com-main-icon-css" src="' +
            BASE_URL +
            'assets/image/react/sad.png " alt=""></section><section class="com-angry-react-click align-middle"><img class="com-main-icon-css" src="' +
            BASE_URL +
            'assets/image/react/angry.png " alt=""></section></article>'
        );
      },
      function () {
        var mainReact = $(this).find(".com-react-bundle-wrap");
        $(mainReact).html("");
      }
    );
  }

  $(document).on("click", ".com-main-icon-css", function () {
    var com_bundle = $(this).parents(".com-react-bundle-wrap");
    var commentID = $(com_bundle).data("commentid");
    var likeReact = $(this).parent();
    comReactApply(likeReact, commentID);
  });

  function comReactApply(sClass, commentID) {
    if ($(sClass).hasClass("com-like-react-click")) {
      comReactSub("like", commentID);
    } else if ($(sClass).hasClass("com-love-react-click")) {
      comReactSub("love", commentID);
    } else if ($(sClass).hasClass("com-haha-react-click")) {
      comReactSub("haha", commentID);
    } else if ($(sClass).hasClass("com-wow-react-click")) {
      comReactSub("wow", commentID);
    } else if ($(sClass).hasClass("com-sad-react-click")) {
      comReactSub("sad", commentID);
    } else if ($(sClass).hasClass("com-angry-react-click")) {
      comReactSub("angry", commentID);
    } else {
      console.log("The parent class of the react on this comment is not found");
    }
  }

  function comReactSub(typeR, commentID) {
    var reactColor = "" + typeR + "-color";
    var parentClass = $(".com-" + typeR + "-react-click.align-middle");
    var grandParent = $(parentClass).parents(".com-like-react");
    var postid = $(grandParent).data("postid");
    var userid = $(grandParent).data("userid");

    var spanClass = $(grandParent).find(".com-like-action-text").find("span");
    var com_nf_3 = $(grandParent)
      .parent(".com-react")
      .siblings(".com-text-option-wrap")
      .find(".com-nf-3-wrap");
    
    if ($(spanClass).attr("class") !== undefined) {
      if ($(spanClass).hasClass(reactColor)) {
        $(spanClass).removeAttr("class");
        spanClass.text("Like");
        comReactDelete(typeR, postid, userid, commentID, com_nf_3);
      } else {
        $(spanClass).removeClass().addClass(reactColor);
        spanClass.text(typeR);
        comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
      }
    } else {
      $(spanClass).addClass(reactColor);
      spanClass.text(typeR);
      comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
    }
  }

  $(document).on("click", ".com-like-action-text", function () {
    var thisParents = $(this).parents(".com-like-react");
    var postid = $(thisParents).data("postid");
    var userid = $(thisParents).data("userid");
    var commentID = $(thisParents).data("commentid");
    var typeText = $(thisParents).find(".com-like-action-text");
    var typeR = $(typeText).text();
    var com_nf_3 = $(thisParents)
      .parents(".com-react")
      .siblings(".com-text-option-wrap")
      .find(".com-nf-3-wrap");
    var spanClass = $(thisParents).find(".com-like-action-text").find("span");

    if ($(spanClass).attr("class") !== undefined) {
      $(spanClass).removeAttr("class");
      spanClass.text("Like");
      comReactDelete(typeR, postid, userid, commentID, com_nf_3);
    } else {
      $(spanClass).addClass("like-color");
      spanClass.text("Like");
      comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
    }
  });

  function comReactSubmit(typeR, postid, userid, commentID, com_nf_3) {
    $.post(
      BASE_URL + "/core/ajax/commentReact.php",
      {
        commentid: commentID,
        reactType: typeR,
        postid: postid,
        userid: userid,
        profileid: p_id,
      },
      function (data) {
        $(com_nf_3).empty().html(data);
      }
    );
  }

  function comReactDelete(typeR, postid, userid, commentID, com_nf_3) {
    $.post(
      BASE_URL + "/core/ajax/commentReact.php",
      {
        deleteReactType: typeR,
        delCommentid: commentID,
        postid: postid,
        userid: userid,
        profileid: p_id,
      },
      function (data) {
        $(com_nf_3).empty().html(data);
      }
    );
  }

  $(document).on("click", ".com-dot", function () {
    //first remove com-opt-click id from com-dot class, otherwise when the tripple-dot of a comments is clicked, the options will show up for multiple comments
    $(".com-dot").removeAttr("id");
    $(this).attr("id", "com-opt-click");
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var commentid = $(this).data("commentid");
    var comDetails = $(this).siblings(".com-option-details-container");
    $(comDetails)
      .show()
      .html(
        '<div class="com-option-details" style="z-index:2;"><ul><li class="com-edit" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '" data-commentid="' +
          commentid +
          '">Edit</li><li class="com-delete" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '" data-commentid="' +
          commentid +
          '">Delete</li><li class="com-privacy" data-postid="' +
          postid +
          '" data-userid="' +
          userid +
          '">privacy</li></ul></div>'
      );
  });

  $(document).on("click", "li.com-edit", function () {
    var comTextContainer = $(this)
      .parents(".com-dot-option-wrap")
      .siblings(".com-pro-text")
      .find(".com-text");
    var addId = $(comTextContainer).attr("id", "editComPut");
    var getComText1 = $(comTextContainer).text();
    var postid = $(comTextContainer).data("postid");
    var userid = $(comTextContainer).data("userid");
    var commentid = $(comTextContainer).data("commentid");
    var profilepic = $(comTextContainer).data("profilepic");
    var getComText = getComText1.replace(/\s+/g, " ").trim(); //replace tab, multiple spaces into a single space and then trim it

    $(".top-box-show").html(
      '<section class="top-box profile-dialog-show" style="top: 12.5%; left: 22.5%; width: 55%;">' +
          '<div class="edit-post-header align-middle" style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray; font-size: 14px; font-weight: 600;">' +
              '<div class="edit-post-text">Edit Comment</div>' +
              '<div class="edit-post-close" style="padding: 5px; color: gray; cursor: pointer;">x</div>' +
          '</div>' +
          '<div class="edit-post-value" style="border-bottom: 1px solid lightgray;">' +
              '<div class="status-med">' +
                  '<div class="status-prof">' +
                      '<div class="top-pic">' +
                          '<img src="' + profilepic + '" alt="">' +
                      '</div>' +
                  '</div>' +
                  '<div class="status-prof-textarea">' +
                      '<textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editCom align-middle" style="font-family: sans-serif; font-weight: 400; padding: 5px;">' +
                          getComText +
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
              '<div class="edit-com-save" style="padding: 3px 15px; background-color: #4267bc; color: white; font-size: 14px; margin-left: 5px; cursor: pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">' +
                  'Save' +
              '</div>' +
          '</div>' +
      '</section>'
  );
  });

  $(document).on("click", ".edit-com-save", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var commentid = $(this).data("commentid");
    var editedText = $(this)
      .parents(".edit-post-submit")
      .siblings(".edit-post-value")
      .find(".editCom");
    var editedTextVal = $(editedText).val();
    $.post(
      BASE_URL + "core/ajax/editComment.php",
      {
        postid: postid,
        userid: userid,
        editedTextVal: editedTextVal,
        commentid: commentid,
      },
      function (data) {
        $("#editComPut").html(data).removeAttr("id");
        $(".top-box-show").empty();
      }
    );
  });
  
  $(document).on("click", ".com-delete", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var commentid = $(this).data("commentid");
    var comContainer = $(this).parents(".new-comment");

    var r = confirm("Do you want to delete the comment?");
    if (r === true) {
      $.post(
        BASE_URL + "core/ajax/editComment.php",
        {
          deletePost: postid,
          userid: userid,
          commentid: commentid,
        },
        function (data) {
          $(comContainer).empty();
        }
      );
    }
  });
});
