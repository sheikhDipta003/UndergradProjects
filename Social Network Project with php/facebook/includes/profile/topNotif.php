<section class="top-notification top-css top-icon border-left " style="position: relative;">
    <?php if (empty(count($notificationCount))) {
        echo '<div class="notification-count"></div>';
    } else {
        echo '<div class="notification-count">' . count($notificationCount) . '</div>';
    } ?>

    <svg xmlns="http://www.w3.org/2000/svg" class="notification-svg" style="height:20px; width:20px;" viewBox="0 0 12.06 13.92">
        <defs>
            <style>
                .cls-1 {
                    fill: #1a2947;
                }

                .cls-2 {
                    fill: none;
                    stroke: #1a2947;
                    stroke-miterlimit: 10;
                }
            </style>
        </defs>
        <title>notification</title>
        <g id="Layer_2" data-name="Layer 2">
            <g id="Layer_1-2" data-name="Layer 1">
                <path class="cls-1  <?php if (empty(count($notificationCount))) {
                                    } else {
                                        echo 'active-noti';
                                    } ?>" d="M11.32,9A10.07,10.07,0,0,0,7.65,2.1,2.42,2.42,0,0,0,4.8,2,9.66,9.66,0,0,0,.74,9a2,2,0,0,0-.25,2.81H11.57A2,2,0,0,0,11.32,9Z" />
                <path class="cls-1 <?php if (empty(count($notificationCount))) {
                                    } else {
                                        echo 'active-noti';
                                    } ?>" d="M8.07,12.32a1.86,1.86,0,0,1-2,1.6,1.86,1.86,0,0,1-2-1.6" />
                <ellipse class="cls-2 <?php if (empty(count($notificationCount))) {
                                        } else {
                                            echo 'active-noti2';
                                        } ?>" cx="6.17" cy="1.82" rx="1.21" ry="1.32" />
            </g>
        </g>
    </svg>
    <div class="notification-list-wrap">
        <ul style="margin:0; padding:0;" class="notify-ul">
            <?php if (empty($notification)) {
            } else {
                foreach ($notification as $notify) {
                    if ($notify->type == 'request' || $notify->type == 'message') {
                    } else if ($notify->type == 'mention') {
                        // define the notification message that is to be shown
                        $notificationMessage = 'mentioned you in a <span>post</span>';
                        // show notification list
                        require 'C:\\xampp\\htdocs\\facebook\\includes\\profile\\notificationList.php';
                    } 
                    else {
                        // define the notification message that is to be shown
                        $notificationMessage = ($notify->type == 'comment')
                            ? 'commented on your <span>post</span>'
                            : (($notify->type == 'postReact')
                                ? 'reacted on your <span>post</span>'
                                : (($notify->type == 'request' && $notify->friendStatus == '1' && $notify->notificationFrom == $userid)
                                    ? 'accepted your friend request'
                                    : (($notify->type == 'request'  && $notify->notificationFor == $userid && $notify->notificationCount == '0')
                                        ? 'sent you a friend request'
                                        : 'reacted on your <span>comment</span>'
                                    )
                                )
                            );

                        // show notification list
                        require 'C:\\xampp\\htdocs\\facebook\\includes\\profile\\notificationList.php';
                    }
                }
            }  ?>
        </ul>
    </div>
</section>