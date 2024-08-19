<?php

include 'connect/login.php';
include 'core/load.php';

if (login::isLoggedIn()) {
    $userid = login::isLoggedIn();
} else {
    header('location: sign.php');
}

if (isset($_GET['username']) == true && empty($_GET['username']) === false) {
    $username = $loadFromUser->checkInput($_GET['username']);
    $profileId = $loadFromUser->userIdByUsername($username);
} else {
    $profileId = $userid;
}
$profileData = $loadFromUser->userData($profileId);
$userData = $loadFromUser->userData($userid);
// $requestCheck = null;
// $requestConf = null;
// $followCheck = null;
$notification = null;
$notificationCount = [];
$requestNotificationCount = null;
$messageNotification = [];
$requestCheck = $loadFromUser->requestCheck($userid, $profileId);
$requestConf = $loadFromUser->requestConf($profileId, $userid);
$followCheck = $loadFromUser->followCheck($profileId, $userid);

// $notification = $loadFromPost->notification($userid);
// $notificationCount = $loadFromPost->notificationCount($userid);
// $requestNotificationCount = $loadFromPost->requestNotificationCount($userid);
// $messageNotification = $loadFromPost->messageNotificationCount($userid);

?>