<?php defined('ABSPATH') || die() ?>

<?php ob_start() ?>
<div class="altumcode-wrapper altumcode-email-collector-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="altumcode-email-collector-content">
        <p class="altumcode-email-collector-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>
        <p class="altumcode-email-collector-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>


        <form id="altumcode-email-collector-form" class="altumcode-email-collector-form" name="" action="" method="GET" role="form">
            <div class="altumcode-email-collector-row">
                <input type="text" class="" name="email" placeholder="<?= $notification->settings->email_placeholder ?>" required="required" />

                <button type="submit" name="button" style="color: <?= $notification->settings->button_color ?>; background: <?= $notification->settings->button_background_color ?>"><?= $notification->settings->button_text ?></button>
            </div>

            <?php if($notification->settings->show_agreement): ?>
                <div class="altumcode-agreement-checkbox">
                    <input type="checkbox" id="agreement" name="agreement" required="required" />
                    <label for="agreement" class="altumcode-agreement-checkbox-text" style="color: <?= $notification->settings->description_color ?>">
                        <a href="<?= $notification->settings->agreement_url ?>">
                            <?= $notification->settings->agreement_text ?>
                        </a>
                    </label>
                </div>
            <?php endif ?>
        </form>

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
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    should_show: !localStorage.getItem('notification_<?= $notification->notification_id ?>_converted'),
    content: <?= json_encode($html) ?>,
    display_mobile: <?= json_encode($notification->settings->display_mobile) ?>,
    display_trigger: <?= json_encode($notification->settings->display_trigger) ?>,
    display_trigger_value: <?= json_encode($notification->settings->display_trigger_value) ?>,
    duration: <?= $notification->settings->display_duration === -1 ? -1 : $notification->settings->display_duration * 1000 ?>,
    close: <?= json_encode($notification->settings->display_close_button) ?>,
    once_per_session: <?= json_encode($notification->settings->display_once_per_session) ?>,
    position: <?= json_encode($notification->settings->display_position) ?>,
    stop_on_focus: true,
    trigger_all_pages: <?= json_encode($notification->settings->trigger_all_pages) ?>,
    triggers: <?= json_encode($notification->settings->triggers) ?>,

    notification_id: <?= $notification->notification_id ?>
}).initiate({
    displayed: main_element => {

        /* Form submission */
        main_element.querySelector('#altumcode-email-collector-form').addEventListener('submit', event => {

            let email = event.currentTarget.querySelector('[name="email"]').value;
            let notification_id = main_element.getAttribute('data-notification-id');


            if(email.trim() != '') {

                /* Data collection from the form */
                send_tracking_data({
                    ...user,
                    notification_id: notification_id,
                    type: 'collector',
                    email
                });

                AltumCodeManager.remove_notification(main_element);

                /* Make sure to let the browser know of the conversion so that it is not shown again */
                localStorage.setItem('notification_<?= $notification->notification_id ?>_converted', true);

            }

            event.preventDefault();
        });

    }
});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
