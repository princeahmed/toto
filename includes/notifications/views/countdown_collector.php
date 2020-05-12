<?php defined( 'ABSPATH' ) || die(); ?>


<?php $date_ended = new \DateTime( $notification->end_date ) < new \DateTime(); ?>
<?php $date = ( new \DateTime( $notification->end_date ) )->diff( new \DateTime() ); ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-countdown-collector-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-countdown-collector-content">
        <p class="trust-plus-countdown-collector-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
        <p class="trust-plus-countdown-collector-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

        <p class="trust-plus-countdown-collector-content-title" style="color: <?php echo $notification->content_title_color ?>"><?php echo $notification->content_title ?></p>

        <div class="trust-plus-countdown-collector-timer">
            <input type="hidden" name="end_date" value="<?php echo ( new \DateTime( $notification->end_date ) )->getTimestamp() ?>"/>

            <div class="trust-plus-countdown-collector-timer-block">
                <div class="trust-plus-countdown-collector-time" data-type="days"><?php echo $date_ended ? '0' : $date->format( '%a' ) ?></div>
                <p class="trust-plus-countdown-collector-time-text"><?php _e( 'days', 'social-proof-fomo-notification' ) ?></p>
            </div>

            <div class="trust-plus-countdown-collector-timer-block">
                <div class="trust-plus-countdown-collector-time" data-type="hours"><?php echo $date_ended ? '0' : $date->format( '%h' ) ?></div>
                <p class="trust-plus-countdown-collector-time-text"><?php _e( 'hours', 'social-proof-fomo-notification' ) ?></p>
            </div>

            <div class="trust-plus-countdown-collector-timer-block">
                <div class="trust-plus-countdown-collector-time" data-type="minutes"><?php echo $date_ended ? '0' : $date->format( '%i' ) ?></div>
                <p class="trust-plus-countdown-collector-time-text"><?php _e( 'minutes', 'social-proof-fomo-notification' ) ?></p>
            </div>

            <div class="trust-plus-countdown-collector-timer-block">
                <div class="trust-plus-countdown-collector-time" data-type="seconds"><?php echo $date_ended ? '0' : $date->format( '%s' ) ?></div>
                <p class="trust-plus-countdown-collector-time-text"><?php _e( 'seconds', 'social-proof-fomo-notification' ) ?></p>
            </div>
        </div>

        <div>
            <form class="trust-plus-countdown-collector-form" id="trust-plus-countdown-collector-form" name="" action="" method="GET" role="form">
                <div class="trust-plus-countdown-collector-row">
                    <input type="text" class="trust-plus-countdown-collector-input-placeholder" name="input" placeholder="<?php echo $notification->input_placeholder ?>"/>

                    <button type="submit" class="trust-plus-countdown-collector-button" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
                </div>

				<?php trust_plus_agreement( $notification ); ?>

            </form>

			<?php trust_plus_branding( $notification ); ?>
        </div>
    </div>

	<?php trust_plus_close( $notification ); ?>
</div>
