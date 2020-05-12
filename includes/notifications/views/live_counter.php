<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-live-counter-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-live-counter-content">

        <div class="trust-plus-live-counter-header">
            <div class="trust-plus-toast-pulse" style="background: <?php echo $notification->pulse_background_color ?>;"></div>

            <div class="trust-plus-live-counter-number" style="background: <?php echo $notification->number_background_color ?>; color: <?php echo $notification->number_color ?>">
				<?php echo $notification->number; ?>
            </div>
        </div>

        <p class="trust-plus-live-counter-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

		<?php trust_plus_branding($notification); ?>

    </div>

    <?php trust_plus_close($notification); ?>
</div>
