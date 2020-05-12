<?php defined( 'ABSPATH' ) || die(); ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-cookie-notification-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-cookie-notification-content">

        <div class="trust-plus-cookie-notification-header">
            <img src="<?php echo ! empty( $notification->image ) ? $notification->image : ''; ?>" class="trust-plus-cookie-notification-image <?php echo ! empty( $notification->image ) ? '' : 'hidden'; ?>"/>

            <div>
                <p class="trust-plus-cookie-notification-description" style="color: <?php echo $notification->description_color ?>">
					<?php echo $notification->description ?>
                </p>

                <span class="trust-plus-cookie-notification-url">
                    <a href="<?php echo $notification->link_url ?>"><?php echo $notification->link_url_text ?></a></span>
            </div>
        </div>

        <button type="button" class="trust-plus-cookie-notification-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></button>

		<?php trust_plus_branding( $notification ); ?>
    </div>

	<?php trust_plus_close( $notification ); ?>

</div>
