<section class="request-top-notification top-css top-icon border-left " style="position:relative;">
    <?php if (empty(count($requestNotificationCount))) {
        echo '<div class="request-count"></div>';
    } else {
        echo '<div class="request-count">' . count($requestNotificationCount) . '</div>';
    } ?>
    <svg xmlns="http://www.w3.org/2000/svg" class="request-svg" viewBox="0 0 15.8 13.63" style="height:20px; width:20px;">
        <defs>
            <style>
                .cls-1 {
                    fill: #1a2947;
                }
            </style>
        </defs>
        <title>request</title>
        <g id="Layer_2" data-name="Layer 2">
            <g id="Layer_1-2" data-name="Layer 1">
                <path class="cls-1 <?php if (empty(count($requestNotificationCount))) {
                                    } else {
                                        echo 'active-noti';
                                    } ?>" d="M13.2,7.77a7.64,7.64,0,0,0-1.94-.45,7.64,7.64,0,0,0-1.93.45,3.78,3.78,0,0,0-2.6,3.55.7.7,0,0,0,.45.71,12.65,12.65,0,0,0,4.08.59A12.7,12.7,0,0,0,15.35,12a.71.71,0,0,0,.45-.71A3.79,3.79,0,0,0,13.2,7.77Z" />
                <ellipse class="cls-1 <?php if (empty(count($requestNotificationCount))) {
                                        } else {
                                            echo 'active-noti';
                                        } ?>" cx="11.34" cy="4.03" rx="2.48" ry="2.9" />
                <path class="cls-1 <?php if (empty(count($requestNotificationCount))) {
                                    } else {
                                        echo 'active-noti';
                                    } ?>" d="M7.68,7.88a9,9,0,0,0-2.3-.54,8.81,8.81,0,0,0-2.29.54A4.5,4.5,0,0,0,0,12.09a.87.87,0,0,0,.53.85,15.28,15.28,0,0,0,4.85.68,15.25,15.25,0,0,0,4.85-.68.87.87,0,0,0,.53-.85A4.49,4.49,0,0,0,7.68,7.88Z" />
                <ellipse class="cls-1 <?php if (empty(count($requestNotificationCount))) {
                                        } else {
                                            echo 'active-noti';
                                        } ?>" cx="5.47" cy="3.44" rx="2.94" ry="3.44" />
            </g>
        </g>
    </svg>
    <div class="request-notification-list-wrap">
        <ul style="margin:0; padding:0;" class="notify-ul">
            <?php if (empty($requestNotificationCount)) {
            } else {
                foreach ($requestNotificationCount as $notify) {
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
            }  ?>
        </ul>
    </div>
</section>