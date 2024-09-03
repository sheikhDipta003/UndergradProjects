<?php

require 'C:\\xampp\\htdocs\\facebook\\core\\database\\connection.php';
require 'C:\\xampp\\htdocs\\facebook\\core\\classes\\users.php';
require 'C:\\xampp\\htdocs\\facebook\\core\\classes\\post.php';
require "C:\\xampp\\htdocs\\facebook\\core\\classes\\message.php";
require "C:\\xampp\\htdocs\\facebook\\core\\classes\\notification.php";

global $pdo;

$loadFromUser = new User($pdo);
$loadFromPost = new Post($pdo);
$loadFromMessage = new Message($pdo);
$loadFromNotif = new Notification($pdo);

define("BASE_URL", "http://localhost/facebook/");


?>
