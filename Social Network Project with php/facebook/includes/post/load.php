<?php

require 'C:\\xampp\\htdocs\\facebook\\connect\\login.php';
require 'C:\\xampp\\htdocs\\facebook\\core\\load.php';

if (login::isLoggedIn()) {
    $user_id = login::isLoggedIn();
} else {
    header('location: sign.php');
}

if (isset($_GET['postid']) == true && empty($_GET['postid']) === false) {
    $postid = $_GET['postid'];
    // $profileid = $_GET['profileid'];
    $username = $loadFromUser->checkInput($_GET['username']);
    $profileId = $loadFromUser->userIdByUsername($username);
} else {
    $profileId = $user_id;
}
$profileData = $loadFromUser->userData($profileId);
$userData = $loadFromUser->userData($user_id);

$requestCheck = $loadFromPost->requestCheck($user_id, $profileId);
$requestConf = $loadFromPost->requestConf($profileId, $user_id);
$followCheck = $loadFromPost->followCheck($profileId, $user_id);

$notification = $loadFromNotif->notification($user_id);
$notificationCount = $loadFromNotif->notificationCount($user_id);
$requestNotificationCount = $loadFromNotif->requestNotificationCount($user_id);
$messageNotification = $loadFromNotif->messageNotificationCount($user_id);

$post = $loadFromPost->postDetails($postid);

$main_react = $loadFromPost->main_react($user_id, $post->post_id);
$react_max_show = $loadFromPost->react_max_show($post->post_id);
$main_react_count = $loadFromPost->main_react_count($post->post_id);

$commentDetails = $loadFromPost->commentFetch($post->post_id);
$totalCommentCount = $loadFromPost->totalCommentCount($post->post_id);

$totalShareCount = $loadFromPost->totalShareCount($post->post_id);
if (empty($post->shareId)) {
} else {
    $shareDetails = $loadFromPost->shareFetch($post->shareId, $post->postBy);
}

?>