<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?= $notification->settings->border_radius ?> toto-random-review-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="toto-random-review-content">
        <?php if(!empty($notification->settings->image)): ?>
        <img src="<?= $notification->settings->image ?>" class="toto-random-review-image" />
        <?php endif ?>

        <div>
            <div class="toto-random-review-header">
                <p class="toto-random-review-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>

                <div class="toto-random-review-stars">
                    <?php for($i = 1; $i <= $notification->settings->stars; $i++): ?>
                    <div class="toto-toast-star">★</div>
                    <?php endfor ?>
                </div>

            </div>
            <p class="toto-random-review-description" style="color: <?= $notification->settings->description_color ?>">"<?= $notification->settings->description ?>"</p>

            <?php if($notification->settings->display_branding): ?>
                <?php if(isset($notification->branding, $notification->branding->name, $notification->branding->url) && !empty($notification->branding->name) && !empty($notification->branding->url)): ?>
                    <a href="<?= $notification->branding->url ?>" class="toto-site"><?= $notification->branding->name ?></a>
                <?php else: ?>
                    <a href="<?= url() ?>" class="toto-site"><?= \Altum\Language::get()->notification->branding ?></a>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>

    <span class="toto-close"></span>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    content: <?= json_encode($html) ?>,
    display_mobile: <?= json_encode($notification->settings->display_mobile) ?>,
    display_trigger: <?= json_encode($notification->settings->display_trigger) ?>,
    display_trigger_value: <?= json_encode($notification->settings->display_trigger_value) ?>,
    duration: <?= $notification->settings->display_duration === -1 ? -1 : $notification->settings->display_duration * 1000 ?>,
    url: <?= json_encode($notification->settings->url) ?>,
    close: <?= json_encode($notification->settings->display_close_button) ?>,
    once_per_session: <?= json_encode($notification->settings->display_once_per_session) ?>,
    position: <?= json_encode($notification->settings->display_position) ?>,
    stop_on_focus: true,
    trigger_all_pages: <?= json_encode($notification->settings->trigger_all_pages) ?>,
    triggers: <?= json_encode($notification->settings->triggers) ?>,

    notification_id: <?= $notification->notification_id ?>
}).initiate();
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
