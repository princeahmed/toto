<?php

defined( 'ABSPATH' ) || exit;

function toto_locations() {

	return array(
		'is_front_page' => __( 'Front Page', 'toto' ),
		'is_home'       => __( 'Blog Page', 'toto' ),
		'is_singular'   => __( 'All Posts, Pages and Custom Post Types', 'toto' ),
		'is_single'     => __( 'All Posts', 'toto' ),
		'is_page'       => __( 'All Pages', 'toto' ),
		'is_attachment' => __( 'All Attachments', 'toto' ),
		'is_search'     => __( 'Search Results', 'toto' ),
		'is_404'        => __( '404 Error Page', 'toto' ),
		'is_archive'    => __( 'All Archives', 'toto' ),
		'is_category'   => __( 'All Category Archives', 'toto' ),
		'is_tag'        => __( 'All Tag Archives', 'toto' ),
		'is_custom'     => __( 'Custom Post or Page IDs', 'toto' ),
	);
}

function toto_get_user_ip() {
	if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		return $_SERVER['HTTP_CLIENT_IP'];
	} else if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {
		return $_SERVER['HTTP_X_FORWARDED'];
	} else if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
		return $_SERVER['HTTP_FORWARDED_FOR'];
	} else if ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {
		return $_SERVER['HTTP_FORWARDED'];
	} else if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
		return $_SERVER['REMOTE_ADDR'];
	} else {
		return 'UNKNOWN';
	}
}

function toto_get_options( $key, $default = null ) {
	$settings = get_option( 'toto_options' );

	return ! empty( $settings[ $key ] ) ? $settings[ $key ] : $default;
}

function toto_get_timeago( $date ) {

	$estimate_time = time() - ( new \DateTime( $date ) )->getTimestamp();

	if ( $estimate_time < 1 ) {
		return 'now';
	}

	$condition = [
		12 * 30 * 24 * 60 * 60 => 'year',
		30 * 24 * 60 * 60      => 'month',
		24 * 60 * 60           => 'day',
		60 * 60                => 'hour',
		60                     => 'minute',
		1                      => 'second'
	];

	foreach ( $condition as $secs => $str ) {
		$d = $estimate_time / $secs;

		if ( $d >= 1 ) {
			$r = round( $d );

			/* Determine the language string needed */
			$language_string_time = $r > 1 ? $str . 's' : $str;

			return $r . ' ' . $language_string_time . ' ago';
		}
	}
}

function toto_branding( $notification ) {
	if ( $notification->display_branding ) {
		if ( isset( $notification->branding ) && ! empty( $notification->branding->name ) && ! empty( $notification->branding->url ) ) {
			printf( '<a href="%s" class="toto-site">%s</a>', $notification->branding->url, $notification->branding->name );
		} else {
			echo '<a href="#" class="toto-site">🔥 by Toto</a>';
		}
	}
}

function toto_agreement( $notification ) {?>
    <div class="toto-agreement-checkbox <?php echo $notification->show_agreement ? '' : 'hidden'; ?>">
        <input type="checkbox" id="toto-agreement" name="agreement" <?php echo $notification->show_agreement ? 'required="required"' : ''; ?> />
        <label for="toto-agreement" class="toto-agreement-checkbox-text" style="color: <?php echo $notification->description_color ?>">
            <a href="<?php echo $notification->agreement_url ?>">
				<?php echo $notification->agreement_text ?>
            </a> </label>
    </div>
<?php
}

function toto_close($notification) {
	printf( '    <span class="toto-close">%s</span>', $notification->display_close_button ? '&#10006;' : '' );
}

