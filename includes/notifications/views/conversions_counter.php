<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-conversions-counter-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-conversions-counter-content">

        <div class="trust-plus-conversions-counter-header">
            <div class="trust-plus-conversions-counter-number" style="background: <?php echo $notification->number_background_color ?>; color: <?php echo $notification->number_color ?>">
				<?php echo isset( $notification->count ) && $notification->count >= $notification->display_minimum_activity ? $notification->count : 5 ?>
            </div>

            <div>
                <p class="trust-plus-conversions-counter-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
                <p class="trust-plus-conversions-counter-time"><?php echo sprintf( __( 'In the last %s hours', 'social-proof-fomo-notification' ), $notification->last_activity ) ?></p>
            </div>
        </div>

		<?php trust_plus_branding( $notification ); ?>
    </div>

	<?php trust_plus_close( $notification ); ?>
</div>