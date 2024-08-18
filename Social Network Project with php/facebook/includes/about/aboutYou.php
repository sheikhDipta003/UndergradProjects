<div class="overview-wrap">
    <div class="overview-left">
        <section class="about-work-heading">ABOUT YOU</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('aboutYou', $user_id, $profileId, 'Write about you'); ?><br>
        <section class="about-work-heading"> OTHER NAMES</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('otherName', $user_id, $profileId, 'Add your other name'); ?>
        <br>
        <section class="about-work-heading">FABORIT QUOTES</section>
        <section class="about-border"></section>
        <?php $loadFromPost->aboutOverview('quotes', $user_id, $profileId, 'Add your favourite quotes'); ?>
    </div>
</div>