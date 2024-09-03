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
$requestCheck = $loadFromUser->requestCheck($userid, $profileId);
$requestConf = $loadFromUser->requestConf($profileId, $userid);
$followCheck = $loadFromUser->followCheck($profileId, $userid);
$requestData = $loadFromUser->requestData($profileId);
$friendsdata = $loadFromUser->friendsdata($profileId);
$followersdata = $loadFromUser->followersdata($profileId);
$notification = $loadFromNotif->notification($userid);
$notificationCount = $loadFromNotif->notificationCount($userid);
$requestNotificationCount = $loadFromNotif->requestNotificationCount($userid);
$messageNotification = $loadFromNotif->messageNotificationCount($userid);

?>