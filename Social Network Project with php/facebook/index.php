<?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\load.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo '' . $profileData->firstName . ' ' . $profileData->lastName . ''; ?>
    </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/notification.css">
    <link rel="stylesheet" href="assets/css/settings.css">
    <link rel="stylesheet" href="assets/css/block.css">
    <link rel="stylesheet" href="assets/dist/emojionearea.min.css">
</head>

<body>
    <?php require './includes/profile/header.php' ?>

    <div class="u_p_id"
        data-uid="<?php echo $userid ?>"
        data-pid="<?php echo $profileId ?>">
    </div>

    <main>
        <div class="main_area" style="margin-top: 0; padding-top: 12px;">
            <!--   ////////.........start first section................//////-->

            <div class="first-section">
                <div class="active-wrap top-pic-name-wrap   ">
                    <a href="profile.php" class="top-pic-name">
                        <div class="top-pic">
                            <img src="<?php echo $profileData->profilePic; ?>" alt="">
                        </div>
                        <div class="top-name top-css" style="color:black;">
                            <?php echo '' . $profileData->firstName . ' ' . $profileData->lastName . ''; ?>
                        </div>
                    </a>
                </div>
                <br>

                <div class="news-feed">
                    <a href="index.php" class="active-wrap-2">
                        <div class="right-nav-icon">
                            <img src="assets/image/newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">News Feed</div>
                    </a>
                </div>


                <div class="news-feed ">
                    <a href="message.php" class="active-wrap-3">
                        <div class="right-nav-icon">
                            <img src="assets/image/msginnews.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Messenger</div>
                    </a>
                </div>
            </div>
            <!--   ////////.........end first section................//////-->

            <!--   ////////.........start second section................//////-->

            <div class="second-section">
                <!--                ............ Start Status write part................-->
                <?php require 'C:\\xampp\\htdocs\\facebook\\includes\\profile\\status.php'; ?>
                <!--                ............ end Status write part................-->

                <!--                ............ Start timeline part................-->

                <div class="news-feed-comp">
                    <?php $loadFromPost->posts($userid, $profileId, 20, true) ?>

                </div>
                <div class="loader-wrap align-middle " style="width: 100%;">

                </div>
                <!--                ............ end timeline................-->
            </div>
        </div>
        <div class="top-box-show"></div>
        <div id="adv_dem"></div>

    </main>

    <script src="assets/js/jquery.js " defer></script>
    <script src="assets/dist/emojionearea.min.js" defer></script>
    <script src="assets/js/profile/profile.js " defer></script>
</body>

</html>