<?php

defined( 'ABSPATH' ) || exit;

class Trust_Plus_Notifications {

	/**
     * Get notification config
     *
	 * @param bool $type
	 * @param bool $post_id
	 *
	 * @return array|mixed
	 */
	public static function get_config( $type = false, $post_id = false ) {

		$settings = (object) get_post_meta( $post_id, '_settings', true );

		$default = [
			'url'                      => ! empty( $settings->url ) ? $settings->url : '',
			'trigger_on'               => ! empty( $settings->trigger_on ) ? $settings->trigger_on : 'all',
			'trigger_locations'        => ! empty( $settings->trigger_locations ) ? $settings->trigger_locations : [],
			'display_for'              => ! empty( $settings->display_for ) ? $settings->display_for : 'all',
			'triggers'                 => ! empty( $settings->triggers ) ? $settings->triggers : [],
			'display_trigger'          => ! empty( $settings->display_trigger ) ? $settings->display_trigger : 'delay',
			'display_trigger_value'    => ! empty( $settings->display_trigger_value ) ? $settings->display_trigger_value : 2,
			'display_once_per_session' => ! empty( $settings->display_once_per_session ) ? $settings->display_once_per_session : false,
			'display_mobile'           => isset( $settings->display_mobile ) ? $settings->display_mobile : true,
			'display_duration'         => ! empty( $settings->display_duration ) ? $settings->display_duration : 5,
			'display_position'         => ! empty( $settings->display_position ) ? $settings->display_position : 'bottom_left',
			'display_close_button'     => isset( $settings->display_close_button ) ? $settings->display_close_button : true,
			'display_branding'         => isset( $settings->display_branding ) ? $settings->display_branding : true,
			'title_color'              => ! empty( $settings->title_color ) ? $settings->title_color : '#000',
			'description_color'        => ! empty( $settings->description_color ) ? $settings->description_color : '#000',
			'background_color'         => ! empty( $settings->background_color ) ? $settings->background_color : '#fff',
			'border_radius'            => ! empty( $settings->border_radius ) ? $settings->border_radius : 'rounded',
			'custom_post_page_ids'     => ! empty( $settings->custom_post_page_ids ) ? $settings->custom_post_page_ids : '',

			'button_url'               => ! empty( $settings->button_url ) ? $settings->button_url : '',
			'display_minimum_activity' => ! empty( $settings->display_minimum_activity ) ? $settings->display_minimum_activity : 0,
			'pulse_background_color'   => ! empty( $settings->pulse_background_color ) ? $settings->pulse_background_color : '#17bf21',

			'enable_sound'       => isset( $settings->enable_sound ) ? $settings->enable_sound : false,
			'notification_sound' => ! empty( $settings->notification_sound ) ? $settings->notification_sound : '',
			'sound_volume'       => ! empty( $settings->sound_volume ) ? $settings->sound_volume : 50,

			'show_agreement' => isset( $settings->show_agreement ) ? $settings->show_agreement : false,
			'agreement_text' => ! empty( $settings->agreement_text ) ? $settings->agreement_text : "I read & agree the Privacy Policy",
			'agreement_url'  => ! empty( $settings->agreement_url ) ? $settings->agreement_url : '',

			'number_color'            => ! empty( $settings->number_color ) ? $settings->number_color : '#fff',
			'number_background_color' => ! empty( $settings->number_background_color ) ? $settings->number_background_color : '#000',

			'content_title_color'       => '#000',
			'content_description_color' => '#000',

			'button_background_color' => ! empty( $settings->button_background_color ) ? $settings->button_background_color : '#272727',
			'button_color'            => ! empty( $settings->button_color ) ? $settings->button_color : '#fff',
		];

		$all = [
			'INFORMATIONAL' => array_merge( [
				"name" => __('Informational', 'social-proof-fomo-notification'),
				"icon" => "fa fa-info-circle",

				'title'       => ! empty( $settings->title ) ? $settings->title : __( 'Flash Sale! 🔥', 'social-proof-fomo-notification' ),
				'description' => ! empty( $settings->description ) ? $settings->description : __( 'Limited sale until tonight, right now!', 'social-proof-fomo-notification' ),
				'image'       => ! empty( $settings->image ) ? $settings->image : 'https://img.icons8.com/nolan/2x/cutting-coupon.png',
			], $default ),

			'COUPON' => array_merge( [
				"name" => __('Coupon', 'social-proof-fomo-notification'),
				"icon" => "fa fa-piggy-bank",

				'title'       => ! empty( $settings->title ) ? $settings->title : __('35% OFF 🔥!', 'social-proof-fomo-notification'),
				'description' => ! empty( $settings->description ) ? $settings->description : __('Limited summer sale coupon code!', 'social-proof-fomo-notification'),
				'image'       => ! empty( $settings->image ) ? $settings->image : 'https://img.icons8.com/nolan/2x/cutting-coupon.png',
				'coupon_code' => ! empty( $settings->coupon_code ) ? $settings->coupon_code : __('COUPON20', 'social-proof-fomo-notification'),
				'button_text' => ! empty( $settings->button_text ) ? $settings->button_text : __('Get Coupon', 'social-proof-fomo-notification'),
				'footer_text' => ! empty( $settings->footer_text ) ? $settings->footer_text : __('No, I don\'t want to save money', 'social-proof-fomo-notification'),

				'button_background_color' => ! empty( $settings->button_background_color ) ? $settings->button_background_color : '#000',
				'button_color'            => ! empty( $settings->button_color ) ? $settings->button_color : '#fff',
			], $default ),

			'LIVE_COUNTER' => array_merge( [
				"name" => __('Live Counter', 'social-proof-fomo-notification'),
				"icon" => "fa fa-globe",

				'description'   => ! empty( $settings->description ) ? $settings->description : __('Active visitors now.', 'social-proof-fomo-notification'),
				'last_activity' => ! empty( $settings->last_activity ) ? $settings->last_activity : 15,
				"image"         => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/nolan/2x/cutting-coupon.png",
				"number"        => ! empty( $settings->number ) ? $settings->number : "15",
			], $default ),

			'EMAIL_COLLECTOR' => array_merge( [
				"name" => __('Email Collector', 'social-proof-fomo-notification'),
				"icon" => "fa fa-envelope-open",

				'title'             => ! empty( $settings->title ) ? $settings->title : __('Sign up 🔥', 'social-proof-fomo-notification'),
				'description'       => ! empty( $settings->description ) ? $settings->description : __('We do not send out spam emails & you can unsubscribe at any point.', 'social-proof-fomo-notification'),
				'email_placeholder' => ! empty( $settings->email_placeholder ) ? $settings->email_placeholder : __('Your valid email', 'social-proof-fomo-notification'),
				'button_text'       => ! empty( $settings->button_text ) ? $settings->button_text : __('Sign me up ✅', 'social-proof-fomo-notification'),
			], $default ),

			'LATEST_CONVERSION' => array_merge( [
				"name" => __('Latest Conversion', 'social-proof-fomo-notification'),
				"icon" => "fa fa-funnel-dollar",

				'title'             => ! empty( $settings->title ) ? $settings->title : __('A cool person', 'social-proof-fomo-notification'),
				'description'       => ! empty( $settings->description ) ? $settings->description : __('Signed up for the newsletter.', 'social-proof-fomo-notification'),
				'image'             => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/color/2x/webhook.png",
				'time_ago'          => ! empty( $settings->time_ago ) ? $settings->time_ago : __('10 mins ago', 'social-proof-fomo-notification'),
				'conversions_count' => ! empty( $settings->conversions_count ) ? $settings->conversions_count : 1,
			], $default ),

			'CONVERSIONS_COUNTER' => array_merge( [
				"name" => __('Conversions Counter', 'social-proof-fomo-notification'),
				"icon" => "fa fa-comment-dollar",

				'title'         => ! empty( $settings->title ) ? $settings->title : __('People bought the product', 'social-proof-fomo-notification'),
				'image'         => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/officel/2x/return-purchase.png",
				'number'        => ! empty( $settings->number ) ? $settings->number : "5",
				'time'          => ! empty( $settings->time ) ? $settings->time : __('In the last %s hours', 'social-proof-fomo-notification'),
				'last_activity' => ! empty( $settings->last_activity ) ? $settings->last_activity : 2,
			], $default ),

			'VIDEO' => array_merge( [
				"name" => __('Video', 'social-proof-fomo-notification'),
				"icon" => "fa fa-video",

				'title'       => ! empty( $settings->title ) ? $settings->title : __('Demo of the product 🔥', 'social-proof-fomo-notification'),
				'video'       => ! empty( $settings->video ) ? $settings->video : "https://www.youtube.com/?v=zWZa05uaiNA",
				'button_text' => ! empty( $settings->button_text ) ? $settings->button_text : __('Sign up 🙌', 'social-proof-fomo-notification'),
			], $default ),

			'SOCIAL_SHARE' => array_merge( [
				"name" => __('Social Share', 'social-proof-fomo-notification'),
				"icon" => "fa fa-share-alt",

				'title'          => ! empty( $settings->title ) ? $settings->title : __('Tell your friends 💻', 'social-proof-fomo-notification'),
				'description'    => ! empty( $settings->description ) ? $settings->description : __('We appreciate all the shares to support us! Thank you!', 'social-proof-fomo-notification'),
				'share_url'      => ! empty( $settings->share_url ) ? $settings->share_url : '',
				'share_facebook' => isset( $settings->share_facebook ) ? $settings->share_facebook : true,
				'share_twitter'  => isset( $settings->share_twitter ) ? $settings->share_twitter : true,
				'share_linkedin' => isset( $settings->share_linkedin ) ? $settings->share_linkedin : true,
			], $default ),

			'RANDOM_REVIEW' => array_merge( [
				"name" => __('Random Review', 'social-proof-fomo-notification'),
				"icon" => "fa fa-random",

				'title'       => ! empty( $settings->title ) ? $settings->title : __('John Doe', 'social-proof-fomo-notification'),
				'description' => ! empty( $settings->description ) ? $settings->description : __('SocialProof is a 5 star product! 🔥', 'social-proof-fomo-notification'),
				'image'       => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/color/2x/person-male.png",
				'stars'       => ! empty( $settings->stars ) ? $settings->stars : 5,
			], $default ),

			'EMOJI_FEEDBACK' => array_merge( [
				"name" => __('Emoji Feedback', 'social-proof-fomo-notification'),
				"icon" => "fa fa-smile-beam",

				'title'                  => ! empty( $settings->title ) ? $settings->title : __('Do you like our website?', 'social-proof-fomo-notification'),
				'show_angry'             => isset( $settings->show_angry ) ? $settings->show_angry : true,
				'show_sad'               => isset( $settings->show_sad ) ? $settings->show_sad : true,
				'show_neutral'           => isset( $settings->show_neutral ) ? $settings->show_neutral : true,
				'show_happy'             => isset( $settings->show_happy ) ? $settings->show_happy : true,
				'show_excited'           => isset( $settings->show_excited ) ? $settings->show_excited : true,
				"feedback_emoji_angry"   => ! empty( $settings->feedback_emoji_angry ) ? $settings->feedback_emoji_angry : __('Angry', 'social-proof-fomo-notification'),
				"feedback_emoji_sad"     => ! empty( $settings->feedback_emoji_sad ) ? $settings->feedback_emoji_sad : __('Sad', 'social-proof-fomo-notification'),
				"feedback_emoji_neutral" => ! empty( $settings->feedback_emoji_neutral ) ? $settings->feedback_emoji_neutral : __('Neutral', 'social-proof-fomo-notification'),
				"feedback_emoji_happy"   => ! empty( $settings->feedback_emoji_happy ) ? $settings->feedback_emoji_happy : __('Happy', 'social-proof-fomo-notification'),
				"feedback_emoji_excited" => ! empty( $settings->feedback_emoji_excited ) ? $settings->feedback_emoji_excited : __('Excited', 'social-proof-fomo-notification'),
			], $default ),

			'COOKIE_NOTIFICATION' => array_merge( [
				"name" => __('Cookie Notification', 'social-proof-fomo-notification'),
				"icon" => "fa fa-cookie",

				'description'   => ! empty( $settings->description ) ? $settings->description : __('This website uses cookies to ensure you get the best experience on our website.', 'social-proof-fomo-notification'),
				'button_text'   => ! empty( $settings->button_text ) ? $settings->button_text : __('Okay 🔥', 'social-proof-fomo-notification'),
				'link_url'      => ! empty( $settings->link_url ) ? $settings->link_url : "",
				'link_url_text' => ! empty( $settings->link_url_text ) ? $settings->link_url_text : __('Learn More', 'social-proof-fomo-notification'),
				'image'         => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/plasticine/2x/cookie.png",
			], $default ),

			'SCORE_FEEDBACK' => array_merge( [
				"name" => __('Score Feedback', 'social-proof-fomo-notification'),
				"icon" => "fa fa-sort-numeric-up",

				'title'            => ! empty( $settings->title ) ? $settings->title : __('How\'d you like our website?', 'social-proof-fomo-notification'),
				'description'      => ! empty( $settings->description ) ? $settings->description : __('Rate from 1 to 5. 5 being excellent.', 'social-proof-fomo-notification'),
				"feedback_score_1" => ! empty( $settings->feedback_score_1 ) ? $settings->feedback_score_1 : __('1', 'social-proof-fomo-notification'),
				"feedback_score_2" => ! empty( $settings->feedback_score_2 ) ? $settings->feedback_score_2 : __('2', 'social-proof-fomo-notification'),
				"feedback_score_3" => ! empty( $settings->feedback_score_3 ) ? $settings->feedback_score_3 : __('3', 'social-proof-fomo-notification'),
				"feedback_score_4" => ! empty( $settings->feedback_score_4 ) ? $settings->feedback_score_4 : __('4', 'social-proof-fomo-notification'),
				"feedback_score_5" => ! empty( $settings->feedback_score_5 ) ? $settings->feedback_score_5 : __('5', 'social-proof-fomo-notification'),
			], $default ),

			'REQUEST_COLLECTOR' => array_merge( [
				"name" => __('Request Collector', 'social-proof-fomo-notification'),
				"icon" => "fa fa-user-plus",

				'title'               => ! empty( $settings->title ) ? $settings->title : __('John', 'social-proof-fomo-notification'),
				'description'         => ! empty( $settings->description ) ? $settings->description : __('Support Team', 'social-proof-fomo-notification'),
				'image'               => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/cotton/2x/online-support.png",
				'content_title'       => ! empty( $settings->content_title ) ? $settings->content_title : __('Any questions?', 'social-proof-fomo-notification'),
				'content_description' => ! empty( $settings->content_description ) ? $settings->content_description : __('Let us know and we will get back to you!', 'social-proof-fomo-notification'),
				'input_placeholder'   => ! empty( $settings->input_placeholder ) ? $settings->input_placeholder : __('Valid Phone Number', 'social-proof-fomo-notification'),
				'button_text'         => ! empty( $settings->button_text ) ? $settings->button_text : __('Call me back ⚡️', 'social-proof-fomo-notification'),
			], $default ),

			'COUNTDOWN_COLLECTOR' => array_merge( [
				"name" => __('Countdown Collector', 'social-proof-fomo-notification'),
				"icon" => "fa fa-clock",

				'title'             => ! empty( $settings->title ) ? $settings->title : __('Building a website 💻', 'social-proof-fomo-notification'),
				'description'       => ! empty( $settings->description ) ? $settings->description : __('Free Webinar by us.', 'social-proof-fomo-notification'),
				'content_title'     => ! empty( $settings->content_title ) ? $settings->content_title : __('Hurry up! Registrations are closing soon.', 'social-proof-fomo-notification'),
				'input_placeholder' => ! empty( $settings->input_placeholder ) ? $settings->input_placeholder : __('Valid Email', 'social-proof-fomo-notification'),
				'button_text'       => ! empty( $settings->button_text ) ? $settings->button_text : __('Sign up ✅️', 'social-proof-fomo-notification'),
				'end_date'          => ! empty( $settings->end_date ) ? $settings->end_date : date( 'Y-m-d h:i A', strtotime( '+5 hours' ) ),
				"days"              => ! empty( $settings->days ) ? $settings->days : __('days', 'social-proof-fomo-notification'),
				"hours"             => ! empty( $settings->hours ) ? $settings->hours : __('hours', 'social-proof-fomo-notification'),
				"minutes"           => ! empty( $settings->minutes ) ? $settings->minutes : __('minutes', 'social-proof-fomo-notification'),
				"seconds"           => ! empty( $settings->seconds ) ? $settings->seconds : __('seconds', 'social-proof-fomo-notification'),
			], $default )

		];

		return $type ? $all[ $type ] : $all;
	}

	/**
     * Get notification frontend view
     *
	 * @param $post_id
	 * @param bool $shortcode
	 *
	 * @throws Exception
	 */
	public static function get_view( $post_id, $shortcode = false ) {

		$type         = get_post_meta( $post_id, '_notification_type', true );
		$notification = (object) self::get_config( $type, $post_id );

		$config = [
			'display_mobile'        => $notification->display_mobile,
			'display_trigger'       => $notification->display_trigger,
			'display_trigger_value' => $notification->display_trigger_value,
			'duration'              => $notification->display_duration == - 1 ? - 1 : $notification->display_duration * 1000,
			'url'                   => $notification->url,
			'close'                 => $notification->display_close_button,
			'once_per_session'      => $notification->display_once_per_session,
			'stop_on_focus'         => true,
			'notification_id'       => $post_id,
			'notification_type'     => $type,
			'enable_sound'          => $notification->enable_sound,
			'notification_sound'    => TRUST_PLUS_ASSETS . '/sounds/' . $notification->notification_sound . '.mp3',
			'sound_volume'          => $notification->sound_volume,
			'should_show'           => true,
		];

		if ( 'COUNTDOWN_COLLECTOR' == $type ) {
			$config['should_show'] = new \DateTime( $notification->end_date ) > new \DateTime();
		}

		$attr = [
			'data-notification-id' => $post_id,
		];

		$classes = [ 'social-proof-fomo-notification' ];

		if ( $shortcode ) {
			$classes[]              = 'shortcode';
			$config['shortcode']    = true;
			$config['position']     = null;
			$attr['data-shortcode'] = "trust_plus_$post_id";
		}

		if ( ! $shortcode ) {
			$classes[]             = "trust-plus-{$notification->display_position}";
			$attr['id']            = "trust_plus_$post_id";
			$attr['data-position'] = $notification->display_position;
		}

		$attr['data-config'] = json_encode( $config );

		ob_start();
		?>

        <div class="<?php echo implode( ' ', $classes ); ?>"
			<?php

			foreach ( $attr as $key => $value ) {
				printf( " %s='%s'", $key, $value );
			}

			?>
        >
			<?php include TRUST_PLUS_INCLUDES . '/notifications/views/' . strtolower( $type ) . '.php'; ?>
        </div>
		<?php
		echo ob_get_clean();

	}

	/**
     * Get notification preview
     *
	 * @param $type
	 * @param $post_id
	 */
	public static function preview( $type, $post_id ) {
		$notification = (object) self::get_config( $type, $post_id );

		ob_start();
		include TRUST_PLUS_INCLUDES . '/notifications/views/' . strtolower( $type ) . '.php';

		echo preg_replace( [ '/<form/', '/<\/form>/', '/required=\"required\"/' ], [
			'<div',
			'</div>',
			''
		], ob_get_clean() );
	}

	/**
	 * Check if the notification type supports data collection
	 *
	 * @param $type
	 *
	 * @return array
	 */
	public static function statistics_types( $type ) {

		$types = [ 'impression', 'hover' ];
		if ( in_array( $type, [
			'INFORMATIONAL',
			'COUPON',
			'LIVE_COUNTER',
			'VIDEO',
			'SOCIAL_SHARE',
			'COOKIE_NOTIFICATION'
		] ) ) {
			$types[] = 'click';
		} elseif ( in_array( $type, [ 'EMAIL_COLLECTOR', 'REQUEST_COLLECTOR','COUNTDOWN_COLLECTOR', ] ) ) {
			$types[] = 'submissions';
		}

		return $types;
	}

	/**
     * Get notification setting fields based on type
     *
	 * @param $type
	 * @param bool $field
	 * @param bool $post_id
	 *
	 * @return mixed
	 */
	public static function settings_fields( $type, $field = false, $post_id = false ) {
		$notification = self::get_config( $type, $post_id );

		$fields = require TRUST_PLUS_INCLUDES . '/notifications/fields.php';

		return $field ? $fields->$field : $fields;
	}

	/**
	 * @param $type
	 *
	 * @return mixed
	 */
	public static function setting_tabs( $type ) {

		$default_display = [
			'trigger',
			'display_for',
			'display_trigger',
			'display_duration',
			'display_position',
			'display_once_per_session',
			'display_mobile',
			'display_close_button',
			'display_branding',
		];

		$fields = [
			'INFORMATIONAL' => [
				'content'   => [ 'title', 'description', 'image', 'url', ],
				'customize' => [ 'title_color', 'description_color', 'background_color', 'border_radius', ],
			],

			'COUPON' => [
				'content'   => [
					'title',
					'description',
					'image',
					'coupon_code',
					'button_url',
					'button_text',
					'footer_text',
				],
				'customize' => [
					'title_color',
					'description_color',
					'background_color',
					'button_background_color',
					'button_color',
					'border_radius',
				],
			],

			'LIVE_COUNTER' => [
				'content'   => [ 'description', 'last_activity', 'url', ],
				'customize' => [
					'number_color',
					'number_background_color',
					'description_color',
					'background_color',
					'pulse_background_color',
					'border_radius',
				],
			],

			'EMAIL_COLLECTOR' => [
				'content'   => [
					'title',
					'description',
					'email_placeholder',
					'button_text',
					'agreement',
				],
				'customize' => [
					'title_color',
					'description_color',
					'background_color',
					'button_background_color',
					'button_color',
					'border_radius',
				],
			],

			'CONVERSIONS_COUNTER' => [
				'content' => [
					'title',
					'last_activity',
					'url'
				],

				'customize' => [
					'number_color',
					'number_background_color',
					'title_color',
					'background_color',
					'border_radius',
				],
			],

			'COOKIE_NOTIFICATION' => [
				'content' => [ 'description', 'image', 'link_url', 'link_url_text', 'button_text' ],

				'customize' => [
					'description_color',
					'background_color',
					'button_background_color',
					'button_color',
					'border_radius',
				],
			],

			'COUNTDOWN_COLLECTOR' => [
				'content' => [
					'title',
					'description',
					'content_title',
					'input_placeholder',
					'button_text',
					'end_date',
					'agreement',
				],

				'customize' => [
					'title_color',
					'description_color',
					'content_title_color',
					'time_color',
					'time_background_color',
					'background_color',
					'button_background_color',
					'button_color',
					'border_radius',
				],
			],

			'EMOJI_FEEDBACK' => [
				'content' => [ 'title', 'emoji' ],

				'customize' => [ 'title_color', 'background_color', 'border_radius', ],
			],

			'LATEST_CONVERSION' => [
				'content' => [ 'title', 'description', 'image', 'url', 'conversions_count', ],

				'customize' => [ 'title_color', 'description_color', 'background_color', 'border_radius', ],
			],

			'RANDOM_REVIEW' => [
				'content' => [ 'url' ],

				'customize' => [ 'title_color', 'description_color', 'background_color', 'border_radius', ],
			],

			'REQUEST_COLLECTOR' => [
				'content' => [
					'title',
					'description',
					'image',
					'content_title',
					'content_description',
					'input_placeholder',
					'button_text',
					'agreement',
				],

				'customize' => [
					'title_color',
					'description_color',
					'content_title_color',
					'content_description_color',
					'background_color',
					'button_background_color',
					'button_color',
					'border_radius',
				],
			],

			'SCORE_FEEDBACK' => [
				'content' => [ 'title', 'description', ],

				'customize' => [
					'title_color',
					'description_color',
					'background_color',
					'button_background_color',
					'button_color',
				],
			],

			'SOCIAL_SHARE' => [
				'content' => [ 'title', 'description', 'share_url', ],

				'customize' => [ 'title_color', 'description_color', 'background_color', 'border_radius', ],
			],

			'VIDEO' => [
				'content' => [ 'title', 'video', 'button_url', 'button_text', ],

				'customize' => [
					'title_color',
					'background_color',
					'button_background_color',
					'button_color',
					'border_radius',
				],
			],

		];

		$return            = $fields[ $type ];
		$return['display'] = $default_display;
		$return['sound']   = [ 'enable_sound' ];

		return $return;

	}

	/**
	 * Check if the notification can show by matching trigger location conditions
	 *
	 * @param $notification_id
	 *
	 * @return bool
	 */
	public static function can_show( $notification_id ) {

		$settings = get_post_meta( $notification_id, '_settings', true );

		//don't show on login/ reg pages
		if ( $GLOBALS['pagenow'] === 'wp-login.php' ) {
			return false;
		}

		//check display for
		if ( ! empty( $display_for = $settings['display_for'] ) ) {
			if ( 'logged_in' == $display_for && ! is_user_logged_in() ) {
				return false;
			}
			if ( 'logged_out' == $display_for && is_user_logged_in() ) {
				return false;
			}
		}

		//check trigger locations
		if ( empty( $settings['trigger_on'] ) ) {
			return true;
		}

		$trigger_on = $settings['trigger_on'];

		if ( $trigger_on == 'all' ) {
			return true;
		}

		if ( empty( $settings['trigger_locations'] ) ) {
			return true;
		}

		$locations = $settings['trigger_locations'];

		if ( in_array( 'is_custom', $locations ) ) {
			$ids = get_post_meta( $notification_id, '_settings', true )['custom_post_page_ids'];

			$ids = explode( ',', $ids );

			foreach ( $ids as $id ) {
				$id = trim( $id );

				if ( ! is_numeric( $id ) ) {
					continue;
				}

				if ( is_singular( $id ) ) {
					return true;
				}

			}

		}

		$fields = array(
			'is_front_page' => is_front_page(),
			'is_home'       => is_home(),
			'is_singular'   => is_singular(),
			'is_single'     => is_single(),
			'is_page'       => is_page(),
			'is_attachment' => is_attachment(),
			'is_search'     => is_search(),
			'is_404'        => is_404(),
			'is_archive'    => is_archive(),
			'is_category'   => is_category(),
		);

		foreach ( $locations as $location ) {
			if ( empty( $fields[ $location ] ) || ! $fields[ $location ] ) {
				continue;
			}

			return true;

		}

		return false;
	}

	/**
     * Display frontend Notification
     *
	 * @throws Exception
	 */
	public static function display_notifications() {
		$args = [
			'post_type'   => 'trust_plus',
			'post_status' => 'publish',
		];

		$posts = get_posts( $args );

		if ( ! empty( $posts ) ) {
			$post_ids = wp_list_pluck( $posts, 'ID' );

			foreach ( $post_ids as $post_id ) {
				if ( ! self::can_show( $post_id ) ) {
					continue;
				}

				Trust_Plus_Notifications::get_view( $post_id );

			}

		}

	}

}


