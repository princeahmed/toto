<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?= $notification->settings->border_radius ?> toto-request-collector-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="toto-request-collector-content">
        <div class="toto-request-collector-header">
            <img src="<?= $notification->settings->image ?>" class="toto-request-collector-image" />

            <div>
                <p class="toto-request-collector-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>
                <p class="toto-request-collector-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>
            </div>
        </div>

        <p class="toto-request-collector-content-title" style="color: <?= $notification->settings->content_title_color ?>"><?= $notification->settings->content_title ?></p>
        <p class="toto-request-collector-content-description" style="color: <?= $notification->settings->content_description_color ?>"><?= $notification->settings->content_description ?></p>

        <div>
            <form class="toto-request-collector-form" id="toto-request-collector-form" name="" action="" method="GET" role="form">
                <div class="toto-request-collector-row">
                    <input type="text" class="" name="input" placeholder="<?= $notification->settings->input_placeholder ?>" />

                    <button type="submit" name="button" style="color: <?= $notification->settings->button_color ?>; background: <?= $notification->settings->button_background_color ?>"><?= $notification->settings->button_text ?></button>
                </div>

                <?php if($notification->settings->show_agreement): ?>
                    <div class="toto-agreement-checkbox">
                        <input type="checkbox" id="agreement" name="agreement" required="required" />
                        <label for="agreement" class="toto-agreement-checkbox-text" style="color: <?= $notification->settings->description_color ?>">
                            <a href="<?= $notification->settings->agreement_url ?>">
                                <?= $notification->settings->agreement_text ?>
                            </a>
                        </label>
                    </div>
                <?php endif ?>
            </form>

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
        main_element.querySelector('#toto-request-collector-form').addEventListener('submit', event => {

            let input = event.currentTarget.querySelector('[name="input"]').value;
            let notification_id = main_element.getAttribute('data-notification-id');


            if(input.trim() != '') {

                /* Data collection from the form */
                send_tracking_data({
                    ...user,
                    notification_id: notification_id,
                    type: 'collector',
                    input
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
