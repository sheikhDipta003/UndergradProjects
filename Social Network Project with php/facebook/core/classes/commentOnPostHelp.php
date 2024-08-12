<section class="com-text-option-wrap align-middle">
    <article class="com-pro-text align-middle">
        <div class="com-react-placeholder-wrap align-middle">
            <div>
                <span class="nf-pro-name">
                    <a href="" class="nf-pro-name"><?php echo '' . $comment->firstName . ' ' . $comment->lastName . '' ?> </a>
                </span>
                <span class="com-text" style="margin-left:5px; "
                    data-postid="<?php echo $comment->commentOn; ?> "
                    data-userid="<?php echo $user_id; ?>"
                    data-commentid="<?php echo $comment->commentID;  ?>"
                    data-profilepic="<?php echo $comment->profilePic; ?>"
                >
                    <?php echo $comment->comment; ?>
                </span>
            </div>
            <div class="com-nf-3-wrap">
                <?php
                if ($com_main_react_count->_count == '0') {
                } else {
                ?>
                    <article class="com-nf-3 align-middle">
                        <section class="nf-3-react-icon">
                            <div class="react-inst-img align-middle">
                                <?php
                                foreach ($com_react_max_show as $react_max) {
                                    echo '<img class="' . $react_max->reactType . '-max-show" src="assets/image/react/' . $react_max->reactType . '.png" alt="" style="height:12px; width:12px;margin-right:2px;cursor:pointer;">';
                                }
                                ?>
                            </div>
                        </section>
                        <section class="nf-3-react-count">
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


                ?>
            </div>
        </div>
    </article>
    <?php
    if ($user_id == $comment->commentBy) {
    ?>
        <article class="com-dot-option-wrap">
            <div class="com-dot" style="color:gray; margin-left:5px; cursor:pointer;font-weight:600;"
                data-postid="<?php echo $comment->commentOn; ?>"
                data-userid="<?php echo $user_id; ?>"
                data-commentid="<?php echo $comment->commentID; ?>"
            >
                ...
            </div>
            <div class="com-option-details-container"></div>
        </article>
    <?php
    } else {
    }
    ?>
</section>
<section class="com-react">
    <div class="com-like-react"
        data-postid="<?php echo $comment->commentOn; ?>"
        data-userid="<?php echo $user_id; ?>"
        data-commentid="<?php echo $comment->commentID; ?>"
    >
        <div class="com-react-bundle-wrap" data-commentid="<?php echo $comment->commentID; ?>"></div>

        <?php
        if (empty($commentReactCheck)) {
            echo '<div class="com-like-action-text"><span>Like</span></div>';
        } else {
            echo '<div class="com-like-action-text"><span class="' . $commentReactCheck->reactType . '-color">' . $commentReactCheck->reactType . '</span></div>';
        }
        ?>
    </div>
    <div class="com-reply-action"
        data-postid="<?php echo $comment->commentOn; ?>"
        data-userid="<?php echo $user_id; ?>"
        data-commentid="<?php echo $comment->commentID; ?>"
        data-profilepic="<?php echo $comment->profilePic; ?>"
    >
        Reply
    </div>
    <div class="com-time">
        <?php echo $timeAgo; ?>
    </div>
</section>