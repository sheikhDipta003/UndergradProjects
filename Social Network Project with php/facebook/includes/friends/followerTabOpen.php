<div class="follower-tab-open about-main" style="flex-wrap:wrap; margin-top:15px; display:none;">
    <?php
    if (empty($followersdata)) {
    } else {
        foreach ($followersdata as $follower) {
            $followCheck = $loadFromUser->followCheck($follower->userId, $userid);
    ?>
            <div class="friends-box">
                <a href="<?php echo BASE_URL . $friend->userLink; ?>">
                    <article class="friend-img-name align-middle">
                        <span class="friend-img">
                            <img src="<?php echo $friend->profilePic; ?>" style="height:100px; width:100px;border:0.5px solid gray;" alt="">
                        </span>
                        <span class="friend-name"><?php echo '' . $friend->firstName . ' ' . $friend->lastName . ''; ?></span>
                    </article>
                </a>
                <article class="profile-action" style="margin-top:0;">
                    <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\followCheck.php"; ?>
                </article>
            </div>
    <?php
        }
    }
    ?>
</div>