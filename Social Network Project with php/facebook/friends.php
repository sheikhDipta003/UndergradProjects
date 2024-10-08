<?php require "C:\\xampp\\htdocs\\facebook\\includes\\friends\\load.php"; ?>

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

            if (!empty($blockUser)) {
            ?>

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
                                } ?>
                            </article>
                        </div>

                    </section>

                    <?php require 'includes/profile/cover-button.php'; ?>

                    <section>
                        <div class="about-wrap">
                            <div class="about-header">
                                <section class="about-icon"><img src="assets/image/profile/Friends.JPG" alt=""></section>
                                <section class="about-text">Friends</section>
                                <section class="hideAboutFieldRestore" style="display:none;"
                                    data-userid="<?php echo $userid; ?>"
                                    data-profileid="<?php echo $profileId; ?>">
                                </section>
                                <section class="hideAboutFieldRestoreHeading" style="display:none;"
                                    data-userid="<?php echo $userid; ?>"
                                    data-profileid="<?php echo $profileId; ?>">
                                </section>
                                <?php
                                if ($requestData->reqCount == '0') {
                                } else {
                                    if ($userid != $profileId) {
                                    } else { ?>
                                        <section class="request-countt align-middle" style="margin-left:5px;">
                                            <div class="request-count-text">Friend Request</div>
                                            <div class="request-count-number">
                                            <?php echo $requestData->reqCount;
                                        } ?>
                                            </div>
                                        </section>
                                    <?php }
                                    ?>
                            </div>

                            <div class="friend-follow-tab" style="margin-left:0;background-color: white;padding-left: 15px;">
                                <section class="friend-tab">
                                    <div class="friend-tab"> All Friends(
                                        <?php echo count($friendsdata); ?>)
                                    </div>
                                </section>
                                <section class="follower-tab follow-tab"> Followers(
                                    <?php echo count($followersdata); ?>)
                                </section>
                            </div>

                            <div class="about-main about-main-sib">
                                <div class="friend-follower-wrap">
                                    <div class="freind-request-wrapp">
                                        <div class="about-main" style="flex-wrap:wrap;">
                                            <?php
                                            require "C:\\xampp\\htdocs\\facebook\\includes\\friends\\friendTabOpen.php";
                                            require "C:\\xampp\\htdocs\\facebook\\includes\\friends\\followerTabOpen.php";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script src="assets/js/about/about.js" defer></script>
    <script src="assets/js/friends/friends.js" defer></script>
</body>

</html>