<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-social-share-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-social-share-content">
        <p class="toto-social-share-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="toto-social-share-buttons">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( $notification->share_url ) ?>&amp;src=sdkpreparse" target="_blank" class="toto-social-share-button toto-social-share-button-facebook <?php echo $notification->share_facebook ? '' : 'hidden'; ?>"><?php _e( 'Facebook', 'toto' ) ?></a>

            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( $notification->share_url ) ?>" target="_blank" class="toto-social-share-button toto-social-share-button-twitter <?php echo $notification->share_twitter ? '' : 'hidden'; ?>"><?php _e( 'Twitter', 'toto' ) ?></a>

            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( $notification->share_url ) ?>" target="_blank" class="toto-social-share-button toto-social-share-button-linkedin <?php echo $notification->share_linkedin ? '' : 'hidden'; ?>"><?php _e( 'Linkedin', 'toto' ) ?></a>

        </div>

        <p class="toto-social-share-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

		<?php toto_branding( $notification ); ?>
    </div>

	<?php toto_close( $notification ); ?>
</div>
