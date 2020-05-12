<?php defined( 'ABSPATH' ) || die() ?>


<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-score-feedback-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-score-feedback-content">
        <p class="trust-plus-score-feedback-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="trust-plus-score-feedback-scores">
            <button type="button" class="trust-plus-score-feedback-button" data-score="1" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">1</button>
            <button type="button" class="trust-plus-score-feedback-button" data-score="2" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">2</button>
            <button type="button" class="trust-plus-score-feedback-button" data-score="3" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">3</button>
            <button type="button" class="trust-plus-score-feedback-button" data-score="4" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">4</button>
            <button type="button" class="trust-plus-score-feedback-button" data-score="5" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>">5</button>
        </div>

        <p class="trust-plus-score-feedback-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

		<?php
		trust_plus_branding( $notification );
		?>
    </div>

    <?php trust_plus_close($notification); ?>
</div>
