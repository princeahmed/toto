<?php defined( 'ABSPATH' ) || die() ?>

<?php ob_start() ?>
<div class="toto-wrapper toto-email-collector-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-email-collector-content">
        <p class="toto-email-collector-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
        <p class="toto-email-collector-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>


        <form id="toto-email-collector-form" class="toto-email-collector-form" name="" action="" method="GET" role="form">
            <div class="toto-email-collector-row">
                <input type="text" class="toto-email-collector-email-placeholder" name="email" placeholder="<?php echo $notification->email_placeholder ?>" required="required"/>

                <button type="submit" class="toto-email-collector-button" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
            </div>

			<?php if ( $notification->show_agreement ): ?>
                <div class="toto-agreement-checkbox">
                    <input type="checkbox" id="agreement" name="agreement" required="required"/>
                    <label for="agreement" class="toto-agreement-checkbox-text" style="color: <?php echo $notification->description_color ?>">
                        <a href="<?php echo $notification->agreement_url ?>">
							<?php echo $notification->agreement_text ?>
                        </a>
                    </label>
                </div>
			<?php endif ?>
        </form>

		<?php if ( $notification->display_branding ): ?><?php if ( isset( $notification->branding, $notification->branding->name, $notification->branding->url ) && ! empty( $notification->branding->name ) && ! empty( $notification->branding->url ) ): ?>
            <a href="<?php echo $notification->branding->url ?>" class="toto-site"><?php echo $notification->branding->name ?></a>
		<?php else: ?>
		<?php endif ?><?php endif ?>
    </div>

    <span class="toto-close"></span>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({should_show: !localStorage.getItem('notification_<?php echo $notification->notification_id ?>_converted'),content: <?php echo json_encode( $html ) ?>,display_mobile: <?php echo json_encode( $notification->display_mobile ) ?>,display_trigger: <?php echo json_encode( $notification->display_trigger ) ?>,display_trigger_value: <?php echo json_encode( $notification->display_trigger_value ) ?>,duration: <?php echo $notification->display_duration === - 1 ? - 1 : $notification->display_duration * 1000 ?>,close: <?php echo json_encode( $notification->display_close_button ) ?>,once_per_session: <?php echo json_encode( $notification->display_once_per_session ) ?>,position: <?php echo json_encode( $notification->display_position ) ?>,stop_on_focus: true,trigger_all_pages: <?php echo json_encode( $notification->trigger_all_pages ) ?>,triggers: <?php echo json_encode( $notification->triggers ) ?>,

notification_id: <?php echo $notification->notification_id ?>
}).initiate({displayed: main_element => {

/* Form submission */main_element.querySelector('#toto-email-collector-form').addEventListener('submit', event => {

let email = event.currentTarget.querySelector('[name="email"]').value;let notification_id = main_element.getAttribute('data-notification-id');


if(email.trim() != '') {

/* Data collection from the form */send_tracking_data({...user,notification_id: notification_id,type: 'collector',email});

AltumCodeManager.remove_notification(main_element);

/* Make sure to let the browser know of the conversion so that it is not shown again */localStorage.setItem('notification_<?php echo $notification->notification_id ?>_converted', true);

}

event.preventDefault();});

}});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) [ 'html' => $html, 'javascript' => $javascript ] ?>
