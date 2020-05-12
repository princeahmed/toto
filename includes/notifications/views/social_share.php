<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-social-share-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-social-share-content">
        <p class="trust-plus-social-share-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="trust-plus-social-share-buttons">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( $notification->share_url ) ?>&amp;src=sdkpreparse" target="_blank" class="trust-plus-social-share-button trust-plus-social-share-button-facebook <?php echo $notification->share_facebook ? '' : 'hidden'; ?>"><?php _e( 'Facebook', 'social-proof-fomo-notification' ) ?></a>

            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( $notification->share_url ) ?>" target="_blank" class="trust-plus-social-share-button trust-plus-social-share-button-twitter <?php echo $notification->share_twitter ? '' : 'hidden'; ?>"><?php _e( 'Twitter', 'social-proof-fomo-notification' ) ?></a>

            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( $notification->share_url ) ?>" target="_blank" class="trust-plus-social-share-button trust-plus-social-share-button-linkedin <?php echo $notification->share_linkedin ? '' : 'hidden'; ?>"><?php _e( 'Linkedin', 'social-proof-fomo-notification' ) ?></a>

        </div>

        <p class="trust-plus-social-share-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

		<?php trust_plus_branding( $notification ); ?>
    </div>

	<?php trust_plus_close( $notification ); ?>
</div>
