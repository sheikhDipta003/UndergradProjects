<div class="overview-wrap" style="flex-basis:70%; ">
    <div class="overview-left">
        <section class="about-work-heading">WORK</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('workplace', $userid, $profileId, 'Add a workplace'); ?>

        <section class="about-work-heading">SCHOOL</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('highSchool', $userid, $profileId, 'Add high school'); ?>

        <section class="about-work-heading">PLACE</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('address', $userid, $profileId, 'Add your current place'); ?>

        <section class="about-work-heading">RELATIONSHIP</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('relationship', $userid, $profileId, 'Add your relationship status'); ?>
    </div>

    <div class="overview-right" style="flex-basis:30%;">
        <a href="settings.php" class="overview-right">
            <section class="overview-mobile align-middle" style="margin-bottom:10px;">
                <div class="overview-mobile-icon align-middle"><img src="assets/image/profile/overview%20mobile.JPG" alt="" style="margin-right:5px;"></div>
                <div class="overview-mobile-number"><?php echo $userData->mobile ? $userData->mobile : $userData->email; ?></div>
            </section>
            <section class="overview-birthday align-middle">
                <div class="overview-mobile-icon align-middle"><img src="assets/image/profile/overview%20birthday.JPG" alt="" style="margin-right:5px;"></div>
                <div class="overview-mobile-number"><?php echo $userData->birthday; ?></div>
            </section>
        </a>
    </div>
</div>