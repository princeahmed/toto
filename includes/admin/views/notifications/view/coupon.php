<?php defined('ABSPATH') || die() ?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-coupon-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-coupon-content">
        <?php if(!empty($notification->image)): ?>
        <img src="<?php echo $notification->image ?>" class="toto-coupon-image" />
        <?php endif ?>

        <div>
            <p class="toto-coupon-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="toto-coupon-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

            <div class="toto-coupon-coupon-code"><?php echo $notification->coupon_code ?></div>

            <a href="<?php echo $notification->button_url ?>" class="toto-coupon-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></a>

            <div>
                <a href="#" class="toto-coupon-footer"><?php echo $notification->footer_text ?></a>
            </div>

            <?php if($notification->display_branding): ?>
                <?php if(isset($notification->branding, $notification->branding->name, $notification->branding->url) && !empty($notification->branding->name) && !empty($notification->branding->url)): ?>
                    <a href="<?php echo $notification->branding->url ?>" class="toto-site"><?php echo $notification->branding->name ?></a>
                <?php else: ?>
                    <a href="" class="toto-site">\Altum\Language::get()->notification->branding </a>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>

    <span class="toto-close"></span>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    content: <?php echo json_encode($html) ?>,
    display_mobile: <?php echo json_encode($notification->display_mobile) ?>,
    display_trigger: <?php echo json_encode($notification->display_trigger) ?>,
    display_trigger_value: <?php echo json_encode($notification->display_trigger_value) ?>,
    duration: <?php echo $notification->display_duration === -1 ? -1 : $notification->display_duration * 1000 ?>,
    url: '',
    close: <?php echo json_encode($notification->display_close_button) ?>,
    once_per_session: <?php echo json_encode($notification->display_once_per_session) ?>,
    position: <?php echo json_encode($notification->display_position) ?>,
    stop_on_focus: true,
    trigger_all_pages: <?php echo json_encode($notification->trigger_all_pages) ?>,
    triggers: <?php echo json_encode($notification->triggers) ?>,

    notification_id: <?php echo $notification->notification_id ?>
}).initiate({
    displayed: main_element => {

        /* On click the footer remove element */
        main_element.querySelector('.toto-coupon-footer').addEventListener('click', event => {

            AltumCodeManager.remove_notification(main_element);

            event.preventDefault();

        });

        /* On click event to the button */
        main_element.querySelector('.toto-coupon-button').addEventListener('click', event => {

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
