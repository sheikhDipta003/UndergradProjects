<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Animo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/dist/emojionearea.min.css">
</head>

<body>
    <?php require './includes/profile/header.php' ?>

    <div class="u_p_id" data-uid="<?php echo $userid ?>" data-pid="<?php echo $profileId ?>"></div>

    <main>
        <article class="main-area">
            <?php
            if (!empty($blockUser)) {

            ?>
                <section class="user-block-show-wrap" style="display: flex;justify-content: center;width: 100%;">
                    <article class="user-block-show" style="margin-top:50px; border:1px solid gray; border-radius:10px;background-color:white;padding:20px; ">
                        <figure class="block-icon-wrap" style="display:flex; ">
                            <img src="assets/image/profile/block.JPG" alt="">
                            <figcaption style="font-size:18px; font-weight:600;"> Sorry, this content isn't available right now </figcaption>
                        </figure>
                        <hr>
                        <p style="font-size:13px; font-weight:300;">The link you followed may have expired, or the page may only be visible to an audience you are not in.</p> <br>
                        <div style="color:blue; display:flex; font-size:14px;">
                            <a href="<?php echo $userData->userLink; ?>">Go back to your profile </a> <a href="index.php" style="margin-left:10px;"> Go to your home page</a>
                        </div>
                    </article>
                </section>


            <?php
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
                                <?php
                                if ($userid == $profileId) { ?>
                                    <a href="about.php">
                                        <figure class="profile-edit-button" data-userid="<?php echo $userid; ?>" data-profileid="<?php echo $profileId; ?>">
                                            <img src="assets/image/profile//editProfile.JPG" alt="">
                                            <figcaption class="edit-profile-button-text" data-userid="<?php echo $userid; ?>" data-profileid="<?php echo $profileId; ?>">Edit Profile</figcaption>
                                        </figure>
                                    </a>

                                <?php } ?>
                            </article>
                        </div>

                    </section>

                    <?php require 'includes/profile/cover-button.php'; ?>

                    <section class="bio-timeline">

                        <section class="bio-wrap">
                            <article class="bio-intro">
                                <figure class="intro-wrap">
                                    <img src="assets/image/profile/intro.JPG" alt="">
                                    <figcaption>Intro</figcaption>
                                </figure>
                                <figure class="intro-icon-text">
                                    <img src="assets/image/profile/addBio.JPG" alt="">
                                    <figcaption class="add-bio-text">Add a short bio to tell people more yourself.</figcaption>
                                    <span class="add-bio-click"><a href="">Add Bio</a></span>
                                </figure>
                                <div class="bio-details">
                                    <figure class="bio-1">
                                        <img src="assets/image/profile/livesIn.JPG" alt="">
                                        <figcaption class="live-text">Lives in <span class="live-text-css blue">Chittagong</span></figcaption>
                                    </figure>
                                    <figure class="bio-2">
                                        <img src="assets/image/profile/followedBy.JPG" alt="">
                                        <figcaption class="live-text">Followed by <span class="followed-text-css blue">65 people</span></figcaption>
                                    </figure>
                                </div>
                                <div class="bio-feature">
                                    <img src="assets/image/profile/feature.JPG" alt="">
                                    <figcaption class="feat-text">
                                        Showcase what's important to you by adding people, pages, groups and more to your featured section on your public profile.
                                    </figcaption>
                                    <span class="add-feature blue">Add to Featured</span>
                                    <div class="add-feature-link blue">
                                        <span class="link-plus">+</span>
                                        <span>Add Instagram, Websites, Other Links</span>
                                    </div>
                                </div>
                            </article>
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
    <script defer>
        var userid = <?php echo json_encode($userid); ?>;
        // The PHP variable $userid is encoded to JSON format using json_encode(), ensuring it is properly formatted as a JavaScript variable. Thus the userid variable in JavaScript is initialized with the value from PHP.
    </script>
    <script src="assets/js/profile/profile.js " defer></script>
</body>

</html>