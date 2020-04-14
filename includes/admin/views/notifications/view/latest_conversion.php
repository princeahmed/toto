<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-latest-conversion-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-latest-conversion-content">
		<?php if ( ! empty( $notification->image ) ) { ?>
            <img src="<?php echo $notification->image ?>" class="toto-latest-conversion-image"/>
		<?php } ?>

        <div>
            <p class="toto-latest-conversion-title" style="color: <?php echo $notification->title_color ?>"><?php echo isset( $notification->who ) && $notification->who ? $notification->who : $notification->title ?></p>
            <p class="toto-latest-conversion-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

            <div class="toto-latest-conversion-footer">
                <div class="toto-latest-conversion-time">
					<?php
					if ( isset( $notification->last_action_date ) && $notification->last_action_date ) {
						echo toto_get_timeago( $notification->last_action_date );
                    } else {
						echo '10 mins ago';
					} ?>
                </div>

				<?php toto_branding($notification); ?>

            </div>

        </div>
    </div>

    <span class="toto-close"></span>
</div>
