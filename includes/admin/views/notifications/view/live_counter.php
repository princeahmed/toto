<?php defined('ALTUMCODE') || die() ?>


<?php ob_start() ?>
<div class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> altumcode-live-counter-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="altumcode-live-counter-content">

        <div class="altumcode-live-counter-header">
            <div class="altumcode-toast-pulse" style="background: <?= $notification->settings->pulse_background_color ?>;"></div>

            <div class="altumcode-live-counter-number" style="background: <?= $notification->settings->number_background_color ?>; color: <?= $notification->settings->number_color ?>">
                <?= isset($notification->counter) && $notification->counter >= $notification->settings->display_minimum_activity ? $notification->counter : \Altum\Language::get()->notification->live_counter->number_default ?>
            </div>
        </div>

        <p class="altumcode-live-counter-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

        <?php if($notification->settings->display_branding): ?>
            <?php if(isset($notification->branding, $notification->branding->name, $notification->branding->url) && !empty($notification->branding->name) && !empty($notification->branding->url)): ?>
                <a href="<?= $notification->branding->url ?>" class="altumcode-site"><?= $notification->branding->name ?></a>
            <?php else: ?>
                <a href="<?= url() ?>" class="altumcode-site"><?= \Altum\Language::get()->notification->branding ?></a>
            <?php endif ?>
        <?php endif ?>
    </div>

    <span class="altumcode-close"></span>
</div>
<?php $html = ob_get_clean(); ?>


<?php ob_start() ?>
new AltumCodeManager({
    should_show: <?= json_encode(isset($notification->counter) && $notification->counter >= $notification->settings->display_minimum_activity) ?>,
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
