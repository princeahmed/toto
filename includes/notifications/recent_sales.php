<?php defined( 'ABSPATH' ) || die() ?>

<div class="notification-plus-wrapper notification-plus-wrapper-<?php echo $notification->border_radius ?> notification-plus-recent-sales-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="notification-plus-recent-sales-content">

        <img src="<?php echo $notification->image ?>" class="notification-plus-recent-sales-image <?php echo ! empty( $notification->image ) ? '' : 'hidden'; ?>"/>

        <div>
            <p class="notification-plus-recent-sales-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->who; ?></p>
            <p class="notification-plus-recent-sales-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->text ?></p>

            <div class="notification-plus-recent-sales-footer">
                <div class="notification-plus-recent-sales-time">
					<?php
					if ( isset( $notification->last_action_date ) && $notification->last_action_date ) {
						echo notification_plus_get_timeago( $notification->last_action_date );
					} else {
						echo __( '10 mins ago', 'notification-plus' );
					} ?>
                </div>

				<?php notification_plus_branding( $notification ); ?>

            </div>

        </div>
    </div>

	<?php notification_plus_close( $notification ); ?>
</div>
