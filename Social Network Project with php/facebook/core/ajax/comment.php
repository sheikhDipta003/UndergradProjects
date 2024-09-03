<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if (isset($_POST['comment'])) {
    $comment_text = $loadFromUser->checkInput($_POST['comment']);
    $userid = $_POST['userid'];
    $postid = $_POST['postid'];
    $profileid = $_POST['profileid'];

    $commentid = $loadFromUser->create('comments', array('commentBy' => $userid, 'comment_parent_id' => $postid, 'comment' => $comment_text, 'commentOn' => $postid, 'commentAt' => date('Y-m-d H:i:s')));

    if($profileid != $userid){
        $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $profileid, 'postid' => $postid, 'type'=>'comment', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    }

    $commentDetails = $loadFromPost->lastCommentFetch($commentid);

    if (!empty($commentDetails)) {
        foreach ($commentDetails as $comment) {
            $com_react_max_show = $loadFromPost->com_react_max_show($comment->commentOn, $comment->commentID);
            $com_main_react_count = $loadFromPost->com_main_react_count($comment->commentOn, $comment->commentID);
            $commentReactCheck = $loadFromPost->commentReactCheck($user_id, $comment->commentOn, $comment->commentID);
            $timeAgo = $loadFromPost->timeAgo($comment->commentAt);
?>
            <li class="new-comment">
                <div class="com-details">
                    <div class="com-pro-pic">
                        <a href="#">
                            <span class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></span>
                        </a>
                    </div>
                    <div class="com-pro-wrap">
                        <div class="com-text-react-wrap">
                            <?php require "C:\\xampp\\htdocs\\facebook\\core\\classes\\commentOnPostHelp.php"; ?>
                        </div>
                    </div>
                </div>
            </li>
<?php
        }
    }
}


?>