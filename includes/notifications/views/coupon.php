<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-coupon-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-coupon-content">

        <img src="<?php echo $notification->image ?>" class="toto-coupon-image <?php echo ! empty( $notification->image ) ? '' : 'hidden'; ?>"/>

        <div>
            <p class="toto-coupon-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="toto-coupon-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

            <div class="toto-coupon-coupon-code"><?php echo $notification->coupon_code ?></div>

            <a href="<?php echo $notification->button_url ?>" class="toto-coupon-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></a>

            <div>
                <a href="#" class="toto-coupon-footer"><?php echo $notification->footer_text ?></a>
            </div>


			<?php toto_branding( $notification ); ?>
        </div>
    </div>

	<?php toto_close( $notification ); ?>
</div>