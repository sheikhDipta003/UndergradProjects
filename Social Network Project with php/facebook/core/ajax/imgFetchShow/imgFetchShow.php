<?php
include '../../load.php';
include '../../../connect/login.php';

$userid = login::isLoggedIn();

if (isset($_POST['fetchImgInfo'])) {
    $userid = $_POST['fetchImgInfo'];
    $postid = $_POST['postid'];
    $imgSrc = $_POST['imageSrc'];
    $main_react = $loadFromPost->main_react($userid, $postid);
    $react_max_show = $loadFromPost->react_max_show($postid);
    $main_react_count = $loadFromPost->main_react_count($postid);

    $commentDetails = $loadFromPost->commentFetch($postid);
    $totalCommentCount = $loadFromPost->totalCommentCount($postid);
    $totalShareCount = $loadFromPost->totalShareCount($postid);

?>
    <article class="top-wrap" style="position:fixed;top:0px; bottom:0px;right:0px;justify-content:center;left:0px;display:flex;background-color:#000000c4; z-index: 99;">
        <section class="post-img-wrap" style="display:flex;background-color:white;width:70%;justify-content:center;align-items:center; height:100vh;">
            <figure class="post-img-action" style="background-color:#0000008c; height:100%; align-items:center;display:flex;">
                <img src="<?php echo $imgSrc; ?>" alt="" style="width:500px;">
            </figure>
            <div class="post-img-details" style="width:100%; padding:20px;align-self:flex-start;">
                <div class="nf-3">
                    <?php
                    $userdata = $loadFromPost->userData($userid);
                    $obj = $loadFromPost;
                    require 'C:\\xampp\\htdocs\\facebook\\core\\ajax\\imgFetchShow\\reactCommentShareCount.php';
                    ?>
                </div>

                <div class="nf-4">
                    <?php
                    $userdata = $loadFromPost->userData($userid);
                    $obj = $loadFromPost;
                    require 'C:\\xampp\\htdocs\\facebook\\core\\ajax\\imgFetchShow\\likeCommentShareAction.php';
                    ?>
                </div>

                <div class="nf-5">
                    <?php
                    $userdata = $loadFromPost->userData($userid);
                    $obj = $loadFromPost;
                    require 'C:\\xampp\\htdocs\\facebook\\core\\ajax\\imgFetchShow\\commentList.php';
                    ?>
                </div>
            </div>
        </section>
    </article>
<?php
}
?> ?>