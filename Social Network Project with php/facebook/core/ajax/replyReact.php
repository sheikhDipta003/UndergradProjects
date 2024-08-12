<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

function displayReplyReaction($reply_react_count, $reply_react_max_show)
{
    if (!empty($reply_react_count) && !empty($reply_react_max_show)) {
?>
        <div class="com-nf-3 align-middle">
            <div class="nf-3-react-icon">
                <div class="react-inst-img align-middle">
                    <?php
                    foreach ($reply_react_max_show as $react_max) {
                        echo '<img class="' . $react_max->reactType . '-max-show" src="assets/image/react/' . $react_max->reactType . '.png" alt="" style="height:12px; width:12px; margin-right:2px; cursor:pointer;">';
                    }
                    ?>
                </div>
            </div>
            <div class="nf-3-react-count">
                <?php
                if ($reply_react_count->_count != '0') {
                    echo $reply_react_count->_count;
                }
                ?>
            </div>
        </div>
<?php
    }
}

if (isset($_POST['commentid'])) {
    $commentid = $_POST['commentid'];
    $reactType = $_POST['reactType'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $commentparentid = $_POST['commentparentid'];
    $profileid = $_POST['profileid'];

    // If the same logged-in user previously reacted on the same reply of the same comment and sends a new react, first delete that react-record, then create a new record containing the new react info.
    $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => $commentid, 'reactReplyOn' => $commentparentid));
    $loadFromUser->create('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => $commentid, 'reactReplyOn' => $commentparentid, 'reactType' => $reactType, 'reactTimeOn' => date('Y-m-d H:i:s')));

    $reply_react_count = $loadFromPost->reply_main_react_count($postid, $commentid, $commentparentid);
    $reply_react_max_show = $loadFromPost->reply_react_max_show($postid, $commentid, $commentparentid);

    displayReplyReaction($reply_react_count, $reply_react_max_show);
}

if (isset($_POST['delcommentid'])) {
    $delcommentid = $_POST['delcommentid'];
    $deleteReactType = $_POST['deleteReactType'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $commentparentid = $_POST['commentparentid'];
    $profileid = $_POST['profileid'];

    // If the same logged-in user previously reacted on the same react on the same comment, then delete that react-record
    $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => $delcommentid, 'reactReplyOn' => $commentparentid));

    $reply_react_count = $loadFromPost->reply_main_react_count($postid, $delcommentid, $commentparentid);
    $reply_react_max_show = $loadFromPost->reply_react_max_show($postid, $delcommentid, $commentparentid);

    displayReplyReaction($reply_react_count, $reply_react_max_show);
}

?>