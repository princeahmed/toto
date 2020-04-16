<?php defined( 'ABSPATH' ) || die(); ?>
<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-informational-wrapper" style="background: <?php echo $notification->background_color ?>">

    <div class="toto-informational-content">
		<?php if ( ! empty( $notification->image ) ): ?>
            <img src="<?php echo $notification->image ?>" class="toto-informational-image"/>
		<?php endif ?>

        <div>
            <p class="toto-informational-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="toto-informational-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

			<?php toto_branding( $notification ); ?>

        </div>
    </div>

    <span class="toto-close">
        <?php echo $notification->display_close_button ? '&#10006;' : ''; ?>
    </span>
</div>
