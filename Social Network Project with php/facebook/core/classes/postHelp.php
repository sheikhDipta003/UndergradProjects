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
                                <?php echo $this->timeAgo($post->postedOn); ?>
                            </div>

                            <div class="nf-pro-privacy"></div>
                        </section>
                    </div>
                </div>

                <div class="nf-1-right">
                    <div class="nf-1-right-dott">
                        <?php
                        if (empty($post->shareId)) {
                            if ($user_id == $profileId) { ?>
                                <div class="post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>">...</div>
                                <div class="post-option-details-container"></div>
                            <?php
                            } else {
                            }
                        } else {
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
                    $postText = $post->post;
                    echo $postText;
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
                                    echo ' <img class = "' + $react_max->reactType  + '-max-show" src="assets/image/react/' + $react_max->reactType  + '.png" alt="" style="height:15px; width:15px; margin-right:2px;cursor:pointer;"> ';
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
                </article>
            </section>

            <section class="nf-4">
                <div class="like-action-wrap" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>" style="position:relative;">
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

                <div class="share-action ra" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>" data-profileid="<?php echo $profileId; ?>" data-profilePic="<?php echo $post->profilePic; ?>">
                    <div class="share-action-icon">
                        <img src="assets/image/shareAction.JPG" alt="">
                    </div>
                    <div class="share-action-text">Share</div>
                </div>
            </section>

            <section class="nf-5">

            </section>
        </div>

        <div class="news-feed-photo"></div>
    </section>
</article>