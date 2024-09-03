<!-- 'obj' = $this or $loadFromPost, depending on where it is being called from -->
<article class="profile-timeline">
    <section class="news-feed-comp">
        <div class="news-feed-text">
            <section class="nf-1">
                <div class="nf-1-left">
                    <div class="nf-pro-pic">
                        <a href="<?php echo BASE_URL . $post->userLink; ?>"></a>
                        <img src="<?php echo BASE_URL . $post->profilePic; ?>" class="pro-pic" alt="">
                    </div>

                    <div class="nf-pro-name-time">
                        <section class="nf-pro-name">
                            <a href="<?php echo BASE_URL . $post->userLink; ?>" class="nf-pro-name">
                                <?php echo '' . $post->firstName . ' ' . $post->lastName . ''; ?>
                            </a>
                        </section>

                        <section class="nf-pro-time-privacy">
                            <div class="nf-pro-time">
                                <?php echo $obj->timeAgo($post->postedOn); ?>
                            </div>

                            <div class="nf-pro-privacy"></div>
                        </section>
                    </div>
                </div>

                <div class="nf-1-right">
                    <div class="nf-1-right-dott">
                        <?php
                        if (empty($post->shareId)) {  //this is NOT a shared post
                            if ($user_id == $profileId) { ?>
                                <div class="post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>">...</div>
                                <div class="post-option-details-container"></div>
                            <?php
                            } else {
                            }
                        } else {  //this IS a shared post
                            if ($user_id == $profileId) { ?>
                                <div class="shared-post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>">...</div>
                                <div class="shared-post-option-details-container"></div>
                        <?php
                            } else {
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>

            <section class="nf-2">
                <div class="nf-2-text" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>" data-profilePic="<?php echo $post->profilePic; ?>">
                    <?php
                    if (empty($post->shareId)) {  //this is NOT a shared post
                        $status_post = $post->post;
                        $status_post = preg_replace(
                            "/@([\w]+)/", 
                            "<a href='" . BASE_URL . "$1'>$0</a>", 
                            $status_post
                        );
                        echo $status_post;

                    } else {   //this IS a shared post
                        if (empty($shareDetails)) {
                            echo 'Share details not found.';
                        } else {
                            echo '<span class="nf-2-text-span" data-postid = "' . $post->post_id . '" data-userid="' . $user_id . '" data-profilepic="' . $post->profilePic . '">' . $post->shareText . '</span>';
                        }

                        foreach ($shareDetails as $share) { ?>
                            <div class="share-container"
                                style="padding:5px; box-shadow: 0 0 3px gray; margin-top:10px; display:flex; flex-direction:column; align-items:flex-start; cursor:pointer"
                                data-userlink="<?php echo $share->userLink; ?>">

                                <section class="nf-1">
                                    <section class="nf-1-left">
                                        <div class="nf-pro-pic">
                                            <a href="<?php echo BASE_URL . $share->userLink; ?>"></a>
                                            <img src="<?php echo BASE_URL . $share->profilePic; ?>" class="pro-pic" alt="">
                                        </div>
                                        <div class="nf-pro-name-time">
                                            <div class="nf-pro-name">
                                                <a href="<?php echo BASE_URL . $share->userLink; ?>" class="nf-pro-name">
                                                    <?php echo '' . $share->firstName . ' ' . $share->lastName . ''; ?>
                                                </a>
                                            </div>
                                            <div class="nf-pro-time-privacy">
                                                <div class="nf-pro-time">
                                                    <?php echo $obj->timeAgo($share->postedOn); ?>
                                                </div>
                                                <div class="nf-pro-privacy">
                                                    <img src="../../facebook/assets/image/privacy.JPG" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="nf-1-right"></section>
                                </section>
                                <section class="nf-2">
                                    <div class="nf-2-text"
                                        data-postid="<?php echo $share->post_id; ?>"
                                        data-userid="<?php echo $user_id ?>"
                                        data-profilePic="<?php echo $share->profilePic; ?>">
                                        <?php echo $share->post;  ?>
                                    </div>
                                    <div class="nf-2-img"
                                        data-postid="<?php echo $share->post_id; ?>"
                                        data-userid="<?php echo $user_id ?>">
                                        <?php $shareImgJson = json_decode($share->postImage);
                                        for ($i = 0; $i < count((array)$shareImgJson); $i++) {
                                            echo '  <div class="post-img-box" data-postImgID="' . $share->id . '" style="max-height: 400px; overflow: hidden;"><img src="' . BASE_URL . $shareImgJson['' . $i++ . '']->imageName . '" class="postImage" alt="" style="width: 100%;cursor:pointer;"></div>';
                                        }
                                        ?>
                                    </div>
                                </section>

                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <div class="nf-2-img" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>">
                    <?php $imgJson = json_decode($post->postImage);
                    $count = 0;
                    for ($i = 0; $i < count((array)$imgJson); $i++) {
                        echo '  <div class="post-img-box" data-postImgid="' . $post->id . '" style="max-height: 400px; overflow: hidden; width: 100%;cursor:pointer;"><img src="' . BASE_URL . $imgJson['' . $count++ . '']->imageName . '" class="postImage" data-userid="' . $user_id . '" data-postid="' . $post->post_id . '" data-profileid="' . $profileId . '" alt=""></div>';
                    }
                    ?>
                </div>
            </section>

            <section class="nf-3">
                <article class="react-comment-count-wrap" style="width:100%; display:flex; justify-content:space-between; align-items:center;">
                    <div class="react-count-wrap align-middle">
                        <section class="nf-3-react-icon">
                            <div class="react-inst-img align-middle">
                                <?php
                                foreach ($react_max_show as $react_max) {
                                    echo ' <img class = "' . $react_max->reactType  . '-max-show" src="assets/image/react/' . $react_max->reactType  . '.png" alt="" style="height:15px; width:15px; margin-right:2px;cursor:pointer;"> ';
                                }

                                ?>
                            </div>
                        </section>

                        <section class="nf-3-react-count">
                            <?php
                            if ($main_react_count->_count == '0') {
                            } else {
                                echo $main_react_count->_count;
                            } ?>
                        </section>
                    </div>
                    <div class="comment-share-count-wrap align-middle" style="font-size:13px; color:gray;">
                        <section class="comment-count-wrap" style="margin-right:10px;">
                            <?php if (empty($totalCommentCount->totalComment)) {
                            } else {
                                echo '' . $totalCommentCount->totalComment . ' comments';
                            } ?>
                        </section>
                        <section class="share-count-wrap">
                            <?php if (empty($totalShareCount->totalShare)) {
                            } else {
                                echo '' . $totalShareCount->totalShare . ' Share';
                            } ?>
                        </section>
                    </div>
                </article>
            </section>

            <section class="nf-4">
                <div class="like-action-wrap"
                    data-postid="<?php echo $post->post_id; ?>"
                    data-userid="<?php echo $user_id; ?>"
                    style="position:relative;">
                    <div class="react-bundle-wrap"></div>

                    <div class="like-action ra">
                        <?php if (empty($main_react)) { ?>

                            <div class="like-action-icon">
                                <img src="assets/image/likeAction.JPG" alt="">
                            </div>
                            <div class="like-action-text"><span>Like</span></div>

                        <?php } else { ?>

                            <div class="like-action-icon" style="display: flex;align-items: center;">
                                <img src="assets/image/react/<?php echo $main_react->reactType; ?>.png" alt="" class="reactIconSize" style="margin-top:0;">
                                <div class="like-action-text"><span class="<?php echo $main_react->reactType;  ?>-color"><?php echo $main_react->reactType; ?></span></div>
                            </div>

                        <?php } ?>
                    </div>
                </div>

                <div class="comment-action ra">
                    <div class="comment-action-icon">
                        <img src="assets/image/commentAction.JPG" alt="">
                    </div>
                    <div class="comment-action-text">
                        <div class="comment-count-text-wrap">
                            <div class="comment-wrap"></div>
                            <div class="comment-text">Comment</div>
                        </div>
                    </div>
                </div>

                <div class="share-action ra"
                    data-postid="<?php echo $post->post_id; ?>"
                    data-userid="<?php echo $user_id ?>"
                    data-profileid="<?php echo $profileId; ?>"
                    data-profilePic="<?php echo $post->profilePic; ?>">
                    <div class="share-action-icon">
                        <img src="assets/image/shareAction.JPG" alt="">
                    </div>
                    <div class="share-action-text">Share</div>
                </div>
            </section>

            <section class="nf-5">
                <div class="comment-list">
                    <ul class="add-comment">
                        <?php
                        if (!empty($commentDetails)) {
                            foreach ($commentDetails as $comment) {
                                $com_react_max_show = $obj->com_react_max_show($comment->commentOn, $comment->commentID);
                                $com_main_react_count = $obj->com_main_react_count($comment->commentOn, $comment->commentID);
                                $commentReactCheck = $obj->commentReactCheck($user_id, $comment->commentOn, $comment->commentID);
                                $timeAgo = $obj->timeAgo($comment->commentAt);

                                $blockedUserComment = $obj->block($comment->commentBy, $user_id);
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
                                                    <?php require 'core/classes/commentOnPostHelp.php'; ?>
                                                </div>

                                                <div class="reply-wrap">
                                                    <section class="reply-text-wrap">
                                                        <ul class="old-reply">
                                                            <?php
                                                            $replyDetails = $obj->replyFetch($comment->commentOn, $comment->commentID);

                                                            foreach ($replyDetails as $reply) {
                                                                $reply_react_count = $obj->reply_main_react_count($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                                                                $reply_react_max_show = $obj->reply_react_max_show($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                                                                $replyReactCheck = $obj->replyReactCheck($user_id, $reply->commentOn, $reply->commentID, $reply->commentReplyID);
                                                                $timeAgoForCom = $obj->timeAgoForCom($reply->commentAt);

                                                                $blockedUserReply = $obj->block($reply->commentBy, $user_id);
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
                                data-postid="<?php echo $post->post_id; ?>"
                                data-userid="<?php echo $user_id; ?>">
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="news-feed-photo"></div>
    </section>
</article>