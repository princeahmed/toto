<?php defined('ABSPATH') || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-cookie-notification-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-cookie-notification-content">

        <div class="toto-cookie-notification-header">
            <?php if(!empty($notification->image)): ?>
                <img src="<?php echo $notification->image ?>" class="toto-cookie-notification-image" />
            <?php endif ?>

            <p class="toto-cookie-notification-description" style="color: <?php echo $notification->description_color ?>">
                <?php echo $notification->description ?>

                <span class="toto-cookie-notification-url"><a href="<?php echo $notification->link_url ?>"><?php echo $notification->link_url_text ?></a></span>
            </p>
        </div>

        <button type="button" class="toto-cookie-notification-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></button>

        <?php toto_branding($notification); ?>
    </div>

    <span class="toto-close"></span>
</div>
