$(document).ready(function () {
  var u_id = $(".u_p_id").data("uid");
  const BASE_URL = "http://localhost/facebook/";

  // Function to dynamically load a JavaScript file
  function loadScript(url, callback) {
    var script = document.createElement("script");
    script.type = "text/javascript";

    // Call the callback function once the script is loaded
    script.onload = function () {
      callback();
    };

    script.src = url;
    document.head.appendChild(script);
  }

  $(".add-cover-photo").on("click", function () {
    $(".add-cov-opt").toggle();
  });

  $("#cover-upload").on("change", function () {
    var name = $("#cover-upload").val().split("\\").pop();
    var file_data = $("#cover-upload").prop("files")[0];
    var imgName = "user/" + u_id + "/coverphoto/" + name + "";

    var form_data = new FormData();

    form_data.append("file", file_data);

    if (name != "") {
      // store the cover photo data in the database
      $.post(
        BASE_URL + "core/ajax/profile.php",
        {
          imgName: imgName,
          userid: u_id,
        },
        function (data) {
          // alert(data);
        }
      );
    }

    // move the profile photo into the local folder user/:userid/coverphoto
    $.ajax({
      url: BASE_URL + "core/ajax/profile.php",
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: "post",
      success: function (data) {
        $(".profile-cover-wrap").css("background-image", "url('" + data + "')");
        $(".add-cov-opt").hide();
      },
    });
  });

  $(".profile-pic-upload").on("click", function () {
    $(".top-box-show").html(`
            <article class="top-box align-vertical-middle profile-dialoge-show">
              <section class="profile-pic-upload-action">
                <div class="pro-pic-up">
                  <div class="file-upload">
                    <label for="profile-upload" class="file-upload-label">
                      <span class="upload-plus-text align-middle">
                        <span class="upload-plus-sign">+</span>Upload Photo
                      </span>
                    </label>
                    <input type="file" name="file-upload" id="profile-upload" class="file-upload-input">
                  </div>
                </div>
                <section class="pro-pic-choose"></section>
              </section>
            </article>
        `);
  });

  $(document).on("change", "#profile-upload", function () {
    var name = $("#profile-upload").val().split("\\").pop();
    var file_data = $("#profile-upload").prop("files")[0];
    var imgName = "user/" + u_id + "/profilePhoto/" + name + "";
    var form_data = new FormData();
    form_data.append("file", file_data);

    if (name != "") {
      // store the profile photo data in the database
      $.post(
        BASE_URL + "core/ajax/profilePhoto.php",
        {
          imgName: imgName,
          userid: u_id,
        },
        function () {
          //                            $('#adv_dem').html(/data);
        }
      );

      // move the profile photo into the local folder user/:userid/profilePhoto
      $.ajax({
        url: BASE_URL + "core/ajax/profilePhoto.php",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post",
        success: function (data) {
          $(".profile-pic-me").attr("src", " " + data + " ");
          $(".profile-dialoge-show").hide();
        },
      });
    }
  });

  $("#statusEmoji").emojioneArea({
    pickerPosition: "right",
    spellcheck: true,
  });

  $(document).on("click", ".emojionearea-editor", function () {
    $(".status-share-button-wrap").show("0.5");
  });

  $(document).on("click", ".status-bot", function () {
    $(".status-share-button-wrap").show("0.5");
  });

  $(document).on("change", "#multiple_files", function (e) {
    var files = e.target.files; // Get the files from the input element
    // The files property of e.target is automatically created and is a standard property of file input elements in HTML. When a user selects files using an <input type="file" multiple>, the files property is populated with a FileList object containing the selected files.
    console.log("files = ", files);

    // Iterate over each file selected
    $.each(files, function (i, file) {
      var reader = new FileReader(); // Create a new FileReader object

      reader.readAsDataURL(file); // Read the file's content as a data URL(data:[<mediatype>][;base64],<data>)

      reader.onload = function (e) {
        // Create a template for displaying the image with the file's data URL; result property of FileReader object contains the url to the file
        var template =
          '<li class="ui-state-default del" style="position:relative;"><img id="' +
          file.name +
          '" style="width:60px; height:60px" src="' +
          e.target.result +
          '"></li>';
        // Append the template to the element with id "sortable"
        $("#sortable").append(template);
      };
    });

    // Append a remove image button to the element with id "sortable"
    $("#sortable").append(
      '<div class="remImg" style="position:absolute; top:0;right:0;cursor:pointer; display:flex;justify-content:center; align-items:center; background-color:white; border-radius:50%; height:1rem; width:1rem; font-size: 0.694rem;">X</div>'
    );
  });

  $(document).on("click", ".remImg", function () {
    $("#sortable").empty();
    $(".input-restore")
      .empty()
      .html(
        '<label for="multiple_files" class="file-upload-label"><div class="status-bot-1"><img src="assets/image/photo.JPG" alt=""><div class="status-bot-text">Photo/Video</div></div></label><input type="file" name="file-upload" id="multiple_files" class="file-upload-input" data-multiple-caption="{count} files selected" multiple="">'
      );
  });

  $(".status-share-button").on("click", function () {
    var regex = /[#|@](\w+)$/gi;
    var statusText = $(".emojionearea-editor").html();
    var formData = new FormData();
    var storeImage = [];
    var error_images = [];
    var files = $("#multiple_files")[0].files;
    var mention_user = statusText.match(regex);

    console.log("status-share-button clicked");

    if (files.length != 0) {
      if (files.length > 10) {
        error_images += "You can not select more than 10 images";
      } else {
        for (var i = 0; i < files.length; i++) {
          var name = document.getElementById("multiple_files").files[i].name;

          storeImage +=
            '{"imageName":"user/' + u_id + "/postImage/" + name + '"},';

          var ext = name.split(".").pop().toLowerCase();

          if (jQuery.inArray(ext, ["gif", "png", "jpg", "jpeg", "mp4"]) == -1) {
            error_images += "<p>Invalid " + i + " File </p>";
          }

          var ofReader = new FileReader();
          ofReader.readAsDataURL(
            document.getElementById("multiple_files").files[i]
          );
          var f = document.getElementById("multiple_files").files[i];
          var fsize = f.size || f.fileSize;

          if (fsize > 2000000000) {
            error_images += "<p>" + i + " File Size is very big</p>";
          } else {
            formData.append(
              "file[]",
              document.getElementById("multiple_files").files[i]
            );
          }
        }
      }

      if (files.length < 1) {
      } else {
        var str = storeImage.replace(/,\s*$/, "");
        var stIm = "[" + str + "]";
      }
      if (error_images == "") {
        console.log("storing images");
        $.ajax({
          url: BASE_URL + "core/ajax/uploadPostImage.php",
          method: "POST",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
            $("#error_multiple_files").html(
              "<br/><label> Uploading...</label>"
            );
          },
          success: function (data) {
            $("#error_multiple_files").html(data);
            $("#sortable").empty();
          },
        });
      } else {
        console.log("error");
        $("#multiple_files").val("");
        $("#error_multiple_files").html("<span> " + error_images + "</span>");
        return false;
      }
    } else {
      var stIm = "";
    }

    if (stIm == "") {
      console.log("submitting post text only");
      $.post(
        BASE_URL + "core/ajax/postSubmit.php",
        {
          onlyStatusText: statusText,
          mention_user: mention_user
        },
        function (data) {
          $("adv_dem").html(data);
          location.reload();
        }
      );
    } else {
      console.log("submitting post text and image");
      $.post(
        BASE_URL + "core/ajax/postSubmit.php",
        {
          stIm: stIm,
          statusText: statusText,
          mention_user: mention_user
        },
        function (data) {
          $("#adv_dem").html(data);
          location.reload();
        }
      );
    }
  });

  $(document).on("click", ".postImage", function () {
    var userid = $(this).data("userid");
    var postid = $(this).data("postid");
    var profileid = $(this).data("profileid");
    var imageSrc = $(this).attr("src");

    console.log(
      "userid = ",
      userid,
      ", postid = ",
      postid,
      ", imageSrc = ",
      imageSrc
    );

    $.post(BASE_URL + "core/ajax/imgFetchShow/imgFetchShow.php", {
      fetchImgInfo: userid,
      postid: postid,
      imageSrc: imageSrc,
    })
      .done(function (data) {
        $(".top-box-show").html(data);
      })
      .fail(function (xhr, status, error) {
        alert("Error: " + xhr.responseText);
      });
  });

  $(document).mouseup(function (e) {
    var containers = [
      {
        element: $(".add-cov-opt"),
        action: function () {
          $(this.element).hide();
        },
      },
      {
        element: $(".profile-dialoge-show"),
        action: function () {
          $(this.element).hide();
        },
      },
      {
        element: $(".notification-list-wrap"),
        action: function () {
          $(this.element).hide();
        },
      },
      {
        element: $(".profile-status-write"),
        action: function () {
          $(".status-share-button-wrap").hide("0.2");
        },
      },
      {
        element: $(".post-img-wrap"),
        action: function () {
          $(".top-wrap").remove();
        },
      },
      {
        element: $(".post-option-details-container"),
        action: function () {
          $(this.element).empty();
        },
      },
      {
        element: $(".top-box-show"),
        action: function () {
          $(this.element).empty();
        },
      },
      {
        element: $(".com-option-details-container"),
        action: function () {
          $(this.element).empty();
        },
      },
      {
        element: $(".reply-option-details-container"),
        action: function () {
          $(this.element).empty();
        },
      },
      {
        element: $(".shared-post-option-details-container"),
        action: function () {
          $(this.element).empty();
        },
      },
      {
        element: $(".change-input"),
        action: function () {
          $(this.element).parents('.top-box-show2').empty();
        },
      },
    ];

    $.each(containers, function (index, container) {
      if (
        !container.element.is(e.target) &&
        container.element.has(e.target).length === 0
      ) {
        container.action();
      }
    });
  });

  $(document).on("click", ".watchmore-wrap", function () {
    $(".setting-logout-wrap").toggle();
  });

  $(document).on("click", ".setting-option", function () {
    window.location.href = "settings.php";
  });

  $(document).on("click", ".logout-option", function () {
    window.location.href = "logout.php";
  });

  loadScript("assets/js/profile/postEdit.js", function () {
    console.log("postEdit.js loaded successfully");
  });

  loadScript("assets/js/profile/mainReact.js", function () {
    console.log("mainReact.js loaded successfully");
  });

  loadScript("assets/js/profile/comment.js", function () {
    console.log("comment.js loaded successfully");
  });

  loadScript("assets/js/profile/reply.js", function () {
    console.log("reply.js loaded successfully");
  });

  loadScript("assets/js/profile/share.js", function () {
    console.log("share.js loaded successfully");
  });

  loadScript("assets/js/profile/search.js", function () {
    console.log("search.js loaded successfully");
  });

  loadScript("assets/js/profile/request.js", function () {
    console.log("request.js loaded successfully");
  });

  loadScript("assets/js/profile/follow.js", function () {
    console.log("follow.js loaded successfully");
  });

  loadScript("assets/js/profile/notify.js", function () {
    console.log("notify.js loaded successfully");
  });

  loadScript("assets/js/profile/settings.js", function () {
    console.log("settings.js loaded successfully");
  });

  loadScript("assets/js/profile/block.js", function () {
    console.log("block.js loaded successfully");
  });

  loadScript("assets/js/profile/mention.js", function () {
    console.log("mention.js loaded successfully");
  });
});
