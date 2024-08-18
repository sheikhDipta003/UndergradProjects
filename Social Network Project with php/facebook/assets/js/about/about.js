$(document).ready(function () {
  const BASE_URL = "http://localhost/facebook/";

  $(document).on("click", "li", function () {
    var itemClass = $(this).attr("class").split(" ")[0]; // Extract the first class name
    var postDataKey = "";

    switch (itemClass) {
      case "overview":
        postDataKey = "overview";
        break;
      case "work-education":
        postDataKey = "workEducation";
        break;
      case "places-lived":
        postDataKey = "placesLived";
        break;
      case "contact-basic":
        postDataKey = "contactBasic";
        break;
      case "family-relation":
        postDataKey = "familyRelation";
        break;
      case "details-you":
        postDataKey = "aboutYou";
        break;
      case "life-events":
        postDataKey = "lifeEvent";
        break;
    }

    if (postDataKey) {
      $(".activeAbout").removeClass();
      $(this).find("span").addClass("activeAbout");

      var userid = $(this).data("userid");
      var profileid = $(this).data("profileid");

      $.post(
        BASE_URL + "core/ajax/about/aboutSubmit.php",
        {
          [postDataKey]: userid,
          profileid: profileid,
        },
        function (data) {
          $(".about-menu-details").html(data);
        }
      );
    }
  });

  function showAboutField(addData, placeholder) {
    $(document).on("click", ".add-" + addData + ".align-middle", function () {
      $(".hideAboutFieldRestore").text(addData);
      var heading = $("." + addData + "").text();
      $(".hideAboutFieldRestoreHeading").text(heading);

      var inputVal = $(this).find(".about-success").text();
      var userid = $(this).data("userid");
      var profileid = $(this).data("profileid");
      $(this).removeClass().addClass("db-return");
      $(this).html(
        '<div><input type="text" name="textfield" class="about-class" value="' +
          (inputVal != "" ? inputVal : "") +
          '" placeholder="' +
          placeholder +
          '"><div class="' +
          addData +
          '-submit about-submit" data-userid="' +
          userid +
          '" data-profileid="' +
          profileid +
          '">Save Changes</div></div> '
      );
    });
  }

  showAboutField("workplace", "Company, position, city");
  showAboutField("professional", "Add professinal skills");
  showAboutField("college", "Add a college");
  showAboutField("highSchool", "Add High School");
  showAboutField("currentCity", "Add your current City");
  showAboutField("hometown", "Add your hometwon");
  showAboutField("address", "Add address");
  showAboutField("website", "www.example.com");
  showAboutField("otherPlace", "Add otherplace");
  showAboutField("socialLink", "e.g: URL of Instagram, Snapchat etc");
  showAboutField("language", "Add language");
  showAboutField("religion", "Add religiouse view");
  showAboutField("politicalViews", "Add political view");
  showAboutField("relationship", "e.g: Single/Married/Widow/Complicated");
  showAboutField("aboutYou", "Write about you");
  showAboutField("quotes", "Write your favourite quotes");
  showAboutField("otherName", "Your nickname");
  showAboutField("lifeEvent", "Add live events");

  function aboutFieldSubmit(aboutData) {
    $(document).on(
      "click",
      "." + aboutData + "-submit.about-submit",
      function () {
        $(this)
          .parents(".db-return")
          .removeClass()
          .addClass("add-" + aboutData + " align-middle");
        var db_returnClass = $(this).parents(
          ".add" + aboutData + ".align-middle"
        );
        // alert(db_returnClass);
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents(".db-return");
        var inputVal = $(this).siblings(".about-class").val();
        aboutSubmit(
          aboutData,
          inputVal,
          userid,
          profileid,
          dbReturn,
          db_returnClass
        );
      }
    );
  }

  aboutFieldSubmit("workplace");
  aboutFieldSubmit("professional");
  aboutFieldSubmit("college");
  aboutFieldSubmit("highSchool");
  aboutFieldSubmit("currentCity");
  aboutFieldSubmit("hometown");
  aboutFieldSubmit("otherPlace");
  aboutFieldSubmit("address");
  aboutFieldSubmit("website");
  aboutFieldSubmit("socialLink");
  aboutFieldSubmit("language");
  aboutFieldSubmit("religion");
  aboutFieldSubmit("politicalViews");
  aboutFieldSubmit("relationship");
  aboutFieldSubmit("aboutYou");
  aboutFieldSubmit("otherName");
  aboutFieldSubmit("quotes");
  aboutFieldSubmit("lifeEvent");

  function aboutSubmit(
    submitType,
    inputVal,
    userid,
    profileid,
    dbReturn,
    db_returnClass
  ) {
    $.post(
      BASE_URL + "core/ajax/about/aboutSubmit.php",
      {
        submitType: submitType,
        inputVal: inputVal,
        userid: userid,
        profileid: profileid,
      },
      function (data) {
        $(db_returnClass)
          .empty()
          .html('<span class="about-success" >' + data + " </span>");
      }
    );
  }

  $(document).mouseup(function (e) {
    var container = new Array();
    var userid = $(".hideAboutFieldRestore").data("userid");
    var profileid = $(".hideAboutFieldRestore").data("profileid");
    var addData = $(".hideAboutFieldRestore").text();
    var dataHeading = $(".hideAboutFieldRestoreHeading").text();
    container.push($(".db-return"));

    $.each(container, function (key, value) {
      if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
        $(".db-return")
          .removeClass()
          .addClass("add-" + addData + " align-middle");
        $.post(
          BASE_URL + "core/ajax/about/aboutFieldRestore.php",
          {
            addDataType: addData,
            dataHeading: dataHeading,
            userid: userid,
            profileid: profileid,
          },
          function (data) {
            $(".add-" + addData + "").html(data);
          }
        );
      }
    });
  });
});
