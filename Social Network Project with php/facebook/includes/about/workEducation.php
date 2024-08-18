<div class="overview-wrap">
    <div class="overview-left">
        <section class="about-work-heading">WORK</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('workplace', $userid, $profileId, 'Add        workplace'); ?>

        <section class="about-work-heading">PROFESSIONAL SKILL</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('professional', $userid, $profileId, 'Add your professional skills'); ?>

        <section class="about-work-heading">COLLEGE</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('college', $userid, $profileId, 'Add college'); ?>

        <section class="about-work-heading">HIGH SCHOOL</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('highSchool', $userid, $profileId, 'Add high school'); ?>
    </div>
</div>