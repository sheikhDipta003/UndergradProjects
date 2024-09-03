$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";

  $(document).on("click", ".block-wrap", function () {
    $(".block-show").toggle(200);
  });

  $(document).on("click", ".block-show", function () {
    var profileid = $(this).data("profileid");
    var userid = $(this).data("userid");
    
    $.post(
      BASE_URL + "core/ajax/block.php",
      {
        profileid: profileid,
        userid: userid,
      },
      function (data) {
        location.reload();
      }
    );
  });
});
