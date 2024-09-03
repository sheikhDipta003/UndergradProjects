$(document).ready(function () {
  // Retrieve user information from data attributes
  var u_id = $(".userinfo").data("uid");
  var f_n = $(".userinfo").data("firstname");
  var l_n = $(".userinfo").data("lastname");
  var u_l = $(".userinfo").data("userlink");
  var m_n = $(".userinfo").data("mobile");
  var e_m = $(".userinfo").data("email");
  const BASE_URL = "http://localhost/facebook/";

  // Event handler for clicking on the user name section
  $(document).on("click", ".user-name-wrap", function () {
    // Display the name change form with pre-filled current values
    $(".top-box-show2").html(
      '<div class="change-input-wrap">' +
        '<div class="change-input">' +
          '<h3>Change your name</h3>' +
          '<label for="first-name-change">First Name: </label>' +
          '<input type="text" name="" id="first-name-change" value="' + f_n + '" class="input-style">' +
          '<label for="last-name-change"> Last Name: </label>' +
          '<input type="text" name="" id="last-name-change" value="' + l_n + '" class="input-style">' +
          '<br><br>' +
          '<input type="submit" value="Submit" id="name-change-submit" data-userid="' + u_id + '" class="input-style">' +
        '</div>' +
      '</div>'
    );
  });

  // Event handler for submitting the name change form
  $(document).on("click", "#name-change-submit", function () {
    var firstName = $("#first-name-change").val();
    var lastName = $("#last-name-change").val();

    // Check if both fields are filled
    if (firstName == "" || lastName == "") {
      alert("All field must be filled.");
    } else {
      // Send AJAX POST request to update the name
      $.post(
        BASE_URL + "core/ajax/settings.php",
        {
          changeName: u_id,
          firstName: firstName,
          lastName: lastName,
        },
        function (data) {
          // Update the displayed name and show success message
          $(".set-changed-name").html("" + firstName + " " + lastName + "");
          $(".top-box-show2").html(
            '<div class="change-input-wrap">' +
              '<div class="change-input">' +
                data +
              '</div>' +
            '</div>'
          );
          // Reload the page after 3 seconds
          setTimeout(function () {
            $(".top-box-show2").empty();
            location.reload();
          }, 3000);
        }
      );
    }
  });

  // Event handler for clicking on the user link section
  $(document).on("click", ".user-link-wrap", function () {
    // Display the user link change form with pre-filled current value
    $(".top-box-show2").html(
      '<div class="change-input-wrap">' +
        '<div class="change-input">' +
          '<h3>Change User Link</h3>' +
          '<label for="user-link-change">User Link: </label>' +
          '<input type="text" name="" id="user-link-change" value="' + u_l + '" class="input-style">' +
          '<br><br>' +
          '<input type="submit" value="Submit" id="user-link-submit" data-userid="' + u_id + '" class="input-style">' +
        '</div>' +
      '</div>'
    );
  });

  // Event handler for submitting the user link change form
  $(document).on("click", "#user-link-submit", function () {
    var userLink = $("#user-link-change").val();

    // Check if the field is filled
    if (userLink == "") {
      alert("Field is empty.");
    } else {
      // Send AJAX POST request to update the user link
      $.post(
        BASE_URL + "core/ajax/settings.php",
        {
          userLink: userLink,
          userid: u_id,
        },
        function (data) {
          // Update the displayed user link and show response message
          if (
            data.trim() ==
            '<h3 style="color:#4caf50;">User Link has changed successfully.</h3>'
          ) {
            $(".set-changed-userLink").html(userLink);
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Reload the page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              location.reload();
            }, 3000);
          } else {
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Reload the page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              location.reload();
            }, 3000);
          }
        }
      );
    }
  });

  // Event handler for clicking on the mobile number section
  $(document).on("click", ".mobile-number-wrap", function () {
    // Display the mobile number change form with pre-filled current value
    $(".top-box-show2").html(
      '<div class="change-input-wrap">' +
        '<div class="change-input">' +
          '<h3>Change Your Mobile Number</h3>' +
          '<label for="mobile-number-change">Mobile Number: </label>' +
          '<input type="text" name="" id="mobile-number-change" value="' + m_n + '" class="input-style">' +
          '<br><br>' +
          '<input type="submit" value="Submit" id="mobile-number-submit" data-userid="' + u_id + '" class="input-style">' +
        '</div>' +
      '</div>'
    );
  });

  // Event handler for submitting the mobile number change form
  $(document).on("click", "#mobile-number-submit", function () {
    var mobileChange = $("#mobile-number-change").val();

    // Check if the field is filled
    if (mobileChange == "") {
      alert("Field is empty.");
    } else {
      // Send AJAX POST request to update the mobile number
      $.post(
        BASE_URL + "core/ajax/settings.php",
        {
          mobileChange: mobileChange,
          userid: u_id,
        },
        function (data) {
          // Update the displayed mobile number and show response message
          if (
            data.trim() ==
            '<h3 style="color:#4caf50;">Mobile number has changed successfully.</h3>'
          ) {
            $(".set-changed-mobile").html(mobileChange);
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Reload the page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              location.reload();
            }, 3000);
          } else {
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Reload the page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              location.reload();
            }, 3000);
          }
        }
      );
    }
  });

  // Event handler for clicking on the email section
  $(document).on("click", ".email-id-wrap", function () {
    // Display the email change form with pre-filled current value
    $(".top-box-show2").html(
      '<div class="change-input-wrap">' +
        '<div class="change-input">' +
          '<h3>Change Your Email</h3>' +
          '<label for="email-id-change">Email: </label>' +
          '<input type="email" name="" id="email-id-change" value="' + e_m + '" class="input-style">' +
          '<br><br>' +
          '<input type="submit" value="Submit" id="email-id-submit" data-userid="' + u_id + '" class="input-style">' +
        '</div>' +
      '</div>'
    );
  });

  // Event handler for submitting the email change form
  $(document).on("click", "#email-id-submit", function () {
    var emailChange = $("#email-id-change").val();

    // Check if the field is filled
    if (emailChange == "") {
      alert("Field is empty.");
    } else {
      // Send AJAX POST request to update the email
      $.post(
        BASE_URL + "core/ajax/settings.php",
        {
          emailChange: emailChange,
          userid: u_id,
        },
        function (data) {
          // Update the displayed email and show response message
          if (
            data.trim() ==
            '<h3 style="color:#4caf50;">Email has changed successfully.</h3>'
          ) {
            $(".set-changed-email").html(emailChange);
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Reload the page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              location.reload();
            }, 3000);
          } else {
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Reload the page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              location.reload();
            }, 3000);
          }
        }
      );
    }
  });

  // Event handler for clicking on the password section
  $(document).on("click", ".user-password-wrap", function () {
    // Display the password change form
    $(".top-box-show2").html(
      '<div class="change-input-wrap">' +
        '<div class="change-input">' +
          '<h3>Change Password</h3>' +
          '<label for="old-password">Old Password: </label>' +
          '<input type="password" name="" id="old-password" value="" class="input-style">' +
          '<label for="new-password">New Password: </label>' +
          '<input type="password" name="" id="new-password" value="" class="input-style">' +
          '<br><br>' +
          '<input type="submit" value="Submit" id="password-submit" data-userid="' + u_id + '" class="input-style">' +
        '</div>' +
      '</div>'
    );
  });

  // Event handler for submitting the password change form
  $(document).on("click", "#password-submit", function () {
    var oldPassword = $("#old-password").val();
    var newPassword = $("#new-password").val();

    // Check if both fields are filled
    if (oldPassword == "" || newPassword == "") {
      alert("All field must be filled.");
    } else {
      // Send AJAX POST request to update the password
      $.post(
        BASE_URL + "core/ajax/settings.php",
        {
          oldPassword: oldPassword,
          newPassword: newPassword,
          userid: u_id,
        },
        function (data) {
          // Show response message and handle redirection
          if (
            data.trim() ==
            '<h3 style="color:#4caf50;">Password has changed successfully.</h3>'
          ) {
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Redirect to logout page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              window.location.href = "logout.php";
            }, 3000);
          } else {
            $(".top-box-show2").html(
              '<div class="change-input-wrap">' +
                '<div class="change-input">' +
                  data +
                '</div>' +
              '</div>'
            );
            // Reload the page after 3 seconds
            setTimeout(function () {
              $(".top-box-show2").empty();
              location.reload();
            }, 3000);
          }
        }
      );
    }
  });

});
