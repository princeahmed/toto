<?php defined( 'ABSPATH' ) || die(); ?>
<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-informational-wrapper" style="background: <?php echo $notification->background_color ?>">

    <div class="toto-informational-content">

            <img src="<?php echo $notification->image ?>" class="toto-informational-image <?php echo ! empty( $notification->image ) ? '': 'hidden'; ?>"/>

        <div>
            <p class="toto-informational-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="toto-informational-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

			<?php toto_branding( $notification ); ?>

        </div>
    </div>

    <?php toto_close($notification); ?>
</div>
