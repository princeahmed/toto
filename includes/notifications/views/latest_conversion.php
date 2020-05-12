<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-latest-conversion-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-latest-conversion-content">

            <img src="<?php echo $notification->image ?>" class="trust-plus-latest-conversion-image <?php echo ! empty( $notification->image ) ? '': 'hidden'; ?>"/>

        <div>
            <p class="trust-plus-latest-conversion-title" style="color: <?php echo $notification->title_color ?>"><?php echo isset( $notification->who ) && $notification->who ? $notification->who : $notification->title ?></p>
            <p class="trust-plus-latest-conversion-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

            <div class="trust-plus-latest-conversion-footer">
                <div class="trust-plus-latest-conversion-time">
					<?php
					if ( isset( $notification->last_action_date ) && $notification->last_action_date ) {
						echo trust_plus_get_timeago( $notification->last_action_date );
                    } else {
						echo __('10 mins ago', 'social-proof-fomo-notification');
					} ?>
                </div>

				<?php trust_plus_branding($notification); ?>

            </div>

        </div>
    </div>

    <?php trust_plus_close($notification); ?>
</div>
