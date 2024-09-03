<?php

require 'C:\\xampp\\htdocs\\facebook\\core\\load.php';
require 'C:\\xampp\\htdocs\\facebook\\connect\\login.php';

$userid = login::isLoggedIn();

if (isset($_POST['notificationUpdate'])) {
    $userid = $_POST['notificationUpdate'];

    $notification = $loadFromNotif->notificationCount($userid);

    echo count($notification);
}

if (isset($_POST['requestNotificationUpdate'])) {
    $userid = $_POST['requestNotificationUpdate'];

    $notification = $loadFromNotif->requestNotificationCount($userid);

    echo count($notification);
}

if (isset($_POST['messageNotificationUpdate'])) {
    $userid = $_POST['messageNotificationUpdate'];

    $notification = $loadFromNotif->messageNotificationCount($userid);

    echo count($notification);
}

if (isset($_POST['notify'])) {
    $userid = $_POST['notify'];

    $loadFromNotif->notificationCountReset($userid);
}

if (isset($_POST['requestNotify'])) {
    $userid = $_POST['requestNotify'];

    $loadFromNotif->notificationCountReset($userid, 'request');
}

if (isset($_POST['messageNotify'])) {
    $userid = $_POST['messageNotify'];

    $loadFromNotif->notificationCountReset($userid, 'message');
}

if (isset($_POST['statusUpdate'])) {
    $userid = $_POST['statusUpdate'];
    $profileid = $_POST['profileid'];
    $notificationId = $_POST['notificationId'];
    $postid = $_POST['postid'];
    $notification = $loadFromNotif->notificationStatusUpdate($userid, $notificationId);
}

?>