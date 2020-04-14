<?php defined('ABSPATH') || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-video-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-video-content">
        <p class="toto-video-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="toto-video-video-container">
            <iframe class="toto-video-video-iframe" src="<?php echo $notification->video ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <a href="<?php echo $notification->button_url ?>" class="toto-video-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></a>

        <?php toto_branding($notification); ?>
    </div>

    <span class="toto-close"></span>
</div>
