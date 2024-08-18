<div class="overview-wrap">
    <div class="overview-left">
        <section class="about-work-heading">BASIC INFO</section>
        <section class="about-border"></section>
        <section class="contact-mobile" style="width: 100%;display:flex; ">
            <div class="contact-mobile-text setting" style="flex-basis:40%">Mobile Phones
        </section>
        <div class="contact-mobile-number setting" style="flex-basis:60%"><?php echo $userData->mobile ? $userData->mobile : $userData->email; ?></div>
        </section>
        <section class="about-border"></section>
        <section class="contact-id" style="width: 100%;display:flex; ">
            <div class="contact-id-text setting" style="flex-basis:40%">Facebook</div>
            <div class="contact-id-number setting" style="flex-basis:60%"><?php echo $userData->userLink; ?></div>
        </section>
        <br><br>
        <section class="about-work-heading">Address</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('address', $user_id, $profileId, 'Add your address');   ?>
        <section class="about-work-heading">WEBSITE AND SOCIAL LINKS</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('website', $user_id, $profileId, 'Add your website');   ?>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('socialLink', $user_id, $profileId, 'Add your social link'); ?>
        <section class="about-work-heading">BASIC INFORMATION</section>
        <section class="about-border"></section>
        <section class="contact-birthday setting" style="width: 100%;display:flex; ">
            <div class="contact-birthday-text" style="flex-basis:40%;font-size: 13px;color: gray;">Birth Date</div>
            <div class="contact-birthday-date" style="flex-basis:60%;font-size: 13px;color: black;"><?php echo $userData->birthday; ?></div>
        </section>
        <section class="about-border "></section>
        <section class="contact-birthyear setting" style="width: 100%;display:flex; ">
            <div class="contact-birthyear-text" style="flex-basis:40%;font-size: 13px;color: gray;"> Birth Year</div>
            <div class="contact-birthyear-date" style="flex-basis:60%;font-size: 13px;color: black;">1990</div>
        </section>
        <section class="about-border "></section>
        <section class="contact-gender setting" style="width: 100%;display:flex; ">
            <div class="contact-gender-text" style="flex-basis:40%;font-size: 13px;color: gray;">Gender</div>
            <div class="contact-gender-date" style="flex-basis:60%;font-size: 13px;color: black;"><?php echo $userData->gender; ?></div>
        </section>
        <br>
        <section class="about-work-heading">LANGUAGE</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('language', $user_id, $profileId, 'Add your language'); ?>
        <br>
        <section class="about-work-heading">RELIGIOUS VIEWS</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('religion', $user_id, $profileId, 'Add your religion'); ?>
        <br>
        <section class="about-work-heading">POLITICAL VIEWS</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('politicalViews', $user_id, $profileId, 'Add your political views'); ?>
    </div>
</div>