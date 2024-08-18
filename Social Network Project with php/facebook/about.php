<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tony Stark</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
                                <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\requestCheckConfirm.php"; ?>
                            </article>
                        </div>

                    </section>

                    <?php require 'includes/profile/cover-button.php'; ?>

                    <section>
                        <div class="about-wrap">
                            <div class="about-header">
                                <section class="about-icon"><img src="assets/image/profile/about.JPG" alt=""></section>
                                <section class="about-text">About
                            </div>
                            <section class="hideAboutFieldRestore" style="display:none;"
                                data-userid="<?php echo $userid; ?>"
                                data-profileid="<?php echo $profileId; ?>">
                            </section>
                            <section class="hideAboutFieldRestoreHeading" style="display:none;"
                                data-userid="<?php echo $userid; ?>"
                                data-profileid="<?php echo $profileId; ?>">
                            </section>
                        </div>
                        <div class="about-main">
                            <section class="about-menu">
                                <ul>
                                    <?php
                                    $menuItems = [
                                        'overview' => 'Overview',
                                        'work-education' => 'Work and Education',
                                        'places-lived' => 'Places You\'ve Lived',
                                        'contact-basic' => 'Contact and Basic Info',
                                        'family-relation' => 'Family and Relationship',
                                        'details-you' => 'Details About You',
                                        'life-events' => 'Life Events'
                                    ];

                                    foreach ($menuItems as $class => $label) {
                                    ?>
                                        <li class="<?php echo $class; ?>"
                                            data-userid="<?php echo $userid; ?>"
                                            data-profileid="<?php echo $profileId; ?>">
                                            <span class="activeAbout"
                                                data-userid="<?php echo $userid; ?>"
                                                data-profileid="<?php echo $profileId; ?>">
                                                <?php echo $label; ?>
                                            </span>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </section>

                            <section class="about-menu-details">
                                <?php require "C:\\xampp\\htdocs\\facebook\\includes\\about\\overview.php"; ?>
                            </section>
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
</body>

</html>