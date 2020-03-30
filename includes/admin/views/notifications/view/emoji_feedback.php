<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?= $notification->settings->border_radius ?> toto-emoji-feedback-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="toto-emoji-feedback-content">
        <p class="toto-emoji-feedback-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>

        <div class="toto-emoji-feedback-emojis">
            <?php if($notification->settings->show_angry): ?>
            <img src="<?= url(ASSETS_URL_PATH . 'images/emojis/angry.svg') ?>" class="toto-emoji-feedback-emoji" data-type="angry" />
            <?php endif ?>

            <?php if($notification->settings->show_sad): ?>
            <img src="<?= url(ASSETS_URL_PATH . 'images/emojis/sad.svg') ?>" class="toto-emoji-feedback-emoji" data-type="sad" />
            <?php endif ?>

            <?php if($notification->settings->show_neutral): ?>
            <img src="<?= url(ASSETS_URL_PATH . 'images/emojis/neutral.svg') ?>" class="toto-emoji-feedback-emoji" data-type="neutral" />
            <?php endif ?>

            <?php if($notification->settings->show_happy): ?>
            <img src="<?= url(ASSETS_URL_PATH . 'images/emojis/happy.svg') ?>" class="toto-emoji-feedback-emoji" data-type="happy" />
            <?php endif ?>

            <?php if($notification->settings->show_excited): ?>
            <img src="<?= url(ASSETS_URL_PATH . 'images/emojis/excited.svg') ?>" class="toto-emoji-feedback-emoji" data-type="excited" />
            <?php endif ?>
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
        let emojis = main_element.querySelectorAll('.toto-emoji-feedback-emoji');

        for(let emoji of emojis) {
            emoji.addEventListener('click', event => {

                /* Trigger the animation */
                emoji.className += ' toto-emoji-feedback-emoji-clicked';

                /* Get all the other emojis and remove them */
                let other_emojis = main_element.querySelectorAll('.toto-emoji-feedback-emoji:not(.toto-emoji-feedback-emoji-clicked)');
                for(let other_emoji of other_emojis) {
                    other_emoji.remove();
                }

                let notification_id = main_element.getAttribute('data-notification-id');
                let feedback = emoji.getAttribute('data-type');

                send_tracking_data({
                    ...user,
                    notification_id: notification_id,
                    type: 'notification',
                    subtype: `feedback_emoji_${feedback}`
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
