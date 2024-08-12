$(document).ready(function () {
  var u_id = $(".u_p_id").data("uid");
  var p_id = $(".u_p_id").data("pid");
  var BASE_URL = "http://localhost/facebook/";

  $(document).on("click", ".like-action", function () {
    var likeActionIcon = $(this).find(".like-action-icon img");
    var likeReactParent = $(this).parents(".like-action-wrap");
    var nf4 = likeReactParent.parents(".nf-4");
    var nf3 = nf4.siblings(".nf-3").find(".react-count-wrap");
    var reactCount = nf4.siblings(".nf-3").find(".nf-3-react-count").text();
    var postId = likeReactParent.data("postid");
    var userId = likeReactParent.data("userid");
    var spanClass = $(this).find(".like-action-text").find("span");
    var reactTypeText = spanClass.text();

    // switch color of 'like' text and button between grey and blue - blue state, i.e. liked
    if (
      spanClass.attr("class") !== undefined &&
      likeActionIcon.attr("src") === "assets/image/react/like.png"
    ) {
      likeActionIcon.attr("src", "assets/image/likeAction.JPG");
      spanClass.removeClass();
      spanClass.text("Like");
      mainReactDelete(reactTypeText, postId, userId, nf3);
    } // grey state, i.e. not liked
    else if (
      spanClass.attr("class") === undefined ||
      likeActionIcon.attr("src") === "assets/image/likeAction.JPG"
    ) {
      spanClass.addClass("like-color");
      likeActionIcon
        .attr("src", "assets/image/react/like.png")
        .addClass("reactIconSize");
      spanClass.text("Like"); // the text 'Like' is capitalized via css, so no effect in changing it here
      mainReactSubmit(reactTypeText, postId, userId, nf3);
    }
  });

  $(".like-action-wrap").hover(
    function () {
      var mainReact = $(this).find(".react-bundle-wrap");
      $(mainReact).html(
        ' <article class="react-bundle align-middle" style="position:absolute;margin-top: -43px; margin-left: -40px; display:flex; background-color:white; padding: 0 2px; border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;">' +
          ' <section class="like-react-click align-middle">' +
          ' <img class="main-icon-css" src="' +
          BASE_URL +
          'assets/image/react/like.png " alt="">' +
          "</section>" +
          ' <section class="love-react-click align-middle">' +
          ' <img class="main-icon-css" src="' +
          BASE_URL +
          'assets/image/react/love.png " alt="">' +
          "</section>" +
          ' <section class="haha-react-click align-middle">' +
          ' <img class="main-icon-css" src="' +
          BASE_URL +
          'assets/image/react/haha.png " alt="">' +
          "</section>" +
          ' <section class="wow-react-click align-middle">' +
          ' <img class="main-icon-css" src="' +
          BASE_URL +
          'assets/image/react/wow.png " alt="">' +
          "</section>" +
          ' <section class="sad-react-click align-middle">' +
          ' <img class="main-icon-css" src="' +
          BASE_URL +
          'assets/image/react/sad.png " alt="">' +
          "</section>" +
          ' <section class="angry-react-click align-middle">' +
          ' <img class="main-icon-css" src="' +
          BASE_URL +
          'assets/image/react/angry.png " alt="">' +
          "</section>" +
          "</article>"
      );
    },
    function () {
      var mainReact = $(this).find(".react-bundle-wrap");
      $(mainReact).html("");
    }
  );

  $(document).on("click", ".main-icon-css", function () {
    var likeReact = $(this).parent();
    reactReply(likeReact);
  });

  function reactReply(sClass) {
    if ($(sClass).hasClass("like-react-click")) {
      mainReactSub("like");
    } else if ($(sClass).hasClass("love-react-click")) {
      mainReactSub("love");
    } else if ($(sClass).hasClass("haha-react-click")) {
      mainReactSub("haha");
    } else if ($(sClass).hasClass("wow-react-click")) {
      mainReactSub("wow");
    } else if ($(sClass).hasClass("sad-react-click")) {
      mainReactSub("sad");
    } else if ($(sClass).hasClass("angry-react-click")) {
      mainReactSub("angry");
    } else {
      console.log("This react icon's parent class is not found");
    }
  }

  function mainReactSub(typeR) {
    var reactColor = "" + typeR + "-color";
    var pClass = $("." + typeR + "-react-click.align-middle");
    var likeReactParent = $(pClass).parents(".like-action-wrap");
    var nf4 = $(likeReactParent).parents(".nf-4");
    var nf3 = $(nf4).siblings(".nf-3").find(".react-count-wrap");

    var postId = $(likeReactParent).data("postid");
    var userId = $(likeReactParent).data("userid");
    var likeAction = $(likeReactParent).find(".like-action");
    var likeActionIcon = $(likeAction).find(".like-action-icon img");
    var spanClass = $(likeAction).find(".like-action-text").find("span");

    if ($(spanClass).hasClass(reactColor)) {
      $(spanClass).removeClass();
      spanClass.text("Like");
      $(likeActionIcon).attr("src", "assets/image/likeAction.JPG");
      mainReactDelete(typeR, postId, userId, nf3);
    } else if ($(spanClass).attr("class") !== undefined) {
      $(spanClass).removeClass().addClass(reactColor);
      spanClass.text(typeR);
      $(likeActionIcon)
        .removeAttr("src")
        .attr("src", "assets/image/react/" + typeR + ".png")
        .addClass("reactIconSize");
      mainReactSubmit(typeR, postId, userId, nf3);
    } else {
      $(spanClass).addClass(reactColor);
      spanClass.text(typeR);
      $(likeActionIcon)
        .removeAttr("src")
        .attr("src", "assets/image/react/" + typeR + ".png")
        .addClass("reactIconSize");
      mainReactSubmit(typeR, postId, userId, nf3);
    }
  }

  function mainReactSubmit(typeR, postId, userId, nf3) {
    // console.log(BASE_URL + "core/ajax/react.php");
    $.post(
      BASE_URL + "core/ajax/react.php",
      {
        reactType: typeR,
        postId: postId,
        userId: userId,
        profileId: p_id,
      },
      function (data) {
        $(nf3).empty().html(data);
      }
    );
  }

  function mainReactDelete(typeR, postId, userId, nf3) {
    // console.log(BASE_URL + "core/ajax/react.php");
    $.post(
      BASE_URL + "core/ajax/react.php",
      {
        deleteReactType: typeR,
        postId: postId,
        userId: userId,
        profileId: p_id,
      },
      function (data) {
        $(nf3).empty().html(data);
      }
    );
  }
});
