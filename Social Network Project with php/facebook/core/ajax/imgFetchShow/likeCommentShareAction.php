<div class="like-action-wrap" data-postid="<?php echo $postid; ?>" data-userid="<?php echo $userid; ?>" style="position:relative;">
    <div class="react-bundle-wrap"> </div>

    <div class="like-action ra">
        <?php if (empty($main_react)) { ?>
            <div class="like-action-icon">
                <img src="assets/image/likeAction.JPG" alt="">
            </div>
            <div class="like-action-text"><span>Like</span></div>

        <?php } else {
        ?>
            <div class="like-action-icon" style="display: flex;align-items: center;">
                <img src="assets/image/react/<?php echo $main_react->reactType; ?>.png" alt="" class="reactIconSize" style="margin-top:0;">
                <div class="like-action-text"><span class="<?php echo $main_react->reactType;  ?>-color"><?php echo $main_react->reactType; ?></span></div>
            </div>
        <?php
        } ?>
    </div>
</div>

<div class="comment-action ra">
    <div class="comment-action-icon">
        <img src="assets/image/commentAction.JPG" alt="">
    </div>
    <div class="comment-action-text">
        <div class="comment-count-text-wrap">
            <div class="comment-wrap"></div>
            <div class="comment-text">Comment</div>
        </div>
    </div>
</div>

<div class="share-action ra" data-postid="<?php echo $postid; ?>" data-userid="<?php echo $userid ?>" data-profileid="<?php echo $profileId; ?>" data-profilePic="<?php echo $post->profilePic; ?>">
    <div class="share-action-icon">
        <img src="assets/image/shareAction.JPG" alt="">
    </div>
    <div class="share-action-text">Share</div>
</div>