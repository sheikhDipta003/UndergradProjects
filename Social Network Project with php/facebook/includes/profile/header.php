<header>
    <article class="top-bar">
        <section class="top-left-part">
            <section class="profile-logo"><img src="assets/image/logo.jpg" alt=""></section>
            <section class="search-wrap" style="display: inline; z-index:1;">
                <div class="search-input" style="display:flex;justify-content:center;align-items:center;width:100%;">
                    <input type="text" name="main-search" id="main-search">
                    <div class="s-icon top-icon top-css">
                        <img src="assets/image/icons8-search-36.png" alt="">
                    </div>
                </div>
                <div id="search-show" style="position:relative;">
                    <div class="search-result" style="position:absolute;"></div>
                </div>
            </section>
        </section>
        <section class="top-right-part">
            <section class="top-pic-name-wrap">
                <a href="profile.php?username=<?php echo $userData->userLink; ?>" class="top-pic-name ">
                    <section class="top-pic"><img src="<?php echo $userData->profilePic; ?>" alt=""></section>
                    <span class="top-name top-css ">
                        <?php echo $userData->firstName; ?>
                    </span>
                </a>
            </section>
            <a href="index.php">
                <span class="top-home top-css border-left">Home</span>
            </a>
            <?php require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\topRequestNotif.php";
            require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\topMessage.php";
            require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\topNotif.php";
            require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\topHelp.php";
            require "C:\\xampp\\htdocs\\facebook\\includes\\profile\\topMore.php"; ?>
        </section>
    </article>
</header>