<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-coupon-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-coupon-content">

        <img src="<?php echo $notification->image ?>" class="trust-plus-coupon-image <?php echo ! empty( $notification->image ) ? '' : 'hidden'; ?>"/>

        <div>
            <p class="trust-plus-coupon-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="trust-plus-coupon-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

            <div class="trust-plus-coupon-coupon-code"><?php echo $notification->coupon_code ?></div>

            <a href="<?php echo $notification->button_url ?>" class="trust-plus-coupon-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></a>

            <div>
                <a href="#" class="trust-plus-coupon-footer"><?php echo $notification->footer_text ?></a>
            </div>


			<?php trust_plus_branding( $notification ); ?>
        </div>
    </div>

	<?php trust_plus_close( $notification ); ?>
</div>