$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";

  $(document).on("keyup", "input#main-search", function () {
    var searchText = $(this).val();
    if (searchText == "") {
      $(".search-result").empty();
    } else {
      $.post(
        BASE_URL + "core/ajax/search.php",
        {
          searchText: searchText,
        },
        function (data) {
          if (data == "") {
            $(".search-result").html("<p>No user found</p>");
          } else {
            $(".search-result").html(data);
          }
        }
      );
    }
  });
});
