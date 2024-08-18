<?php

include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();

if(isset($_POST['shareText'])){
    $shareText = $_POST['shareText'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    //create a new entry in the post table containing the 'share' information of the post
    $loadFromUser->create('post', array('userId'=>$userid, 'shareId' => $postid, 'sharedFrom'=>$profileid, 'sharedBy'=>$userid, 'shareText'=>$shareText, 'postBy'=>$profileid, 'postedOn'=>date('Y-m-d H:i:s')));
}

?>