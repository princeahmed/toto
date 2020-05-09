<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-emoji-feedback-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-emoji-feedback-content">
        <p class="toto-emoji-feedback-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="toto-emoji-feedback-emojis">
                <img src="<?php echo TOTO_ASSETS . '/images/emojis/angry.svg'; ?>"
                     class="toto-emoji-feedback-emoji toto-emoji-feedback-angry <?php echo $notification->show_angry ?  '' : 'hidden'; ?>"
                     data-type="angry" alt="<?php _e('Feedback Angry', 'toto') ?>"/>


                <img src="<?php echo TOTO_ASSETS . '/images/emojis/sad.svg'; ?>"
                     class="toto-emoji-feedback-emoji toto-emoji-feedback-sad <?php echo $notification->show_sad ? '' : 'hidden'; ?>"
                     data-type="sad" alt="<?php _e('Feedback Sad', 'toto') ?>"/>


                <img src="<?php echo TOTO_ASSETS . '/images/emojis/neutral.svg'; ?>"
                     class="toto-emoji-feedback-emoji toto-emoji-feedback-neutral <?php echo $notification->show_neutral ? '' : 'hidden'; ?>"
                     data-type="neutral" alt="<?php _e('Feedback Neutral', 'toto') ?>"/>


                <img src="<?php echo TOTO_ASSETS . '/images/emojis/happy.svg'; ?>"
                     class="toto-emoji-feedback-emoji toto-emoji-feedback-happy <?php echo $notification->show_happy ? '' : 'hidden'; ?>"
                     data-type="happy" alt="<?php _e('Feedback Happy', 'toto') ?>"/>


                <img src="<?php echo TOTO_ASSETS . '/images/emojis/excited.svg'; ?>"
                     class="toto-emoji-feedback-emoji toto-emoji-feedback-excited <?php echo $notification->show_excited ? '': 'hidden'; ?>"
                     data-type="excited" alt="<?php _e('Feedback Excited', 'toto') ?>"/>

        </div>

		<?php
		toto_branding( $notification );
		?>
    </div>

    <span class="toto-close"><?php echo $notification->display_close_button ? '&#10006;' : ''; ?></span>
</div>
