<?php defined( 'ABSPATH' ) || die(); ?>


<?php $date_ended = new \DateTime( $notification->end_date ) < new \DateTime(); ?>
<?php $date = ( new \DateTime( $notification->end_date ) )->diff( new \DateTime() ); ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-countdown-collector-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-countdown-collector-content">
        <p class="toto-countdown-collector-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
        <p class="toto-countdown-collector-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>

        <p class="toto-countdown-collector-content-title" style="color: <?php echo $notification->content_title_color ?>"><?php echo $notification->content_title ?></p>

        <div class="toto-countdown-collector-timer">
            <input type="hidden" name="end_date" value="<?php echo ( new \DateTime( $notification->end_date ) )->getTimestamp() ?>"/>

            <div class="toto-countdown-collector-timer-block">
                <div class="toto-countdown-collector-time" data-type="days"><?php echo $date_ended ? '0' : $date->format( '%a' ) ?></div>
                <p class="toto-countdown-collector-time-text"><?php _e( 'days', 'toto' ) ?></p>
            </div>

            <div class="toto-countdown-collector-timer-block">
                <div class="toto-countdown-collector-time" data-type="hours"><?php echo $date_ended ? '0' : $date->format( '%h' ) ?></div>
                <p class="toto-countdown-collector-time-text"><?php _e( 'hours', 'toto' ) ?></p>
            </div>

            <div class="toto-countdown-collector-timer-block">
                <div class="toto-countdown-collector-time" data-type="minutes"><?php echo $date_ended ? '0' : $date->format( '%i' ) ?></div>
                <p class="toto-countdown-collector-time-text"><?php _e( 'minutes', 'toto' ) ?></p>
            </div>

            <div class="toto-countdown-collector-timer-block">
                <div class="toto-countdown-collector-time" data-type="seconds"><?php echo $date_ended ? '0' : $date->format( '%s' ) ?></div>
                <p class="toto-countdown-collector-time-text"><?php _e( 'seconds', 'toto' ) ?></p>
            </div>
        </div>

        <div>
            <form class="toto-countdown-collector-form" id="toto-countdown-collector-form" name="" action="" method="GET" role="form">
                <div class="toto-countdown-collector-row">
                    <input type="text" class="toto-countdown-collector-input-placeholder" name="input" placeholder="<?php echo $notification->input_placeholder ?>"/>

                    <button type="submit" class="toto-countdown-collector-button" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
                </div>

				<?php toto_agreement( $notification ); ?>

            </form>

			<?php toto_branding( $notification ); ?>
        </div>
    </div>

	<?php toto_close( $notification ); ?>
</div>
