<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-emoji-feedback-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-emoji-feedback-content">
        <p class="toto-emoji-feedback-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="toto-emoji-feedback-emojis">
			<?php if ( $notification->show_angry ): ?>
                <img src="<?php echo TOTO_ASSETS . 'images/emojis/angry.svg'; ?>" class="toto-emoji-feedback-emoji toto-emoji-feedback-angry" data-type="angry"/>
			<?php endif ?>

			<?php if ( $notification->show_sad ): ?>
                <img src="<?php echo TOTO_ASSETS . 'images/emojis/sad.svg'; ?>" class="toto-emoji-feedback-emoji toto-emoji-feedback-sad" data-type="sad"/>
			<?php endif ?>

			<?php if ( $notification->show_neutral ): ?>
                <img src="<?php echo TOTO_ASSETS . 'images/emojis/neutral.svg'; ?>" class="toto-emoji-feedback-emoji toto-emoji-feedback-neutral" data-type="neutral"/>
			<?php endif ?>

			<?php if ( $notification->show_happy ): ?>
                <img src="<?php echo TOTO_ASSETS . 'images/emojis/happy.svg'; ?>" class="toto-emoji-feedback-emoji toto-emoji-feedback-happy" data-type="happy"/>
			<?php endif ?>

			<?php if ( $notification->show_excited ): ?>
                <img src="<?php echo TOTO_ASSETS . 'images/emojis/excited.svg'; ?>" class="toto-emoji-feedback-emoji toto-emoji-feedback-excited" data-type="excited"/>
			<?php endif ?>
        </div>

		<?php
		toto_branding( $notification );
		?>
    </div>

    <span class="toto-close"></span>
</div>
