<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if (isset($_POST['postid'])) {
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $editedTextVal = $_POST['editedTextVal'];
    $commentid = $_POST['commentid'];

    //update the comment with the new info and return edited comment text
    $loadFromPost->commentUpd($userid, $postid, $editedTextVal, $commentid);

    echo $editedTextVal;
}

if (isset($_POST['deletePost'])) {
    $postid = $_POST['deletePost'];
    $userid = $_POST['userid'];
    $commentid = $_POST['commentid'];

    //delete the comment and all the reacts associated with it
    $loadFromUser->delete('comments', array('commentID' => $commentid, 'commentOn' => $postid, 'commentBy' => $userid));
    $loadFromUser->delete('react', array('reactCommentOn' => $commentid, 'reactOn' => $postid, 'reactBy' => $userid));
}

?>