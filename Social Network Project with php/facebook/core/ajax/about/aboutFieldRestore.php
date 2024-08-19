<?php
require "C:\\xampp\\htdocs\\facebook\\core\\load.php";
require "C:\\xampp\\htdocs\\facebook\\connect\\login.php";

$user_id = login::isLoggedIn();

if(isset($_POST['addDataType'])){
    $addData = $_POST['addDataType'];
    $dataHeading = $_POST['dataHeading'];
    $user_id = $_POST['userid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->aboutOverview($addData, $user_id, $profileid, $dataHeading);
}

?>