$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";
  var u_id = $(".user-info").data("userid"); // Current user ID
  var l_id = $(".user-info").data("lastpersonid"); // Last interacted user ID
  var useridForAjax;
  var lastpersonid;

  $(".emojionearea-editor").text("");

  // Initialize emoji picker on message input
  $("textarea#msgInput").emojioneArea({
    pickerPosition: "top",
    spellcheck: true,
  });

  // Fetch and display the list of users
  function userLoad() {
    $.post(
      BASE_URL + "core/ajax/message/messageFetch.php",
      {
        loadUserid: u_id,
      },
      function (data) {
        $("ul.msg-user-add").html(data);
      }
    );
  }

  userLoad();

  // Fetch and display messages from the last interacted user, if any
  if (l_id != "") {
    $.post(
      BASE_URL + "core/ajax/message/messageFetch.php",
      {
        lastpersonid: l_id,
        userid: u_id,
      },
      function (data) {
        $(".msg-box").html(data);
        scrollItself();
        $(".loader").hide();
      }
    );
  } else {
    $(".loader").hide();
  }

  // Assign user and last person IDs
  function assign_u_l_id(var1, var2) {
    if (var1 === undefined || var2 === undefined) {
      return (useridForAjax = u_id), (lastpersonid = l_id);
    } else {
      return (useridForAjax = var1), (lastpersonid = var2);
    }
  }

  // Call function to assign IDs
  function call_assign_u_l_id(arg1, arg2, callback) {
    if (typeof callback == "function") {
      callback(arg1, arg2);
    } else {
      alert("Argument is not function type");
    }
  }

  // Send message on Enter key press
  setTimeout(function () {
    $(document).on("keyup", ".emojionearea .emojionearea-editor", function (e) {
      if (e.keyCode == 13) {   //'enter' key
        var rawMsg = $(this).html();
        if (useridForAjax === undefined) {
          call_assign_u_l_id(useridForAjax, lastpersonid, assign_u_l_id);
        }
        var msg = rawMsg.slice(0, -15); // Remove emoji span from message
        $.ajax({
          type: "POST",
          url: BASE_URL + "core/ajax/message/message.php",
          data: {
            useridForAjax: useridForAjax,
            lastpersonid: lastpersonid,
            msg: msg,
          },
          success: function (data) {
            userLoad(); // Reload user list
            $(".msg-box").html(data); // Update message box
            $(this).text(""); // Clear input
            scrollItself(); // Scroll to bottom
          },
        });
      }
    });
  }, 500);

  // Scroll to the bottom of the message container
  function scrollItself() {
    var elViewHeight = $(".msgg-details").height();
    var elTotalHeight = $(".msgg-details")[0].scrollHeight;
    if (elTotalHeight > elViewHeight) {
      $(".msgg-details").scrollTop(elTotalHeight - elViewHeight);
    }
  }
  
  scrollItself();

  // Load messages and check for updates
  function loadMessage() {
    var pastDataCount = $(".past-data-count").data("datacount");

    $.ajax({
      type: "POST",
      url: BASE_URL + "core/ajax/message/message.php",
      data: {
        showmsg: l_id,
        yourid: u_id,
      },
      success: function (data) {
        $(".msg-box").html(data);
      },
    });

    $.post(
      BASE_URL + "core/ajax/message/message.php",
      {
        dataCount: l_id,
        profileid: u_id,
      },
      function (data) {
        if (pastDataCount == data) {
          // console.log("data is same");
        } else {
          scrollItself(); // Scroll to bottom if new data
          // console.log("data is not same");
        }
      }
    );
  }

  var loadTimer = setInterval(function () {
    loadMessage(); // Check for new messages every second
  }, 1000);

  // Search for users
  $(document).on("keyup", "input.user-search", function () {
    var searchText = $(this).val();

    if (searchText == "") {
      $(".user-show").empty(); // Clear search results
    } else {
      $.post(
        BASE_URL + "core/ajax/message/searchMsgUser.php",
        {
          msgUser: searchText,
          userid: u_id,
        },
        function (data) {
          if (data == "") {
            console.log("No user found.");
          } else {
            $(".user-show").html(data); // Display search results
          }
        }
      );
    }
  });
  
  var intervalId;
  var intervalIdtwo;
  $(document).on("click", "li.mention-individuals", function () {
    $(".user-search").val(""); // Clear search input
    $(".loader").show();
    clearInterval(loadTimer); // Stop regular message loading

    var otheridFromSearch = $(this).data("profileid");
    var searchImage = $(this).find("img.search-image").attr("src");
    var searchName = $(this).find(".mention-name").text();
    $(".users-right-pro-pic img").attr("src", searchImage);
    $(".users-right-pro-name").text(searchName);

    $(".user-info").attr("data-lastpersonid", otheridFromSearch);

    call_assign_u_l_id(u_id, otheridFromSearch, assign_u_l_id);

    $.post(
      BASE_URL + "core/ajax/message/message.php",
      {
        showmsg: otheridFromSearch,
        yourid: useridForAjax,
      },
      function (data) {
        $(".msg-box").html(data);
        $(".user-show").empty(); // Clear user search results
        $(".top-msg-user-photo").attr("src", searchImage);
        $(".top-msg-user-name").text(searchName);
        scrollItself(); // Scroll to bottom
        $(".loader").hide();
      }
    );

    if (!intervalId) {
      intervalId = setInterval(function () {
        loadMessageFromSearch(useridForAjax, otheridFromSearch); // Load messages for selected user
      }, 1000);

      clearInterval(intervalIdtwo);
      intervalIdtwo = null;
    } else if (!intervalIdtwo) {
      clearInterval(intervalId);
      intervalId = null;
      intervalIdtwo = setInterval(function () {
        loadMessageFromSearch(useridForAjax, otheridFromSearch); // Load messages for selected user
      }, 1000);
    } else {
      alert("Nothing found");
    }
  });

  // Load messages for the selected user from search
  function loadMessageFromSearch(useridForAjax, otheridFromSearch) {
    var pastDataCount = $(".past-data-count").data("datacount");

    $.ajax({
      type: "POST",
      url: BASE_URL + "core/ajax/message/message.php",
      data: {
        showmsg: otheridFromSearch,
        yourid: useridForAjax,
      },
      success: function (data) {
        $(".msg-box").html(data);
        $(".loader").hide();
      },
    });

    $.post(
      BASE_URL + "core/ajax/message/message.php",
      {
        dataCount: otheridFromSearch,
        profileid: useridForAjax,
      },
      function (data) {
        if (pastDataCount == data) {
          // console.log("data is same");
        } else {
          scrollItself(); // Scroll to bottom if new data
          // console.log("data is not same");
        }
      }
    );
  }

  // Highlight selected user in the user list
  $(document).on("click", "ul.msg-user-add > li", function () {
    $("ul.msg-user-add > li").css("background-color", "#e9ebee");
    $(this).css("background-color", "lightgray");
  });

  // Handle click on user from the message list
  $(document).on("click", "li.msg-user-name-wrap.align-middle", function () {
    $(".loader").show();
    var profileName = $(this).find(".msg-user-name").text();
    var userProPic = $(this).find(".msg-user-photo img").attr("src");
    $(".top-msg-user-photo").attr("src", userProPic);
    $(".top-msg-user-name").text(profileName);
    $(".users-right-pro-pic img").attr("src", userProPic);
    $(".users-right-pro-name").text(profileName);
    clearInterval(loadTimer); // Stop regular message loading
    scrollItself(); // Scroll to bottom

    var userProfileId = $(this).data("profileid");

    call_assign_u_l_id(u_id, userProfileId, assign_u_l_id);

    if (!intervalId) {
      intervalId = setInterval(function () {
        loadMessageFromSearch(useridForAjax, userProfileId); // Load messages for selected user
      }, 1000);

      clearInterval(intervalIdtwo);
      intervalIdtwo = null;
    } else if (!intervalIdtwo) {
      clearInterval(intervalId);
      intervalId = null;
      intervalIdtwo = setInterval(function () {
        loadMessageFromSearch(useridForAjax, userProfileId); // Load messages for selected user
      }, 1000);
    } else {
      alert("Nothing found");
    }
  });
});
