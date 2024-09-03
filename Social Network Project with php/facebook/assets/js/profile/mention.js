$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";
  var regex = /[#|@](\w+)$/gi;

  $(document).on("keyup", ".emojionearea-editor", function () {
    let status_text = $.trim($(this).text());
    let regex_text = status_text.match(regex);
    console.log(regex_text);

    if (regex_text != null) {
      $.post(
        BASE_URL + "core/ajax/hashtag_mention.php",
        {
          regex_text_placeholder: regex_text,
        },
        function (data) {
          $("ul.hash-men-holder").html(data);

          $("li.mention-user").click(function () {
            var mention_userLink = $(this)
              .find(".mention-name")
              .data("userlink");
            var mention_profileid = $(this)
              .find(".mention-name")
              .data("profileid");
            var status_old = $(".emojionearea-editor").text();
            var status_new = status_old.replace(regex, "");

            $(".emojionearea-editor").text(
              "" + status_new + "@" + mention_userLink + ""
            );
            $("ul.hash-men-holder").empty();
            // $.post(
            //   BASE_URL + "core/ajax/hashtag_mention.php",
            //   {
            //     mention_userLink: mention_userLink,
            //     mention_profileid: mention_profileid,
            //   },
            //   function (data) {
            //   }
            // );
          });
        }
      );
    } else {
      $("ul.hash-men-holder").empty();
    }
  });
});
