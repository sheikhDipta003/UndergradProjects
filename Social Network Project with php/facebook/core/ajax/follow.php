<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if (isset($_POST['follow'])) {
    $follow = $_POST['follow'];
    $userid = $_POST['userid'];

    $loadFromUser->create('follow', array('sender' => $userid, 'receiver' => $follow, 'followOn' => date('Y-m-d H:i:s')));
}

if (isset($_POST['unfollow'])) {
    $unfollow = $_POST['unfollow'];
    $userid = $_POST['userid'];

    $loadFromUser->delete('follow', array('sender' => $userid, 'receiver' => $unfollow));
    $loadFromUser->delete('follow', array('sender' => $unfollow, 'receiver' => $userid));
}

?>
