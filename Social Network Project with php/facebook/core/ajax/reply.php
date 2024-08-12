<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if (isset($_POST['replyComment'])) {
    $comment_text = $loadFromUser->checkInput($_POST['replyComment']);
    $userid = $_POST['userid'];
    $postid = $_POST['postid'];
    $commentid = $_POST['commentid'];
    $profileid = $_POST['profileid'];

    $replyCommentId = $loadFromUser->create('comments', array('commentBy' => $userid, 'comment_parent_id' => $postid, 'commentReplyID' => $commentid, 'comment' => $comment_text, 'commentOn' => $postid, 'commentAt' => date('Y-m-d H:i:s')));
    $replyDetails = $loadFromPost->lastReplyFetch($replyCommentId);

    foreach ($replyDetails as $reply) {
        $reply_react_count = $loadFromPost->reply_main_react_count($reply->commentOn, $reply->commentID, $reply->commentReplyID);
        $reply_react_max_show = $loadFromPost->reply_react_max_show($reply->commentOn, $reply->commentID, $reply->commentReplyID);
        $replyReactCheck = $loadFromPost->replyReactCheck($user_id, $reply->commentOn, $reply->commentID, $reply->commentReplyID);
        $timeAgoForCom = $loadFromPost->timeAgoForCom($reply->commentAt);

        require "C:\\xampp\\htdocs\\facebook\\core\\classes\\replyOnPostHelp.php";
    }
}

?>