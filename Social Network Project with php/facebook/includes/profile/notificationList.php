<li class="item-notification-wrap <?php echo ($notify->status == '0') ? 'unread-notification' : 'read-notification' ?>" data-postid="<?php echo $notify->postid; ?>"
    data-notificationid="<?php echo $notify->ID; ?>"
    data-profileid="<?php echo $notify->userId; ?>">
    <?php if ($notify->type == 'request') { ?>
        <a href="<?php echo $notify->userLink; ?>" target="_blank" class="item-notification">
        <?php } else if ($notify->type == 'message') {
    } else { ?>
            <a href="post.php?username=<?php echo $notify->userLink; ?>&postid=<?php echo $notify->postid; ?>&profileid=<?php echo $notify->userId; ?>" target="_blank" class="item-notification">
            <?php } ?>
            <img src="<?php echo $notify->profilePic; ?>" style="height:40px; width:40px; border-radius:50%;" alt="">
            <div class="notification-type-details">
                <span style="font-weight:600; font-size:14px; color:#CDDC39; margin-left:5px;">
                    <?php echo '' . $notify->firstName . ' ' . $notify->lastName . ''; ?>
                </span>
                <?php echo $notificationMessage ?>
            </div>
            </a>
</li>