<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-video-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-video-content">
        <p class="trust-plus-video-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

        <div class="trust-plus-video-video-container">
			<?php
			$video = '';
			if ( ! empty( $notification->video ) ) {
				parse_str( parse_url( $notification->video, PHP_URL_QUERY ), $url_parts );
				$video = ! empty( $url_parts['v'] ) ? $url_parts['v'] : '';
			}
			?>
            <iframe class="trust-plus-video-video-iframe" src="https://youtube.com/embed/<?php echo $video ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <a href="<?php echo $notification->button_url ?>" class="trust-plus-video-button" style="background: <?php echo $notification->button_background_color ?>;color: <?php echo $notification->button_color ?>"><?php echo $notification->button_text ?></a>

		<?php trust_plus_branding( $notification ); ?>
    </div>

	<?php trust_plus_close( $notification ); ?>
</div>
