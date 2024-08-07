<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if (isset($_POST['imgName'])) {

    $imgName = $loadFromUser->checkInput($_POST['imgName']);
    $userid = $loadFromUser->checkInput($_POST['userid']);

    $loadFromUser->update('profile', $userid, array('coverPic' => $imgName));
    //echo $imgName;

} else {
    echo 'Cover photo not found';
}

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
} else {
    $path_directory = $_SERVER['DOCUMENT_ROOT'] . "/facebook/user/" . $userid . "/coverphoto/"; // the image is stored in this folder in the local machine
    if (!file_exists($path_directory) && !is_dir($path_directory)) {
        mkdir($path_directory, 0777, true);
    }
    move_uploaded_file($_FILES['file']['tmp_name'], $path_directory . $_FILES['file']['name']);
}

echo 'user/' . $userid . '/coverphoto/' . $_FILES['file']['name']; // returns the actual image file as 'data' in success function in $('#cover-upload').on('change', ..)
