<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?= $notification->settings->border_radius ?> toto-conversions-counter-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="toto-conversions-counter-content">

        <div class="toto-conversions-counter-header">
            <div class="toto-conversions-counter-number" style="background: <?= $notification->settings->number_background_color ?>; color: <?= $notification->settings->number_color ?>">
                <?= isset($notification->counter) && $notification->counter >= $notification->settings->display_minimum_activity ? $notification->counter : \Altum\Language::get()->notification->conversions_counter->number_default ?>
            </div>

            <div>
                <p class="toto-conversions-counter-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>
                <p class="toto-conversions-counter-time"><?= sprintf(\Altum\Language::get()->notification->conversions_counter->time_default, $notification->settings->last_activity) ?></p>
            </div>
        </div>

        <?php if($notification->settings->display_branding): ?>
            <?php if(isset($notification->branding, $notification->branding->name, $notification->branding->url) && !empty($notification->branding->name) && !empty($notification->branding->url)): ?>
                <a href="<?= $notification->branding->url ?>" class="toto-site"><?= $notification->branding->name ?></a>
            <?php else: ?>
                <a href="<?= url() ?>" class="toto-site"><?= \Altum\Language::get()->notification->branding ?></a>
            <?php endif ?>
        <?php endif ?>
    </div>

    <span class="toto-close"></span>
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
    data_trigger_auto: <?= json_encode($notification->settings->data_trigger_auto) ?>,
    data_triggers_auto: <?= json_encode($notification->settings->data_triggers_auto) ?>,

    notification_id: <?= $notification->notification_id ?>
}).initiate();
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
