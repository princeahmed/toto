<?php defined('ABSPATH') || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-social-share-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-social-share-content">
        <p class="toto-social-share-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="toto-social-share-buttons">

            <?php if($notification->share_facebook): ?>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($notification->share_url) ?>&amp;src=sdkpreparse" target="_blank" class="toto-social-share-button toto-social-share-button-facebook">Facebook</a>
            <?php endif ?>

            <?php if($notification->share_twitter): ?>
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($notification->share_url) ?>" target="_blank" class="toto-social-share-button toto-social-share-button-twitter">Twitter</a>
            <?php endif ?>

            <?php if($notification->share_linkedin): ?>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($notification->share_url) ?>" target="_blank" class="toto-social-share-button toto-social-share-button-linkedin">Linkedin</a>
            <?php endif ?>

        </div>

        <p class="toto-social-share-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

        <?php toto_branding($notification); ?>
    </div>

    <span class="toto-close"></span>
</div>
