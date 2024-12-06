<div class="comment-list">
    <ul class="add-comment">
        <?php
        if (!empty($commentDetails)) {
            foreach ($commentDetails as $comment) {
                $com_react_max_show = $obj->com_react_max_show($comment->commentOn, $comment->commentID);
                $com_main_react_count = $obj->com_main_react_count($comment->commentOn, $comment->commentID);
                $commentReactCheck = $obj->commentReactCheck($userid, $comment->commentOn, $comment->commentID);
                $timeAgo = $obj->timeAgo($comment->commentAt);

                $blockedUserComment = $obj->block($comment->commentBy, $userid);
                if (!empty($blockedUserComment)) {
                } else {
        ?>
                    <li class="new-comment">
                        <article class="com-details">
                            <section class="com-pro-pic">
                                <a href="#">
                                    <span class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></span>
                                </a>
                            </section>
                            <section class="com-pro-wrap">
                                <div class="com-text-react-wrap">
                                    <?php
                                    $user_id = $userid;
                                    require 'C:\\xampp\\htdocs\\facebook\\core\\classes\\commentOnPostHelp.php';
                                    ?>
                                </div>

                                <div class="reply-wrap">
                                    <section class="reply-text-wrap">
                                        <ul class="old-reply">
                                            <?php
                                            $replyDetails = $obj->replyFetch($comment->commentOn, $comment->commentID);

                                            foreach ($replyDetails as $reply) {
                                                $reply_react_count = $obj->reply_main_react_count($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                                                $reply_react_max_show = $obj->reply_react_max_show($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                                                $replyReactCheck = $obj->replyReactCheck($userid, $reply->commentOn, $reply->commentID, $reply->commentReplyID);
                                                $timeAgoForCom = $obj->timeAgoForCom($reply->commentAt);

                                                $blockedUserReply = $obj->block($reply->commentBy, $userid);
                                                if (!empty($blockedUserReply)) {
                                                } else {
                                            ?>
                                            <?php
                                                    require "C:\\xampp\\htdocs\\facebook\\core\\classes\\replyOnPostHelp.php";
                                                }
                                            }

                                            ?>
                                        </ul>
                                    </section>

                                    <section class="replyInput">

                                    </section>
                                </div>
                            </section>
                        </article>
                    </li>
        <?php
                }
            }
        }
        ?>
    </ul>
</div>
<div class="comment-write">
    <div class="com-pro-pic" style="margin-top:4px;">
        <a href="#">
            <span class="top-pic"><img src="<?php echo $userdata->profilePic; ?>" alt=""></span>
        </a>
    </div>
    <div class="com-input">
        <div class="comment-input" style="flex-basis:90%;">
            <input type="text" name="" id=""
                class="comment-input-style comment-submit"
                placeholder="Write a comment..."
                data-postid="<?php echo $postid; ?>"
                data-userid="<?php echo $userid; ?>">
        </div>
    </div>
</div>

