<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-emoji-feedback-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-emoji-feedback-content">
        <p class="trust-plus-emoji-feedback-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="trust-plus-emoji-feedback-emojis">
            <img src="<?php echo TRUST_PLUS_ASSETS . '/images/emojis/angry.svg'; ?>" class="trust-plus-emoji-feedback-emoji trust-plus-emoji-feedback-angry <?php echo $notification->show_angry ? '' : 'hidden'; ?>" data-type="angry" alt="<?php _e( 'Feedback Angry', 'social-proof-fomo-notification' ) ?>"/>


            <img src="<?php echo TRUST_PLUS_ASSETS . '/images/emojis/sad.svg'; ?>" class="trust-plus-emoji-feedback-emoji trust-plus-emoji-feedback-sad <?php echo $notification->show_sad ? '' : 'hidden'; ?>" data-type="sad" alt="<?php _e( 'Feedback Sad', 'social-proof-fomo-notification' ) ?>"/>


            <img src="<?php echo TRUST_PLUS_ASSETS . '/images/emojis/neutral.svg'; ?>" class="trust-plus-emoji-feedback-emoji trust-plus-emoji-feedback-neutral <?php echo $notification->show_neutral ? '' : 'hidden'; ?>" data-type="neutral" alt="<?php _e( 'Feedback Neutral', 'social-proof-fomo-notification' ) ?>"/>


            <img src="<?php echo TRUST_PLUS_ASSETS . '/images/emojis/happy.svg'; ?>" class="trust-plus-emoji-feedback-emoji trust-plus-emoji-feedback-happy <?php echo $notification->show_happy ? '' : 'hidden'; ?>" data-type="happy" alt="<?php _e( 'Feedback Happy', 'social-proof-fomo-notification' ) ?>"/>


            <img src="<?php echo TRUST_PLUS_ASSETS . '/images/emojis/excited.svg'; ?>" class="trust-plus-emoji-feedback-emoji trust-plus-emoji-feedback-excited <?php echo $notification->show_excited ? '' : 'hidden'; ?>" data-type="excited" alt="<?php _e( 'Feedback Excited', 'social-proof-fomo-notification' ) ?>"/>

        </div>

		<?php
		trust_plus_branding( $notification );
		?>
    </div>

	<?php trust_plus_close( $notification ); ?>
</div>
