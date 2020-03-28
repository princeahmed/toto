<?php defined('ALTUMCODE') || die() ?>


<?php ob_start() ?>
<div class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> altumcode-latest-conversion-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="altumcode-latest-conversion-content">
        <?php if(!empty($notification->settings->image)): ?>
        <img src="<?= $notification->settings->image ?>" class="altumcode-latest-conversion-image" />
        <?php endif ?>

        <div>
            <p class="altumcode-latest-conversion-title" style="color: <?= $notification->settings->title_color ?>"><?= isset($notification->who) && $notification->who ? $notification->who : $notification->settings->title ?></p>
            <p class="altumcode-latest-conversion-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

            <div class="altumcode-latest-conversion-footer">
                <div class="altumcode-latest-conversion-time">
                    <?php if(isset($notification->last_action_date) && $notification->last_action_date): ?>
                        <?= \Altum\Date::get_timeago($notification->last_action_date) ?>
                    <?php else: ?>
                        <?= \Altum\Language::get()->notification->latest_conversion->time_ago_default ?>
                    <?php endif ?>
                </div>

                <?php if($notification->settings->display_branding): ?>
                    <?php if(isset($notification->branding, $notification->branding->name, $notification->branding->url) && !empty($notification->branding->name) && !empty($notification->branding->url)): ?>
                        <a href="<?= $notification->branding->url ?>" class="altumcode-site"><?= $notification->branding->name ?></a>
                    <?php else: ?>
                        <a href="<?= url() ?>" class="altumcode-site"><?= \Altum\Language::get()->notification->branding ?></a>
                    <?php endif ?>
                <?php endif ?>
            </div>

        </div>
    </div>

    <span class="altumcode-close"></span>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    should_show: true,
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
