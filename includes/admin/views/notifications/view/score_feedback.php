<?php defined( 'ABSPATH' ) || die() ?>


<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-score-feedback-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-score-feedback-content">
        <p class="toto-score-feedback-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="toto-score-feedback-scores">
            <button type="button" class="toto-score-feedback-button" data-score="1" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">1</button>
            <button type="button" class="toto-score-feedback-button" data-score="2" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">2</button>
            <button type="button" class="toto-score-feedback-button" data-score="3" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">3</button>
            <button type="button" class="toto-score-feedback-button" data-score="4" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">4</button>
            <button type="button" class="toto-score-feedback-button" data-score="5" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">5</button>
        </div>

        <p class="toto-score-feedback-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

		<?php
		toto_branding( $notification );
		?>
    </div>

    <span class="toto-close"><?php echo $notification->display_close_button ? '&#10006;' : ''; ?></span>
</div>
