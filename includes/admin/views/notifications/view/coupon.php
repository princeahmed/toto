<?php defined('ABSPATH') || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-coupon-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-coupon-content">
        <?php if(!empty($notification->image)): ?>
        <img src="<?php echo $notification->image ?>" class="toto-coupon-image" />
        <?php endif ?>

        <div>
            <p class="toto-coupon-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="toto-coupon-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

            <div class="toto-coupon-coupon-code"><?php echo $notification->coupon_code ?></div>

            <a href="<?php echo $notification->button_url ?>" class="toto-coupon-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></a>

            <div>
                <a href="#" class="toto-coupon-footer"><?php echo $notification->footer_text ?></a>
            </div>

            <?php if($notification->display_branding): ?>
                <?php if(isset($notification->branding, $notification->branding->name, $notification->branding->url) && !empty($notification->branding->name) && !empty($notification->branding->url)): ?>
                    <a href="<?php echo $notification->branding->url ?>" class="toto-site"><?php echo $notification->branding->name ?></a>
                <?php else: ?>
                    <a href="#" class="toto-site"></a>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>

    <span class="toto-close"></span>
</div>