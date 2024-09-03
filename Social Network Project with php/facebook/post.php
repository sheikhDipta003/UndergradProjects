<?php require "C:\\xampp\\htdocs\\facebook\\includes\\post\\load.php"; ?>

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
        data-uid="<?php echo $user_id ?>"
        data-pid="<?php echo $profileId ?>">
    </div>

    <main>
        <article class="main-area">
            <?php
            $blockUser = $loadFromUser->block($profileId, $user_id);
            
            if (!empty($blockUser)) { ?>

            <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\blockUser.php";
            } else { ?>

                <section class="bio-timeline" style="width: 95%;">
                    <section class="status-timeline-wrap">
                        <div class="ptaf-wrap">
                            <?php
                            $userdata = $loadFromPost->userData($user_id);
                            $obj = $loadFromPost;
                            require "C:\\xampp\\htdocs\\facebook\\core\\classes\\postHelp.php"; ?>
                        </div>
                    </section>
                </section>
                </section>
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