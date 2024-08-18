<?php
if ($userid == $profileId) { ?>
    <a href="about.php">
        <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\editProfile.php"; ?>
    </a>

    <?php } else {
    if (empty($requestCheck)) {
        if (empty($requestConf)) {  ?>

            <div class="profile-add-friend"
                data-userid="<?php echo $userid; ?>"
                data-profileid="<?php echo $profileId; ?>">
                <img src="assets/image/friendRequestGray.JPG" alt="">
                <div class="edit-profile-button-text">Add Friend</div>
            </div>

        <?php

        } else if ($requestConf->reqStatus == '0') { ?>
            <div class="profile-friend-confirm"
                data-userid="<?php echo $userid; ?>"
                data-profileid="<?php echo $profileId; ?>">
                <div class="edit-profile-confirm-button" style="position:relative;">
                    <div class="con-req accept-req align-middle"
                        data-userid="<?php echo $userid; ?>"
                        data-profileid="<?php echo $profileId; ?>">
                        <img src="assets/image/friendRequestGray.JPG" alt="">
                        Confirm Request
                    </div>
                    <div class="request-cancel"
                        data-userid="<?php echo $userid; ?>"
                        data-profileid="<?php echo $profileId; ?>">
                        Cancel Request
                    </div>
                </div>
            </div>


        <?php
        } else if ($requestConf->reqStatus == '1') { ?>
            <div class="profile-friend-confirm"
                data-userid="<?php echo $userid; ?>"
                data-profileid="<?php echo $profileId; ?>">
                <div class="edit-profile-confirm-button" style="position:relative;">
                    <div class="con-req align-middle">
                        <img src="assets/image/rightsignGray.JPG" alt="">Friend
                    </div>
                    <div class="request-unfriend"
                        data-userid="<?php echo $userid; ?>"
                        data-profileid="<?php echo $profileId; ?>">
                        Unfriend
                    </div>
                </div>
            </div>

        <?php

        } else {
        }
    } else if ($requestCheck->reqStatus == '0') { ?>

        <div class="profile-friend-sent"
            data-userid="<?php echo $userid; ?>"
            data-profileid="<?php echo $profileId; ?>">
            <img src="assets/image/friendRequestGray.JPG" alt="">
            <div class="edit-profile-button-text">Friend Request Sent</div>
        </div>
    <?php
    } else if ($requestCheck->reqStatus == '1') { ?>
        <div class="profile-friend-confirm"
            data-userid="<?php echo $userid; ?>"
            data-profileid="<?php echo $profileId; ?>">
            <div class="edit-profile-confirm-button" style="position:relative;">
                <div class="con-req align-middle">
                    <img src="assets/image/rightsignGray.JPG" alt="">Friend
                </div>
                <div class="request-unfriend"
                    data-userid="<?php echo $userid; ?>"
                    data-profileid="<?php echo $profileId; ?>">
                    Unfriend
                </div>
            </div>
        </div>

<?php
    } else {
        echo 'Not found';
    }

    require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\followCheck.php";
}

?>