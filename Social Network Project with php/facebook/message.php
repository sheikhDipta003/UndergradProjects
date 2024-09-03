<?php require "C:\\xampp\\htdocs\\facebook\\includes\\message\\load.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
    <link rel="stylesheet" href="assets/dist/emojionearea.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/message.css">
    <link rel="stylesheet" href="assets/css/block.css">
    <link rel="stylesheet" href="assets/css/notification.css">
</head>

<body style="height:100vh; overflow:hidden;">
    <div class="loader"></div>

    <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\header.php"; ?>

    <main>
        <article class="mes-top-bar" style="display: flex; width: 100%; height: 100vh;">
            <?php require "C:\\xampp\\htdocs\\facebook\\includes\\message\\topLeft.php"; ?>
            <?php require "C:\\xampp\\htdocs\\facebook\\includes\\message\\topMiddle.php"; ?>
            <?php require "C:\\xampp\\htdocs\\facebook\\includes\\message\\topRight.php"; ?>
        </article>
        <article class="mes-rest-bar"></article>
    </main>

    <script src="assets/js/jquery.js " defer></script>
    <script src="assets/dist/emojionearea.min.js" defer></script>
    <script src="assets/js/profile/profile.js " defer></script>
    <script src="assets/js/message/message.js" defer></script>
</body>

</html>