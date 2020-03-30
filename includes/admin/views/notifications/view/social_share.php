<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?= $notification->settings->border_radius ?> toto-social-share-wrapper" style="background: <?= $notification->settings->background_color ?>">
    <div class="toto-social-share-content">
        <p class="toto-social-share-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>

        <div class="toto-social-share-buttons">

            <?php if($notification->settings->share_facebook): ?>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($notification->settings->share_url) ?>&amp;src=sdkpreparse" target="_blank" class="toto-social-share-button toto-social-share-button-facebook">Facebook</a>
            <?php endif ?>

            <?php if($notification->settings->share_twitter): ?>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode($notification->settings->share_url) ?>" target="_blank" class="toto-social-share-button toto-social-share-button-twitter">Twitter</a>
            <?php endif ?>

            <?php if($notification->settings->share_linkedin): ?>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($notification->settings->share_url) ?>" target="_blank" class="toto-social-share-button toto-social-share-button-linkedin">Linkedin</a>
            <?php endif ?>

        </div>

        <p class="toto-social-share-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

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

        /* On click event to the button */
        main_element.querySelector('.toto-social-share-button').addEventListener('click', event => {

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
