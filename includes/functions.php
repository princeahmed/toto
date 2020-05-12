<?php

defined( 'ABSPATH' ) || exit;

function trust_plus_locations() {

	return array(
		'is_front_page' => __( 'Front Page', 'social-proof-fomo-notification' ),
		'is_home'       => __( 'Blog Page', 'social-proof-fomo-notification' ),
		'is_singular'   => __( 'All Posts, Pages and Custom Post Types', 'social-proof-fomo-notification' ),
		'is_single'     => __( 'All Posts', 'social-proof-fomo-notification' ),
		'is_page'       => __( 'All Pages', 'social-proof-fomo-notification' ),
		'is_attachment' => __( 'All Attachments', 'social-proof-fomo-notification' ),
		'is_search'     => __( 'Search Results', 'social-proof-fomo-notification' ),
		'is_404'        => __( '404 Error Page', 'social-proof-fomo-notification' ),
		'is_archive'    => __( 'All Archives', 'social-proof-fomo-notification' ),
		'is_category'   => __( 'All Category Archives', 'social-proof-fomo-notification' ),
		'is_tag'        => __( 'All Tag Archives', 'social-proof-fomo-notification' ),
		'is_custom'     => __( 'Custom Post or Page IDs', 'social-proof-fomo-notification' ),
	);
}


function trust_plus_get_options( $key, $default = null ) {
	$settings = get_option( 'trust_plus_options' );

	return ! empty( $settings[ $key ] ) ? $settings[ $key ] : $default;
}

function trust_plus_get_timeago( $date ) {

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

function trust_plus_branding( $notification ) {
	if ( $notification->display_branding ) {
		if ( isset( $notification->branding ) && ! empty( $notification->branding->name ) && ! empty( $notification->branding->url ) ) {
			printf( '<a href="%s" class="trust-plus-site">%s</a>', $notification->branding->url, $notification->branding->name );
		} else {
			echo '<a href="#" class="trust-plus-site">🔥 by Toto</a>';
		}
	}
}

function trust_plus_agreement( $notification ) { ?>
    <div class="trust-plus-agreement-checkbox <?php echo $notification->show_agreement ? '' : 'hidden'; ?>">
        <input type="checkbox" name="agreement" <?php echo $notification->show_agreement ? 'required="required"' : ''; ?> />
        <label class="trust-plus-agreement-checkbox-text" style="color: <?php echo $notification->description_color ?>">
            <a href="<?php echo $notification->agreement_url ?>">
				<?php echo $notification->agreement_text ?>
            </a> </label>
    </div>
	<?php
}

function trust_plus_close( $notification ) {
	printf( '    <span class="trust-plus-close">%s</span>', $notification->display_close_button ? '&#10006;' : '' );
}

