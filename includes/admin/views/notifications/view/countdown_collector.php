<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<?php $date_ended = new \DateTime($notification->settings->end_date) < new \DateTime() ?>
<?php $date = (new \DateTime($notification->settings->end_date))->diff(new \DateTime()) ?>
<div class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> altumcode-countdown-collector-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="altumcode-countdown-collector-content">
        <p class="altumcode-countdown-collector-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>
        <p class="altumcode-countdown-collector-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

        <p class="altumcode-countdown-collector-content-title" style="color: <?= $notification->settings->content_title_color ?>"><?= $notification->settings->content_title ?></p>

        <div class="altumcode-countdown-collector-timer">
            <input type="hidden" name="end_date" value="<?= (new \DateTime($notification->settings->end_date))->getTimestamp() ?>" />

            <div class="altumcode-countdown-collector-timer-block">
                <div class="altumcode-countdown-collector-time" data-type="days"><?= $date_ended ? '0' : $date->format('%a') ?></div>
                <p class="altumcode-countdown-collector-time-text"><?= \Altum\Language::get()->notification->countdown_collector->days ?></p>
            </div>

            <div class="altumcode-countdown-collector-timer-block">
                <div class="altumcode-countdown-collector-time" data-type="hours"><?= $date_ended ? '0' : $date->format('%h') ?></div>
                <p class="altumcode-countdown-collector-time-text"><?= \Altum\Language::get()->notification->countdown_collector->hours ?></p>
            </div>

            <div class="altumcode-countdown-collector-timer-block">
                <div class="altumcode-countdown-collector-time" data-type="minutes"><?= $date_ended ? '0' : $date->format('%i') ?></div>
                <p class="altumcode-countdown-collector-time-text"><?= \Altum\Language::get()->notification->countdown_collector->minutes ?></p>
            </div>

            <div class="altumcode-countdown-collector-timer-block">
                <div class="altumcode-countdown-collector-time" data-type="seconds"><?= $date_ended ? '0' : $date->format('%s') ?></div>
                <p class="altumcode-countdown-collector-time-text"><?= \Altum\Language::get()->notification->countdown_collector->seconds ?></p>
            </div>
        </div>

        <div>
            <form class="altumcode-countdown-collector-form" id="altumcode-countdown-collector-form" name="" action="" method="GET" role="form">
                <div class="altumcode-countdown-collector-row">
                    <input type="text" class="" name="input" placeholder="<?= $notification->settings->input_placeholder ?>" />

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
    </div>

    <span class="altumcode-close"></span>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    should_show: <?= json_encode(!$date_ended) ?>,
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

        /* Countdown */
        let end_date = new Date(main_element.querySelector('[name="end_date"]').value);

        let countdown = () => {
            let days_element = main_element.querySelector('[data-type="days"]');
            let hours_element = main_element.querySelector('[data-type="hours"]');
            let minutes_element = main_element.querySelector('[data-type="minutes"]');
            let seconds_element = main_element.querySelector('[data-type="seconds"]');

            let days = parseInt(days_element.innerText);
            let hours = parseInt(hours_element.innerText);
            let minutes = parseInt(minutes_element.innerText);
            let seconds = parseInt(seconds_element.innerText);

            let new_days = days;
            let new_hours = hours;
            let new_minutes = minutes;
            let new_seconds = seconds - 1;

            if(new_seconds < 0 && new_minutes > 0) {
                new_seconds = 60;
                new_minutes--;

                if(new_minutes < 0 && new_hours > 0) {
                    new_minutes = 60;
                    new_hours--;

                    if(new_hours < 0 && new_days > 0) {
                        new_hours = 60;
                        new_days--;

                        if(new_days < 0) {
                            new_days = 0;
                        }
                    }
                }
            }

            /* Check if the timer is up */
            if(days == 0 && hours == 0 && minutes == 0 && seconds == 0) {
                clearInterval(countdown_interval);

                AltumCodeManager.remove_notification(main_element);
            }

            /* Set the new values */
            days_element.innerText = new_days;
            hours_element.innerText = new_hours;
            minutes_element.innerText = new_minutes;
            seconds_element.innerText = new_seconds;
        };

        let countdown_interval = setInterval(countdown, 1000);

        /* Form submission */
        main_element.querySelector('#altumcode-countdown-collector-form').addEventListener('submit', event => {

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
