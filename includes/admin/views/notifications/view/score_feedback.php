<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?= $notification->settings->border_radius ?> toto-score-feedback-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="toto-score-feedback-content">
        <p class="toto-score-feedback-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>

        <div class="toto-score-feedback-scores">
            <button type="button" class="toto-score-feedback-button" data-score="1" style="background: <?= $notification->settings->button_background_color ?>;color: <?= $notification->settings->button_color ?>"><?= \Altum\Language::get()->notification->score_feedback->feedback_score_1 ?></button>
            <button type="button" class="toto-score-feedback-button" data-score="2" style="background: <?= $notification->settings->button_background_color ?>;color: <?= $notification->settings->button_color ?>"><?= \Altum\Language::get()->notification->score_feedback->feedback_score_2 ?></button>
            <button type="button" class="toto-score-feedback-button" data-score="3" style="background: <?= $notification->settings->button_background_color ?>;color: <?= $notification->settings->button_color ?>"><?= \Altum\Language::get()->notification->score_feedback->feedback_score_3 ?></button>
            <button type="button" class="toto-score-feedback-button" data-score="4" style="background: <?= $notification->settings->button_background_color ?>;color: <?= $notification->settings->button_color ?>"><?= \Altum\Language::get()->notification->score_feedback->feedback_score_4 ?></button>
            <button type="button" class="toto-score-feedback-button" data-score="5" style="background: <?= $notification->settings->button_background_color ?>;color: <?= $notification->settings->button_color ?>"><?= \Altum\Language::get()->notification->score_feedback->feedback_score_5 ?></button>
        </div>

        <p class="toto-score-feedback-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

        <?php if($notification->settings->display_branding): ?>
            <?php if(isset($notification->branding, $notification->branding->name, $notification->branding->url)):  ?>
                <a href="<?= $notification->branding->url ?>" class="toto-site"><?= $notification->branding->name ?></a>
            <?php else: ?>
                <a href="<?= url() ?>" class="toto-site"><?= \Altum\Language::get()->notification->branding ?></a>
            <?php endif ?>
        <?php endif ?>
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

        /* On click event to the button */
        let scores = main_element.querySelectorAll('.toto-score-feedback-button');

        for(let score of scores) {
            score.addEventListener('click', event => {

                /* Trigger the animation */
                score.className += ' toto-score-feedback-button-clicked';

                /* Get all the other emojis and remove them */
                let other_scores = main_element.querySelectorAll('.toto-score-feedback-button:not(.toto-score-feedback-button-clicked)');
                for(let other_score of other_scores) {
                    other_score.remove();
                }

                let notification_id = main_element.getAttribute('data-notification-id');
                let feedback = score.getAttribute('data-score');

                send_tracking_data({
                    ...user,
                    notification_id: notification_id,
                    type: 'notification',
                    subtype: `feedback_score_${feedback}`
                });

                /* Make sure to let the browser know of the conversion so that it is not shown again */
                localStorage.setItem('notification_<?= $notification->notification_id ?>_converted', true);

                setTimeout(() => {
                    AltumCodeManager.remove_notification(main_element);
                }, 950);

            });
        }


    }
});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>