<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['onlyStatusText'])){
    $statusText = $_POST['onlyStatusText'];

    $postid = $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'postedOn'=>date('Y-m-d H:i:s')));    // https://www.w3schools.com/php/php_date.asp
}
if(isset($_POST['stIm'])){
    $stIm = $_POST['stIm'];
    $statusText = $_POST['statusText'];

    $postid = $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'postImage'=>$stIm, 'postedOn'=>date('Y-m-d H:i:s')));
}

?>
