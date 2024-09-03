<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if (isset($_POST['request'])) {
    $profileid = $_POST['request'];
    $userid = $_POST['userid'];

    if ($profileid != $userid) {
        $loadFromUser->create('notification', array('notificationFrom' => $userid, 'notificationFor' => $profileid, 'postid' => '0', 'type' => 'request', 'status' => '0', 'notificationCount' => '0', 'friendStatus' => '0', 'notificationOn' => date('Y-m-d H:i:s')));
    }

    $loadFromUser->create('request', array('reqtReceiver' => $profileid, 'reqtSender' => $userid, 'reqStatus' => '0', 'requestOn' => date('Y-m-d H:i:s')));
}

if (isset($_POST['confirmRequest'])) {
    $profileid = $_POST['confirmRequest'];
    $userid = $_POST['userid'];

    $loadFromUser->updateConfirmReq($profileid, $userid);
    echo 'confirmRequest';
}

if (isset($_POST['cancelSentRequest'])) {
    $cancelSentRequest = $_POST['cancelSentRequest'];
    $userid = $_POST['userid'];
    $loadFromUser->delete('request', array('reqtReceiver' => $cancelSentRequest, 'reqtSender' => $userid));
}

if (isset($_POST['unfriendRequest'])) {
    $unfriendRequest = $_POST['unfriendRequest'];
    $userid = $_POST['userid'];

    $loadFromUser->delete('request', array('reqtReceiver' => $unfriendRequest, 'reqtSender' => $userid));
    $loadFromUser->delete('request', array('reqtReceiver' => $userid, 'reqtSender' => $unfriendRequest));
}
