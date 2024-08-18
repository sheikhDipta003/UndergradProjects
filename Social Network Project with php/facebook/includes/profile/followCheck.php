<?php
if (empty($followCheck)) { ?>
    <div class="profile-follow-button" style="border-right:1px solid gray;"
        data-userid="<?php echo $userid; ?>"
        data-profileid="<?php echo $profileId; ?>" ">
        <img src=" assets/image/followGray.JPG" alt="">
        <div class="profile-activity-button-text">Follow</div>
    </div>
<?php
} else { ?>
    <div class="profile-unfollow-button" style="border-right:1px solid gray;"
        data-userid="<?php echo $userid; ?>"
        data-profileid="<?php echo $profileId; ?>">
        <img src="assets/image/rightsignGray.JPG" alt="">
        <div class="profile-activity-button-text">Unfollow</div>
    </div>
<?php
}
?>