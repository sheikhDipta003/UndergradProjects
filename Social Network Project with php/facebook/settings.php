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

    <div class="userinfo"
        data-uid="<?php echo $userid ?>"
        data-firstname="<?php echo $userData->firstName; ?>"
        data-lastname="<?php echo $userData->lastName; ?>"
        data-userlink="<?php echo $userData->userLink; ?>"
        data-mobile="<?php echo $userData->mobile; ?>"
        data-email="<?php echo $userData->email; ?>">
    </div>

    <div class="settings-wrap">
        <div class="user-setting-wrap justify" style="border-top-left-radius:5px; border-top-right-radius:5px; background-color: gainsboro;">
            <h3 class="align-middle" style="color: #3f51b5">Settings</h3>
        </div>

        <div class="user-name-wrap justify">
            <div class="sett-head">Change Username</div><span class="set-changed-name"><?php echo '' . $userData->first_name . ' ' . $userData->last_name . ''; ?></span>
        </div>

        <div class="user-link-wrap justify">
            <div class="sett-head">Change User Link</div><span class="set-changed-userLink"><?php echo $userData->userLink; ?></span>
        </div>

        <div class="mobile-number-wrap justify">
            <?php if (!empty($userData->mobile)) { ?>
                <div class="sett-head">Change Mobile Number</div><span class="set-changed-mobile"><?php echo $userData->mobile; ?></span>
            <?php } else { ?>
                <div class="sett-head">Change Mobile Number</div><span class="set-changed-mobile">No mobile number has found. Add one.</span>
            <?php } ?>
        </div>

        <div class="email-id-wrap justify">
            <?php if (!empty($userData->email)) { ?>
                <div class="sett-head">Change Your Email</div><span class="set-changed-email"><?php echo $userData->email; ?></span>
            <?php } else { ?>
                <div class="sett-head">Change Your Email</div><span class="set-changed-email">No email has found. Add one.</span>
            <?php } ?>
        </div>

        <div class="user-password-wrap justify">
            <div class="sett-head">Change Password</div><span class="set-changed-password">*******</span>
        </div>
    </div>

    <div class="top-box-show2"></div>

    <script src="assets/js/jquery.js " defer></script>
    <script src="assets/dist/emojionearea.min.js" defer></script>
    <script src="assets/js/profile/profile.js " defer></script>
</body>

</html>