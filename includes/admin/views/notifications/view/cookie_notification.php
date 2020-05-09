<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-cookie-notification-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-cookie-notification-content">

        <div class="toto-cookie-notification-header">
            <img src="<?php echo ! empty( $notification->image ) ? $notification->image : ''; ?>" class="toto-cookie-notification-image <?php echo ! empty( $notification->image ) ? '' : 'hidden'; ?>"/>

            <div>
            <p class="toto-cookie-notification-description" style="color: <?php echo $notification->description_color ?>">
				<?php echo $notification->description ?>
            </p>

            <span class="toto-cookie-notification-url">
                    <a href="<?php echo $notification->link_url ?>"><?php echo $notification->link_url_text ?></a></span>
            </div>
        </div>

        <button type="button" class="toto-cookie-notification-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></button>

		<?php toto_branding( $notification ); ?>
    </div>

    <span class="toto-close"><?php echo $notification->display_close_button ? '&#10006;' : ''; ?></span>
</div>
