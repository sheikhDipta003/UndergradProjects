<div class="cover-bottom-part">
    <a href="profile.php">
        <!-- data-userid and data-profileid attributes are custom data attributes that allows us to embed server-side data (from PHP) into HTML elements, which can be later accessed by client-side scripts (JavaScript). -->
        <div class="timeline-button align-middle cover-but-css"
            data-userid="<?php echo $userid; ?>"
            data-profileid="<?php echo $profileId; ?>">
            Timeline
        </div>
    </a>

    <a href="about.php">
        <div class="about-button align-middle cover-but-css"
            data-userid="<?php echo $userid; ?>"
            data-profileid="<?php echo $profileId; ?>">
            About
        </div>
    </a>

    <a href="friends.php">
        <div class="friends-button align-middle cover-but-css"
            data-userid="<?php echo $userid; ?>"
            data-profileid="<?php echo $profileId; ?>">
            Friends
        </div>
    </a>

    <a href="photos.php">
        <div class="photos-button align-middle cover-but-css"
            data-userid="<?php echo $userid; ?>"
            data-profileid="<?php echo $profileId; ?>">
            Photos
        </div>
    </a>
</div>