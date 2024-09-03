<section class="top-right">
    <div class="top-area"></div>
    <div class="right-users-details align-middle">
        <section class="users-right-pro-pic">
            <img src="<?php echo !empty($lastPersonIdFromPost) ? $lastPersonIdFromPost->profilePic : ''; ?>" alt="" style="height: 100px; width: 100px; border-radius: 50%;">
        </section>
        <section class="users-right-pro-name">
            <?php echo !empty($lastPersonIdFromPost) ? $lastPersonIdFromPost->firstName . ' ' . $lastPersonIdFromPost->lastName : ''; ?>
        </section>
    </div>
</section>