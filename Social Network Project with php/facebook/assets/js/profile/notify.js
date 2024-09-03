$(document).ready(function () {
  // Get user ID and profile ID from HTML elements
  var u_id = $(".u_p_id").data("uid");
  var p_id = $(".u_p_id").data("pid");
  var BASE_URL = "http://localhost/facebook/";

  // Function to update general notifications count
  function notificationUpdate(userid) {
    $.post(
      BASE_URL + "core/ajax/notify.php", // Target PHP script
      {
        notificationUpdate: userid, // Send user ID to update notifications
      },
      function (data) {
        if (data.trim() == "0") {
          // If no new notifications
          $(".notification-count").empty(); // Clear count display
          $(".notification-count").css({
            "background-color": "transparent", // Set background to transparent
          });
        } else {
          $(".notification-count").html(data); // Update notification count
          $(".notification-count").css({
            "background-color": "red", // Set background to red
          });
        }
      }
    );
  }

  // Function to update friend request notifications count
  function requestNotificationUpdate(userid) {
    $.post(
      BASE_URL + "core/ajax/notify.php", // Target PHP script
      {
        requestNotificationUpdate: userid, // Send user ID to update requests
      },
      function (data) {
        if (data.trim() == "0") {
          // If no new friend requests
          // console.log('No new friend request');
          $(".request-count").empty(); // Clear request count display
          $(".request-count").css({
            "background-color": "transparent", // Set background to transparent
          });
        } else {
          // console.log('Someone has made a friend request');
          $(".request-count").html(data); // Update request count
          $(".request-count").css({
            "background-color": "red", // Set background to red
          });
        }
      }
    );
  }

  // Function to update message notifications count
  function messageNotificationUpdate(userid) {
    $.post(
      BASE_URL + "core/ajax/notify.php", // Target PHP script
      {
        messageNotificationUpdate: userid, // Send user ID to update messages
      },
      function (data) {
        if (data.trim() == "0") {
          // If no new messages
          $(".message-count").empty(); // Clear message count display
          $(".message-count").css({
            "background-color": "transparent", // Set background to transparent
          });
        } else {
          $(".message-count").html(data); // Update message count
          $(".message-count").css({
            "background-color": "red", // Set background to red
          });
        }
      }
    );
  }

  // Toggle the notification list display when notification icon is clicked and reset all notificationCount
  $(document).on("click", ".top-notification", function () {
    $(".notification-list-wrap").toggle(); // Show/hide notification list
    $.post(
      BASE_URL + "core/ajax/notify.php", // Send user ID to mark notifications as read
      {
        notify: u_id,
      },
      function (data) {}
    );
  });

  // Toggle the request notification list display when icon is clicked and reset 'request' notificationCount
  $(document).on("click", ".request-top-notification", function () {
    $(".request-notification-list-wrap").toggle(); // Show/hide request list
    $.post(
      BASE_URL + "core/ajax/notify.php", // Send user ID to mark friend requests as read
      {
        requestNotify: u_id,
      },
      function (data) {}
    );
  });

  // Reset 'message' notificationCount
  $(document).on("click", ".message-top-notification", function () {
    $.post(
      BASE_URL + "core/ajax/notify.php", // Send user ID to mark messages as read
      {
        messageNotify: u_id,
      },
      function (data) {}
    );
  });

  // Update general notifications count every second
  var notificationInterval;
  var userid = u_id;
  notificationInterval = setInterval(function () {
    notificationUpdate(userid); // Repeatedly call notification update function
  }, 1000);

  // Update request notifications count every second
  var requestNotificationInterval;
  var userid = u_id;
  requestNotificationInterval = setInterval(function () {
    requestNotificationUpdate(userid); // Repeatedly call request update function
  }, 1000);

  // Update message notifications count every second
  var messageNotificationInterval;
  var userid = u_id;
  messageNotificationInterval = setInterval(function () {
    messageNotificationUpdate(userid); // Repeatedly call message update function
  }, 1000);

  // Mark notification as read when clicked
  $(document).on("click", ".unread-notification", function () {
    $(this).removeClass("unread-notification").addClass("read-notification"); // Change class from unread to read
    var postid = $(this).data("postid");
    var notificationId = $(this).data("notificationid");
    var profileid = $(this).data("profileid");
    var userid = u_id;

    $.post(
      BASE_URL + "core/ajax/notify.php", // Send IDs to update notification status
      {
        statusUpdate: userid,
        profileid: profileid,
        postid: postid,
        notificationId: notificationId,
      },
      function (data) {}
    );
  });
});
