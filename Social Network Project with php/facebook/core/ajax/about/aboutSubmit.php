<?php

require "C:\\xampp\\htdocs\\facebook\\core\\load.php";
require "C:\\xampp\\htdocs\\facebook\\connect\\login.php";

$user_id = login::isLoggedIn();

if (isset($_POST['submitType'])) {
    $submitType = $_POST['submitType'];
    $inputVal = $_POST['inputVal'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->update('profile', $userid, array($submitType => $inputVal));
    echo $inputVal;
}

$postKeys = [
    'overview' => 'overview.php',
    'workEducation' => 'workEducation.php',
    'placesLived' => 'placesLived.php',
    'contactBasic' => 'contactBasic.php',
    'familyRelation' => 'familyRelation.php',
    'aboutYou' => 'aboutYou.php',
    'lifeEvent' => 'lifeEvent.php'
];

foreach ($postKeys as $key => $file) {
    if (isset($_POST[$key])) {
        $userid = $_POST[$key];
        $profileId = $_POST['profileid'];
        $userData = $loadFromUser->userdata($profileId);

        require "C:\\xampp\\htdocs\\facebook\\includes\\about\\" . $file;
        break;
    }
}


?>