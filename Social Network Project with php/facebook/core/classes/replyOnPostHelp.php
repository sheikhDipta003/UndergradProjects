<li class="new-reply" style="margin-top:10px">
    <article class="com-details">
        <section class="com-pro-pic">
            <a href="">
                <div class="top-pic"><img src="<?php echo $reply->profilePic ?>" alt=""></div>
            </a>
        </section>
        <section class="com-pro-wrap">
            <section class="com-text-react-wrap">
                <div class="reply-text-option-wrap align-middle" style="justify-content: flex-start;">
                    <div class="com-pro-text align-middle">
                        <a href="">
                            <span class="nf-pro-name"><?php echo '' . $reply->firstName . ' ' . $reply->lastName . '' ?></span>
                        </a>

                        <div class="com-react-placeholder-wrap align-middle">
                            <div class="com-text"
                                data-commentid="<?php echo $reply->commentID; ?>"
                                data-postid="<?php echo $reply->commentOn; ?>"
                                data-profilepic="<?php echo $reply->profilePic; ?>"
                                data-replyid="<?php echo $reply->commentID; ?>"
                                data-userid="<?php echo $user_id; ?>" style="margin-left:5px;">
                                <?php echo $reply->comment; ?>
                            </div>
                            <div class="com-nf-3-wrap">
                                <?php
                                if (empty($reply_react_count) || empty($reply_react_max_show)) {
                                } else {
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
                                            <?php if ($reply_react_count->_count == '0') {
                                            } else {
                                                echo $reply_react_count->_count;
                                            } ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="reply-dot-option-wrap">
                        <div class="reply-dot" style="margin-left:5px;cursor:pointer;color:gray;"
                            data-postid="<?php echo $reply->commentOn ?>"
                            data-userid="<?php echo $user_id; ?>"
                            data-commentid="<?php echo $reply->commentID; ?>"
                            data-replyid="<?php echo $reply->commentID; ?>">
                            ...
                        </div>
                        <div class="reply-option-details-container"></div>
                    </div>
                </div>
                <div class="com-react">
                    <div class="com-like-react-reply"
                        data-postid="<?php echo $reply->commentOn; ?>"
                        data-userid="<?php echo $user_id; ?>"
                        data-commentid="<?php echo $reply->commentID; ?>"
                        data-commentparentid="<?php echo $reply->commentReplyID; ?>">

                        <div class="com-react-bundle-wrap reply"
                            data-commentid="<?php echo $reply->commentID; ?>"
                            data-commentparentid="<?php echo $reply->commentReplyID; ?>">
                        </div>

                        <?php if (empty($replyReactCheck)) {
                            echo '<div class="reply-like-action-text"><span>Like</span></div>';
                        } else {
                            echo '<div class="reply-like-action-text"><span class="' . $replyReactCheck->reactType . '-color">' . $replyReactCheck->reactType . '</span></div>';
                        } ?>
                    </div>
                    <div class="com-reply-action-child" style="cursor:pointer;"
                        data-postid="<?php echo $reply->commentOn; ?>"
                        data-userid="<?php echo $user_id; ?>"
                        data-commentid="<?php echo $reply->commentReplyID; ?>"
                        data-profilepic="<?php echo $reply->profilePic; ?>">
                        Reply
                    </div>
                    <div class="com-time">
                        <?php echo $timeAgoForCom;  ?>
                    </div>
                </div>
            </section>
        </section>
    </article>
</li>