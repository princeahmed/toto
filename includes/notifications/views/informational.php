<?php defined( 'ABSPATH' ) || die(); ?>
<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-informational-wrapper" style="background: <?php echo $notification->background_color ?>">

    <div class="trust-plus-informational-content">

            <img src="<?php echo $notification->image ?>" class="trust-plus-informational-image <?php echo ! empty( $notification->image ) ? '': 'hidden'; ?>"/>

        <div>
            <p class="trust-plus-informational-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="trust-plus-informational-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

			<?php trust_plus_branding( $notification ); ?>

        </div>
    </div>

    <?php trust_plus_close($notification); ?>
</div>
