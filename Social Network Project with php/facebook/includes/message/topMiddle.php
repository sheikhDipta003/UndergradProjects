<section class="top-middle">
    <div class="top-area">
        <div class="top-user-name-pic-wrap">
            <section class="top-msg-user-photo">
                <img src="<?php echo !empty($lastPersonIdFromPost) ? $lastPersonIdFromPost->profilePic : 'assets/image/defaultProfile.png'; ?>" alt="" style="height: 40px; width: 40px; border-radius: 50%;">
            </section>
            <section class="top-msg-user-name align-middle">
                <?php echo !empty($lastPersonIdFromPost) ? $lastPersonIdFromPost->firstName . ' ' . $lastPersonIdFromPost->lastName : ''; ?>
            </section>
        </div>
    </div>

    <div class="msgg-details" style="height: 78%; overflow-y: scroll;">
        <div class="msg-show-wrap">
            <section class="user-info"
                data-userid="<?php echo $userid; ?>"
                data-lastpersonid="<?php echo !empty($lastpersonid) ? $lastpersonid : ''; ?>">
            </section>
            <section class="msg-box" style="display: flex; flex-direction: column;"></section>
        </div>
    </div>

    <div class="img-text-send-show">
        <section class="msg-image-up"><i class="fa fa-picture-o" aria-hidden="true"></i></section>
        <textarea id="msgInput" cols="30" rows="10" placeholder="type a message..."></textarea>
        <section class="msg-send-btn"></section>
    </div>
</section>