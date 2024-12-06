<div class="react-comment-count-wrap" style="width:100%; display:flex; justify-content:space-between; align-items:center;">
    <div class="react-count-wrap align-middle">
        <div class="nf-3-react-icon">
            <div class="react-inst-img align-middle">
                <?php
                foreach ($react_max_show as $react_max) {
                    echo '<img class = "' . $react_max->reactType . '-max-show" src="assets/image/react/' . $react_max->reactType . '.png" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">';
                }
                ?>
            </div>
        </div>
        <div class="nf-3-react-username">
            <?php
            if ($main_react_count->_count == '0') {
            } else {
                echo $main_react_count->_count;
            }
            ?>
        </div>
    </div>
    <div class="comment-share-count-wrap align-middle" style="font-size:13px; color:gray;">
        <div class="comment-count-wrap" style="margin-right:10px;">
            <?php if (empty($totalCommentCount->totalComment)) {
            } else {
                echo '' . $totalCommentCount->totalComment . ' comments';
            }
            ?>
        </div>
        <div class="share-count-wrap">
            <?php if (empty($totalShareCount->totalShare)) {
            } else {
                echo '' . $totalShareCount->totalShare . ' Share';
            }
            ?>
        </div>
    </div>
</div>