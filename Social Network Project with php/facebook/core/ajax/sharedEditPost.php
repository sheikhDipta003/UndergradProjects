<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if (isset($_POST['sharedPostid'])) {
    $postid = $_POST['sharedPostid'];
    $userid = $_POST['userid'];
    $editedTextVal = $_POST['editedTextVal'];

    //update/edit the shareText of the shared post
    $loadFromPost->sharedPostUpd($userid, $postid, $editedTextVal);

    echo $editedTextVal;
}

if (isset($_POST['deletePost'])) {
    $postid = $_POST['deletePost'];
    $userid = $_POST['userid'];

    //delete this post along with all its comments (which includes entries for the replies) and reacts
    $loadFromUser->delete('post', array('post_id' => $postid, 'userId' => $userid));
    $loadFromUser->delete('comments', array('commentOn' => $postid, 'commentBy' => $userid));
    $loadFromUser->delete('react', array('reacBy' => $userid, 'reactOn' => $postid));
}


?>