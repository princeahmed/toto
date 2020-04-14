<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-conversions-counter-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-conversions-counter-content">

        <div class="toto-conversions-counter-header">
            <div class="toto-conversions-counter-number" style="background: <?php echo $notification->number_background_color ?>; color: <?php echo $notification->number_color ?>">
				<?php echo isset( $notification->counter ) && $notification->counter >= $notification->display_minimum_activity ? $notification->counter : 5 ?>
            </div>

            <div>
                <p class="toto-conversions-counter-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
                <p class="toto-conversions-counter-time"><?php echo sprintf( 'In the last %s hours', $notification->last_activity ) ?></p>
            </div>
        </div>

		<?php toto_branding( $notification ); ?>
    </div>

    <span class="toto-close"></span>
</div>