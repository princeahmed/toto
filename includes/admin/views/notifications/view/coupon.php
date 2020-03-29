<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> altumcode-coupon-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="altumcode-coupon-content">
        <?php if(!empty($notification->settings->image)): ?>
        <img src="<?= $notification->settings->image ?>" class="altumcode-coupon-image" />
        <?php endif ?>

        <div>
            <p class="altumcode-coupon-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>
            <p class="altumcode-coupon-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

            <div class="altumcode-coupon-coupon-code"><?= $notification->settings->coupon_code ?></div>

            <a href="<?= $notification->settings->button_url ?>" class="altumcode-coupon-button" style="background: <?= $notification->settings->button_background_color ?>;color: <?= $notification->settings->button_color ?>"><?= $notification->settings->button_text ?></a>

            <div>
                <a href="#" class="altumcode-coupon-footer"><?= $notification->settings->footer_text ?></a>
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

    <span class="altumcode-close"></span>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    content: <?= json_encode($html) ?>,
    display_mobile: <?= json_encode($notification->settings->display_mobile) ?>,
    display_trigger: <?= json_encode($notification->settings->display_trigger) ?>,
    display_trigger_value: <?= json_encode($notification->settings->display_trigger_value) ?>,
    duration: <?= $notification->settings->display_duration === -1 ? -1 : $notification->settings->display_duration * 1000 ?>,
    url: '',
    close: <?= json_encode($notification->settings->display_close_button) ?>,
    once_per_session: <?= json_encode($notification->settings->display_once_per_session) ?>,
    position: <?= json_encode($notification->settings->display_position) ?>,
    stop_on_focus: true,
    trigger_all_pages: <?= json_encode($notification->settings->trigger_all_pages) ?>,
    triggers: <?= json_encode($notification->settings->triggers) ?>,

    notification_id: <?= $notification->notification_id ?>
}).initiate({
    displayed: main_element => {

        /* On click the footer remove element */
        main_element.querySelector('.altumcode-coupon-footer').addEventListener('click', event => {

            AltumCodeManager.remove_notification(main_element);

            event.preventDefault();

        });

        /* On click event to the button */
        main_element.querySelector('.altumcode-coupon-button').addEventListener('click', event => {

            let notification_id = main_element.getAttribute('data-notification-id');

            send_tracking_data({
                ...user,
                notification_id: notification_id,
                type: 'notification',
                subtype: 'click'
            });

        });

    }
});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
