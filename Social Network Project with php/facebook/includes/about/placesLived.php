<div class="overview-wrap">
    <div class="overview-left">
        <section class="about-work-heading">CURRENT CITY</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('currentCity', $userid, $profileId, 'Add your current city'); ?>

        <section class="about-work-heading">HOMETOWN</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('hometown', $userid, $profileId, 'Add hometown'); ?>

        <section class="about-work-heading">OTHER PLACES LIVED</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('otherPlace', $userid, $profileId, 'Add other place'); ?>
    </div>
</div>
