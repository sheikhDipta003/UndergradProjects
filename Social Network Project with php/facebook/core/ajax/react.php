<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

function displayReactSection($react_max_show, $main_react_count)
{
?>
    <div class="nf-3-react-icon">
        <article class="react-inst-img align-middle">
            <?php
            foreach ($react_max_show as $react_max) {
                echo '<img class="' . $react_max->reactType . '-max-show" src="assets/image/react/' . $react_max->reactType . '.png" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">';
            }
            ?>
        </article>
    </div>
    <div class="nf-3-react-count">
        <?php
        if ($main_react_count->_count != '0') {
            echo $main_react_count->_count;
        }
        ?>
    </div>
<?php
}

if (isset($_POST['reactType']) || isset($_POST['deleteReactType'])) {
    $postid = $_POST['postId'];
    $userid = $_POST['userId'];
    $profileid = $_POST['profileId'];

    if (isset($_POST['reactType'])) {
        $reactType = $_POST['reactType'];
        // If the same logged-in user previously reacted on the same post and sends a new react, first delete that react-record, then create a new record containing the new react info.
        $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => '0', 'reactReplyOn' => '0'));
        $loadFromUser->create('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactType' => $reactType, 'reactTimeOn' => date('Y-m-d H:i:s')));

        //notify all users except current one about this react update
        if($profileid != $userid){
            $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $profileid, 'postid' => $postid, 'type'=>'postReact', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
        }
    } else if (isset($_POST['deleteReactType'])) {
        // If the same logged-in user previously reacted on the same post, then delete that react-record
        $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn' => '0', 'reactReplyOn' => '0'));
    }

    $react_max_show = $loadFromPost->react_max_show($postid);
    $main_react_count = $loadFromPost->main_react_count($postid);

    displayReactSection($react_max_show, $main_react_count);
}

?>