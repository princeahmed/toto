<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-live-counter-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-live-counter-content">

        <div class="toto-live-counter-header">
            <div class="toto-toast-pulse" style="background: <?php echo $notification->pulse_background_color ?>;"></div>

            <div class="toto-live-counter-number" style="background: <?php echo $notification->number_background_color ?>; color: <?php echo $notification->number_color ?>">
				<?php echo $notification->number; ?>
            </div>
        </div>

        <p class="toto-live-counter-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

		<?php toto_branding($notification); ?>

    </div>

    <?php toto_close($notification); ?>
</div>
