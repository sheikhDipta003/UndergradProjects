$(document).ready(function () {
  var p_id = $(".u_p_id").data("pid");
  var BASE_URL = "http://localhost/facebook/";

  //console.log(BASE_URL + ", " + u_id + ", " + p_id);
  $(document).on("click", ".com-reply-action", function () {
    $(".reply-input").empty();
    $(".reply-write").hide();
    var userid = $(this).data("userid");
    var postid = $(this).data("postid");
    var commentid = $(this).data("commentid");
    var profilepic = $(this).data("profilepic");

    var input_field = $(this)
      .parents(".com-text-react-wrap")
      .siblings(".reply-wrap")
      .find(".replyInput");

    input_field.html(
      '<section class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' +
        profilepic +
        '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:96%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' +
        postid +
        '" data-userid="' +
        userid +
        '" data-commentid="' +
        commentid +
        '" placeholder="Write a reply..."></div></div></section>'
    );

    replyInput(input_field);
  });

  $(document).on("click", ".com-reply-action-child", function () {
    $(".reply-input").empty();
    $(".reply-write").hide();
    var userid = $(this).data("userid");
    var postid = $(this).data("postid");
    var commentid = $(this).data("commentid");
    var profilepic = $(this).data("profilepic");

    var input_field = $(this).parents(".reply-wrap").find(".replyInput");

    input_field.html(
      '<section class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' +
        profilepic +
        '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:96%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' +
        postid +
        '" data-userid="' +
        userid +
        '" data-commentid="' +
        commentid +
        '" placeholder="Write a reply..."></div></div></section>'
    );

    replyInput(input_field);
  });

  function replyInput(input_field) {
    // console.log(input_field);
    $(input_field).find("input.reply-input-style.reply-submit").focus();

    $("input.reply-input-style.reply-submit").keyup(function (e) {
      if (e.keyCode == 13) {    //'enter' key
        var inputNull = $(this);
        var comment = $(this).val();
        var postid = $(this).data("postid");
        var userid = $(this).data("userid");
        var commentid = $(this).data("commentid");

        var replyPlaceholder = $(this)
          .parents(".replyInput")
          .siblings(".reply-text-wrap")
          .find(".old-reply");
        
        if (comment == "") {
          alert("Please Enter Some Text.");
        } else {
          $.ajax({
            type: "POST",
            url: BASE_URL + "core/ajax/reply.php",
            data: {
              replyComment: comment,
              userid: userid,
              postid: postid,
              commentid: commentid,
              profileid: p_id,
            },
            cache: false,
            success: function (html) {
              $(replyPlaceholder).append(html);
              $(inputNull).val("");
              replyHover();
            },
          });
        }
      }
    });
  }

  replyHover();

  function replyHover() {
    $(".com-like-react-reply").hover(
      function () {
        var mainReact = $(this).find(".com-react-bundle-wrap.reply");
        $(mainReact).html(
          ' <div class="react-bundle  align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><div class="com-like-react-click  align-middle"><img class="reply-main-icon-css " src="' +
            BASE_URL +
            'assets/image/react/like.png " alt=""></div><div class="com-love-react-click align-middle"><img class="reply-main-icon-css " src="' +
            BASE_URL +
            'assets/image/react/love.png " alt=""></div><div class="com-haha-react-click  align-middle"><img class="reply-main-icon-css " src="' +
            BASE_URL +
            'assets/image/react/haha.png " alt=""></div><div class="com-wow-react-click  align-middle"><img class="reply-main-icon-css " src="' +
            BASE_URL +
            'assets/image/react/wow.png " alt=""></div><div class="com-sad-react-click  align-middle"><img class="reply-main-icon-css " src="' +
            BASE_URL +
            'assets/image/react/sad.png " alt=""></div><div class="com-angry-react-click  align-middle"><img class="reply-main-icon-css " src="' +
            BASE_URL +
            'assets/image/react/angry.png " alt=""></div></div>'
        );
      },
      function () {
        var mainReact = $(this).find(".com-react-bundle-wrap");
        $(mainReact).html("");
      }
    );
  }

  $(document).on("click", ".reply-main-icon-css", function () {
    var com_bundle = $(this).parents(".com-react-bundle-wrap");
    var commentID = $(com_bundle).data("commentid");
    var commentparentid = $(com_bundle).data("commentparentid");
    var likeReact = $(this).parent();
    replyReactApply(likeReact, commentID, commentparentid);
  });

  function replyReactApply(sClass, commentID, commentparentid) {
    if ($(sClass).hasClass("com-like-react-click")) {
      replyReactSub("like", commentID, commentparentid);
    } else if ($(sClass).hasClass("com-love-react-click")) {
      replyReactSub("love", commentID, commentparentid);
    } else if ($(sClass).hasClass("com-haha-react-click")) {
      replyReactSub("haha", commentID, commentparentid);
    } else if ($(sClass).hasClass("com-wow-react-click")) {
      replyReactSub("wow", commentID, commentparentid);
    } else if ($(sClass).hasClass("com-sad-react-click")) {
      replyReactSub("sad", commentID, commentparentid);
    } else if ($(sClass).hasClass("com-angry-react-click")) {
      replyReactSub("angry", commentID, commentparentid);
    } else {
      console.log("not found");
    }
  }

  function replyReactSub(typeR, commentID, commentparentid) {
    var reactColor = "" + typeR + "-color";
    var parentClass = $(".com-" + typeR + "-react-click.align-middle");
    var grandParent = $(parentClass).parents(".com-like-react-reply");
    var postid = $(grandParent).data("postid");
    var userid = $(grandParent).data("userid");

    var spanClass = $(grandParent).find(".reply-like-action-text").find("span");
    var com_nf_3 = $(grandParent)
      .parent(".com-react")
      .siblings(".reply-text-option-wrap")
      .find(".com-nf-3-wrap");

    if ($(spanClass).attr("class") !== undefined) {
      if ($(spanClass).hasClass(reactColor)) {
        $(spanClass).removeAttr("class");
        spanClass.text("Like");
        replyReactDelete(
          typeR,
          postid,
          userid,
          commentID,
          commentparentid,
          com_nf_3
        );
      } else {
        $(spanClass).removeClass().addClass("reactColor");
        spanClass.text(typeR);
        replyReactSubmit(
          typeR,
          postid,
          userid,
          commentID,
          commentparentid,
          com_nf_3
        );
      }
    } else {
      $(spanClass).addClass(reactColor);
      spanClass.text(typeR);
      replyReactSubmit(
        typeR,
        postid,
        userid,
        commentID,
        commentparentid,
        com_nf_3
      );
    }
  }

  $(document).on("click", ".reply-like-action-text", function () {
    var thisParents = $(this).parents(".com-like-react-reply");
    var postid = $(thisParents).data("postid");
    var userid = $(thisParents).data("userid");
    var commentID = $(thisParents).data("commentid");
    var commentparentid = $(thisParents).data("commentparentid");
    var typeText = $(thisParents).find(".reply-like-action-text span");

    var typeR = $(typeText).text();
    var reactColor = "" + typeR + "-color";
    var com_nf_3 = $(thisParents)
      .parent(".com-react")
      .siblings(".reply-text-option-wrap")
      .find(".com-nf-3-wrap");

    var spanClass = $(thisParents).find(".reply-like-action-text").find("span");

    if ($(spanClass).attr("class") !== undefined) {
      if ($(spanClass).hasClass(reactColor)) {
        $(spanClass).removeAttr("class");
        spanClass.text("Like");
        replyReactDelete(
          typeR,
          postid,
          userid,
          commentID,
          commentparentid,
          com_nf_3
        );
      } else {
        $(spanClass).removeClass().addClass(reactColor);
        spanClass.text(typeR);
        replyReactSubmit(
          typeR,
          postid,
          userid,
          commentID,
          commentparentid,
          com_nf_3
        );
      }
    } else {
      $(spanClass).addClass(reactColor);
      spanClass.text("Like");
      replyReactSubmit(
        typeR,
        postid,
        userid,
        commentID,
        commentparentid,
        com_nf_3
      );
    }
  });

  function replyReactSubmit(
    typeR,
    postid,
    userid,
    commentID,
    commentparentid,
    com_nf_3
  ) {
    $.post(
      BASE_URL + "core/ajax/replyReact.php",
      {
        commentid: commentID,
        reactType: typeR,
        postid: postid,
        userid: userid,
        commentparentid: commentparentid,
        profileid: p_id,
      },
      function (data) {
        $(com_nf_3).empty().html(data);
      }
    );
  }

  function replyReactDelete(
    typeR,
    postid,
    userid,
    commentID,
    commentparentid,
    com_nf_3
  ) {
    $.post(
      BASE_URL + "core/ajax/replyReact.php",
      {
        delcommentid: commentID,
        deleteReactType: typeR,
        postid: postid,
        userid: userid,
        commentparentid: commentparentid,
        profileid: p_id,
      },
      function (data) {
        $(com_nf_3).empty().html(data);
      }
    );
  }

  $(document).on("click", ".reply-dot", function () {
    $(".reply-dot").removeAttr("id");
    $(this).attr("id", "reply-opt-click");
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var commentid = $(this).data("commentid");
    var replyid = $(this).data("replyid");

    var replyDetails = $(this).siblings(".reply-option-details-container");
    $(replyDetails).html(
      '<div class="reply-option-details" style="z-index:2;"><ul style="padding:0;"><li class="reply-edit" data-postid="' +
        postid +
        '" data-userid="' +
        userid +
        '" data-commentid="' +
        commentid +
        '">Edit</li><li class="reply-delete" data-postid="' +
        postid +
        '" data-userid="' +
        userid +
        '" data-commentid="' +
        commentid +
        '" data-replyid="' +
        replyid +
        '">Delete</li><li class="reply-privacy" data-postid="' +
        postid +
        '" data-userid="' +
        userid +
        '">privacy</li></ul></div>'
    );
  });

  $(document).on("click", "li.reply-edit", function () {
    var comTextContainer = $(this)
      .parents(".reply-dot-option-wrap")
      .siblings(".com-pro-text")
      .find(".com-text");

    var addId = $(comTextContainer).attr("id", "editReplyPut");
    var getComText1 = $(comTextContainer).text();
    var postid = $(comTextContainer).data("postid");
    var userid = $(comTextContainer).data("userid");
    var commentid = $(comTextContainer).data("commentid");
    var replyid = $(comTextContainer).data("replyid");
    var profilepic = $(comTextContainer).data("profilepic");
    var getComText = getComText1.replace(/\s+/g, " ").trim();

    $(".top-box-show").html(
      '<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Comment</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' +
        profilepic +
        '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editReply align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' +
        getComText +
        '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-reply-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' +
        postid +
        '" data-userid="' +
        userid +
        '" data-commentid="' +
        commentid +
        '" data-replyid="' +
        replyid +
        '">Save</div></div></div>'
    );
  });

  $(document).on("click", ".edit-reply-save", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var commentid = $(this).data("commentid");
    var replyid = $(this).data("replyid");
    var editedText = $(this)
      .parents(".edit-post-submit")
      .siblings(".edit-post-value")
      .find(".editReply");

    var editedTextVal = $(editedText).val();

    $.post(
      BASE_URL + "core/ajax/editReply.php",
      {
        postid: postid,
        userid: userid,
        editedTextVal: editedTextVal,
        commentid: commentid,
        replyid: replyid,
      },
      function (data) {
        $("#editReplyPut").html(data).removeAttr("id");
        $(".top-box-show").empty();
      }
    );
  });

  $(document).on("click", ".reply-delete", function () {
    var postid = $(this).data("postid");
    var userid = $(this).data("userid");
    var commentid = $(this).data("commentid");
    var replyid = $(this).data("replyid");
    var replyContainer = $(this).parents(".new-reply");

    var r = confirm("Do you want to delete the comment?");
    if (r == true) {
      $.post(
        BASE_URL + "core/ajax/editReply.php",
        {
          deleteReply: postid,
          userid: userid,
          commentid: commentid,
          replyid: replyid,
        },
        function (data) {
          $(replyContainer).empty();
        }
      );
    }
  });
});
