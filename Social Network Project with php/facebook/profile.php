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
        <article class="main-area">
            <?php
            $blockUser = $loadFromUser->block($profileId, $userid);

            if (!empty($blockUser)) { ?>

            <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\blockUser.php";
            } else { ?>

                <section class="profile-left-wrap">
                    <section class="profile-cover-wrap" style="background-image: url(<?php echo $profileData->coverPic; ?>)">
                        <div class="upload-cov-opt-wrap">
                            <?php if ($profileId == $userid) { ?>
                                <figure class="add-cover-photo">
                                    <img src="assets/image/profile/uploadCoverPhoto.JPG" alt="">
                                    <figcaption class="add-cover-text">Add a cover photo</figcaption>
                                </figure>
                            <?php  } else { ?>
                                <section class="dont-add-cover-photo">

                                </section>
                            <?php  } ?>
                            <section class="add-cov-opt">
                                <div class="select-cover-photo">Select Photo</div>
                                <div class="file-upload">
                                    <label for="cover-upload" class="file-upload-label">Upload Photo</label>
                                    <input type="file" name="file-upload" id="cover-upload" class="file-upload-input">
                                </div>
                            </section>
                        </div>
                        <div class="cover-photo-rest-wrap">
                            <article class="profile-pic-name">
                                <section class="profile-pic">
                                    <?php if ($profileId == $userid) {
                                    ?>
                                        <div class="profile-pic-upload">
                                            <figure class="add-pro">
                                                <img src="assets//image/profile/uploadCoverPhoto.JPG" alt="">
                                                <figcaption>Update</figcaption>
                                            </figure>
                                        </div>
                                    <?php

                                    } ?>
                                    <img src="<?php echo $profileData->profilePic; ?>" alt="" class="profile-pic-me">
                                </section>
                                <section class="profile-name">
                                    <?php echo '' . $profileData->first_name . ' ' . $profileData->last_name . '' ?>
                                </section>
                            </article>

                            <article class="profile-action">
                                <?php if ($userid == $profileId) { ?>
                                    <a href="about.php">
                                        <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\editProfile.php"; ?>
                                    </a>
                                <?php } else {
                                    require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\requestCheckConfirm.php";
                                    require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\followCheck.php";
                                    require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\blockButton.php";
                                } ?>
                            </article>
                        </div>

                    </section>

                    <?php require 'includes/profile/cover-button.php'; ?>

                    <section class="bio-timeline">
                        <section class="bio-wrap">
                            <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\bio.php"; ?>
                        </section>

                        <section class="status-timeline-wrap">
                            <?php if ($profileId == $userid) { ?>

                                <?php require 'includes/profile/status.php'; ?>

                            <?php } ?>

                            <div class="ptaf-wrap">
                                <?php $loadFromPost->posts($userid, $profileId, 20); ?>
                            </div>
                        </section>
                    </section>
                </section>

                <section class="profile-right-wrap "></section>
            <?php
            }

            ?>
        </article>

        <article class="top-box-show"></article>

        <article id="adv_dem "></article>
    </main>

    <script src="assets/js/jquery.js " defer></script>
    <script src="assets/dist/emojionearea.min.js" defer></script>
    <script src="assets/js/profile/profile.js " defer></script>
</body>

</html>