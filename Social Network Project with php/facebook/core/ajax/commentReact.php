<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

function displayReaction($com_react_max_show, $com_main_react_count)
{
?>
    <article class="com-nf-3 align-middle">
        <section class="nf-3-react-icon">
            <div class="react-inst-img align-middle">
                <?php
                foreach ($com_react_max_show as $react_max) {
                    echo '<img class="' . $react_max->reactType . '-max-show" src="assets/image/react/' . $react_max->reactType . '.png" alt="" style="height:12px; width:12px; margin-right:2px; cursor:pointer;">';
                }
                ?>
            </div>
        </section>
        <section class="nf-3-react-count" style="font-size:12px;">
            <?php
            if ($com_main_react_count->_count == '0') {
            } else {
                echo $com_main_react_count->_count;
            }
            ?>
        </section>
    </article>
<?php
}

if (isset($_POST['commentid'])) {
    $commentid = $_POST['commentid'];
    $reactType = $_POST['reactType'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    // If the same logged-in user previously reacted on the same comment and sends a new react, first delete that react-record, then create a new record containing the new react info.
    $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => $commentid));
    $loadFromUser->create('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => $commentid, 'reactType' => $reactType, 'reactTimeOn' => date('Y-m-d H:i:s')));

    //notify all users except current user about the react update on this comment
    if($profileid != $userid){
        $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $profileid, 'postid' => $postid, 'type'=>'commentReact', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    }

    $com_react_max_show = $loadFromPost->com_react_max_show($postid, $commentid);
    $com_main_react_count = $loadFromPost->com_main_react_count($postid, $commentid);

    displayReaction($com_react_max_show, $com_main_react_count);
}

if (isset($_POST['deleteReactType'])) {
    $deleteReactType = $_POST['deleteReactType'];
    $delCommentid = $_POST['delCommentid'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    // If the same logged-in user previously reacted on the same comment, then delete that react-record
    $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => $delCommentid));
    $com_react_max_show = $loadFromPost->com_react_max_show($postid, $delCommentid);
    $com_main_react_count = $loadFromPost->com_main_react_count($postid, $delCommentid);

    if (!empty($com_react_max_show) && $com_main_react_count->_count != '0') {
        displayReaction($com_react_max_show, $com_main_react_count);
    }
}
?>