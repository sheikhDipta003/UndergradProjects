<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if (isset($_POST['editedTextVal'])) {

    $editedTextVal = $_POST['editedTextVal'];
    $userid = $_POST['userid'];
    $postid = $_POST['postid'];
    $loadFromPost->postUpd($userid, $postid, $editedTextVal);

    echo $editedTextVal;
}

if(isset($_POST['postid'])){

    $postid= $_POST['postid'];
    $userid=$_POST['userid'];
    $loadFromPost->delete($userid, $postid);

}

?>