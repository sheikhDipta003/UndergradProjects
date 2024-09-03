<?php
require 'C:\\xampp\\htdocs\\facebook\\core\\load.php';
require 'C:\\xampp\\htdocs\\facebook\\connect\\login.php';

$user_id = login::isLoggedIn();

if (isset($_POST['useridForAjax'])) {
    $useridForAjax = $_POST['useridForAjax'];
    $lastpersonid = $_POST['lastpersonid'];
    $msg = $_POST['msg'];

    $loadFromUser->create('messages', array("message" => $msg, 'messageTo' => $lastpersonid, 'messageFrom' => $useridForAjax, 'messageOn' => date('Y-m-d H:i:s')));

    $loadFromUser->delete('notification', array("notificationFrom" => $useridForAjax, 'notificationFor' => $otherid, 'type' => 'message'));

    if ($lastpersonid != $useridForAjax) {
        $loadFromUser->create('notification', array('notificationFrom' => $useridForAjax, 'notificationFor' => $lastpersonid, 'postid' => '0', 'type' => 'message', 'status' => '0', 'notificationCount' => '0', 'notificationOn' => date('Y-m-d H:i:s')));
    }

    $messageData = $loadFromMessage->messageData($useridForAjax, $lastpersonid);

    foreach ($messageData as $message) {
        if ($message->messageFrom == $useridForAjax) { ?>

            <div class="right-msg">
                <div class="right-receiver-text-time">
                    <div class="receiver-text" style="background-color:#03A9F4;color:white;"><?php echo $message->message; ?></div>
                    <div class="receiver-time" style="margin-right:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
                </div>
                <div class="receiver-img">
                    <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px; border-radius:50%;">
                </div>
            </div>

        <?php
        } else { ?>
            <div class="left-msg">
                <div class="receiver-img">
                    <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px; border-radius:50%;">
                </div>
                <div class="receiver-text-time">
                    <div class="receiver-text" style="background-color: ghostwhite; box-shadow: 0 0 2px;"><?php echo $message->message; ?></div>
                    <div class="receiver-time" style="margin-left:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
                </div>
            </div>
        <?php
        }
    }
}

if (isset($_POST['showmsg'])) {
    $lastpersonid = $_POST['showmsg'];
    $useridForAjax = $_POST['yourid'];

    $messageData = $loadFromMessage->messageData($useridForAjax, $lastpersonid);
    echo '<div class="past-data-count" data-datacount="' . count($messageData) . '"></div>';
    foreach ($messageData as $message) {
        if ($message->messageFrom == $useridForAjax) { ?>

            <div class="right-msg">
                <div class="right-receiver-text-time">
                    <div class="receiver-text" style="background-color:#03A9F4;color:white;"><?php echo $message->message; ?></div>
                    <div class="receiver-time" style="margin-right:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
                </div>
                <div class="receiver-img">
                    <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px; border-radius:50%;">
                </div>
            </div>

        <?php
        } else { ?>
            <div class="left-msg">
                <div class="receiver-img">
                    <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px; border-radius:50%;">
                </div>
                <div class="receiver-text-time">
                    <div class="receiver-text" style="background-color: ghostwhite;"><?php echo $message->message; ?></div>
                    <div class="receiver-time" style="margin-left:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
                </div>
            </div>
<?php
        }
    }
}

if (isset($_POST['dataCount'])) {
    $lastpersonid = $_POST['dataCount'];
    $useridForAjax = $_POST['profileid'];

    $messageData = $loadFromMessage->messageData($useridForAjax, $lastpersonid);
    echo count($messageData);
}


?>