<a href="message.php" class="message-top-notification">
    <section class="top-messenger top-css top-icon border-left " style="position:relative;">
        <?php if (empty(count($messageNotification))) {
            echo '<div class="message-count"></div>';
        } else {
            echo '<div class="message-count">' . count($messageNotification) . '</div>';
        } ?>
        <svg xmlns="http://www.w3.org/2000/svg" class="message-svg" style="height:20px; width:20px;" viewBox="0 0 12.64 13.64">
            <defs>
                <style>
                    .cls-1 {
                        fill: #1a2947;
                    }
                </style>
            </defs>
            <title>message</title>
            <g id="Layer_2" data-name="Layer 2">
                <g id="Layer_1-2" data-name="Layer 1">
                    <path class="cls-1 <?php if (empty(count($messageNotification))) {
                                        } else {
                                            echo 'msg-active-noti';
                                        } ?>" d="M6.32,0A6.32,6.32,0,0,0,1.94,10.87c.34.33-.32,2.51.09,2.75s1.79-1.48,2.21-1.33a6.22,6.22,0,0,0,2.08.35A6.32,6.32,0,0,0,6.32,0Zm.21,8.08L5.72,6.74l-2.43,1,2.4-3,.84,1.53,2.82-.71Z" />
                </g>
            </g>
        </svg>
    </section>
</a>