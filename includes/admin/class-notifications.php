<?php

defined( 'ABSPATH' ) || exit;

class Toto_Notifications {

	public static function notification_types() {
		return [
			'INFORMATIONAL' => [
				"name" => "Informational",
				"icon" => "fa fa-info-circle",

				'title'       => __( 'Flash Sale! 🔥', 'toto' ),
				'description' => __( 'Limited sale until tonight, right now!', 'toto' ),
				'image'       => 'https://img.icons8.com/nolan/2x/cutting-coupon.png',
				'url'         => '',

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => true,
				'display_branding'     => true,

				'title_color'       => '#000',
				'description_color' => '#000',
				'background_color'  => '#fff',
				'border_radius'     => 'rounded',
			],

			'COUPON' => [
				"name" => "Coupon",
				"icon" => "fa fa-piggy-bank",

				'title'       => '35% OFF 🔥!',
				'description' => 'Limited summer sale coupon code!',
				'image'       => 'https://img.icons8.com/nolan/2x/cutting-coupon.png',
				'coupon_code' => 'COUPON20',
				'button_url'  => '',
				'button_text' => 'Get Coupon',
				'footer_text' => 'No, I don\'t want to save money',

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => true,
				'display_branding'     => true,

				'title_color'             => '#000',
				'description_color'       => '#000',
				'background_color'        => '#fff',
				'button_background_color' => '#000',
				'button_color'            => '#fff',
				'pulse_background_color'  => '#17bf21',
				'border_radius'           => 'rounded',
			],

			'LIVE_COUNTER' => [
				"name" => "Live Counter",
				"icon" => "fa fa-globe",

				'description'   => 'Active visitors now.',
				'last_activity' => 15,
				'url'           => '',
				"image"         => "https://img.icons8.com/nolan/2x/cutting-coupon.png",
				"number"        => "15",

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_duration'         => 5,
				'display_position'         => 'bottom_left',
				'display_minimum_activity' => 0,
				'display_once_per_session' => false,
				'display_close_button'     => true,
				'display_branding'         => true,
				'display_mobile'           => true,

				'number_color'            => '#fff',
				'number_background_color' => '#000',
				'description_color'       => '#000',
				'background_color'        => '#fff',
				'border_radius'           => 'rounded',
			],

			'EMAIL_COLLECTOR' => [
				"name" => "Email Collector",
				"icon" => "fa fa-envelope-open",

				'title'             => "Sign up 🔥",
				'description'       => "We do not send out spam emails & you can unsubscribe at any point.",
				'email_placeholder' => "Your valid email",
				'button_text'       => "Sign me up ✅",
				'show_agreement'    => false,
				'agreement_text'    => "I read & agree the Privacy Policy",
				'agreement_url'     => '',

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => true,
				'display_branding'     => true,

				'title_color'             => '#000',
				'description_color'       => '#000',
				'background_color'        => '#fff',
				'button_background_color' => '#272727',
				'button_color'            => '#fff',
				'border_radius'           => 'rounded',

				'data_send_is_enabled' => 0,
				'data_send_webhook'    => '',
				'data_send_email'      => '',
			],

			'LATEST_CONVERSION' => [
				"name" => "Latest Conversion",
				"icon" => "fa fa-funnel-dollar",

				'title'             => "A cool person",
				'description'       => "Signed up for the newsletter.",
				'image'             => "https://img.icons8.com/color/2x/webhook.png",
				'time_ago'          => "10 mins ago",
				'url'               => '',
				'conversions_count' => 1,

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_minimum_activity' => 0,
				'display_duration'         => 5,
				'display_position'         => 'bottom_left',
				'display_close_button'     => true,
				'display_branding'         => true,

				'title_color'       => '#000',
				'description_color' => '#000',
				'background_color'  => '#fff',
				'border_radius'     => 'rounded',

				'data_trigger_auto'  => false,
				'data_triggers_auto' => []
			],

			'CONVERSIONS_COUNTER' => [
				"name" => "Conversions Counter",
				"icon" => "fa fa-comment-dollar",

				'title'         => "People bought the product",
				'image'         => "https://img.icons8.com/officel/2x/return-purchase.png",
				'number'        => "5",
				'time'          => "In the last %s hours",
				'last_activity' => 2,
				'url'           => '',

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_duration'         => 5,
				'display_position'         => 'bottom_left',
				'display_minimum_activity' => 0,
				'display_once_per_session' => false,
				'display_close_button'     => false,
				'display_branding'         => true,
				'display_mobile'           => true,

				'number_color'            => '#fff',
				'number_background_color' => '#000',
				'title_color'             => '#000',
				'background_color'        => '#fff',
				'border_radius'           => 'rounded',

				'data_trigger_auto'  => false,
				'data_triggers_auto' => []
			],

			'VIDEO' => [
				"name" => "Video",
				"icon" => "fa fa-video",

				'title'       => "Demo of the product 🔥",
				'video'       => "https://www.youtube.com/embed/zWZa05uaiNA",
				'button_url'  => '',
				'button_text' => "Sign up 🙌",

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => true,
				'display_branding'     => true,

				'title_color'             => '#000',
				'background_color'        => '#fff',
				'button_background_color' => '#000',
				'button_color'            => '#fff',
				'border_radius'           => 'rounded',
			],

			'SOCIAL_SHARE' => [
				"name" => "Social Share",
				"icon" => "fa fa-share-alt",

				'title'          => "Tell your friends 💻",
				'description'    => "We appreciate all the shares to support us! Thank you!",
				'share_url'      => '',
				'share_facebook' => true,
				'share_twitter'  => true,
				'share_linkedin' => true,

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => true,
				'display_branding'     => true,

				'title_color'       => '#000',
				'description_color' => '#000',
				'background_color'  => '#fff',
				'border_radius'     => 'rounded',
			],

			'RANDOM_REVIEW' => [
				"name" => "Random Review",
				"icon" => "fa fa-random",

				'title'       => "John Doe",
				'description' => "SocialProof is a 5 star product! 🔥",
				'image'       => "https://img.icons8.com/color/2x/person-male.png",
				'url'         => '',
				'stars'       => 5,

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => false,
				'display_branding'     => true,

				'title_color'       => '#000',
				'description_color' => '#000',
				'background_color'  => '#fff',
				'border_radius'     => 'rounded',
			],

			'EMOJI_FEEDBACK' => [
				"name" => "Emoji Feedback",
				"icon" => "fa fa-smile-beam",

				'title'        => "Do you like our website?",
				'show_angry'   => true,
				'show_sad'     => true,
				'show_neutral' => true,
				'show_happy'   => true,
				'show_excited' => true,

				"feedback_emoji_angry"   => "Angry",
				"feedback_emoji_sad"     => "Sad",
				"feedback_emoji_neutral" => "Neutral",
				"feedback_emoji_happy"   => "Happy",
				"feedback_emoji_excited" => "Excited",

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => false,
				'display_branding'     => true,

				'title_color'      => '#000',
				'background_color' => '#fff',
				'border_radius'    => 'rounded',
			],

			'COOKIE_NOTIFICATION' => [
				"name" => "Cookie Notification",
				"icon" => "fa fa-cookie",

				'description' => "This website uses cookies to ensure you get the best experience on our website.",
				'button_text' => "Okay 🔥",
				'url_text'    => "Learn More",
				'image'       => "https://img.icons8.com/plasticine/2x/cookie.png",
				'url'         => '',

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => true,
				'display_branding'     => true,

				'description_color'       => '#000',
				'background_color'        => '#fff',
				'button_background_color' => '#000',
				'button_color'            => '#fff',
				'border_radius'           => 'rounded',
			],

			'SCORE_FEEDBACK' => [
				"name" => "Score Feedback",
				"icon" => "fa fa-sort-numeric-up",

				'title'            => "How'd you like our website?",
				'description'      => "Rate from 1 to 5. 5 being excellent.",
				"feedback_score_1" => "1",
				"feedback_score_2" => "2",
				"feedback_score_3" => "3",
				"feedback_score_4" => "4",
				"feedback_score_5" => "5",

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => false,
				'display_branding'     => true,

				'title_color'             => '#000',
				'description_color'       => '#000',
				'background_color'        => '#fff',
				'button_background_color' => '#000',
				'button_color'            => '#fff',
				'border_radius'           => 'rounded',
			],

			'REQUEST_COLLECTOR' => [
				"name" => "Request Collector",
				"icon" => "fa fa-user-plus",

				'title'               => "John",
				'description'         => "Support Team",
				'image'               => "https://img.icons8.com/cotton/2x/online-support.png",
				'content_title'       => "Any questions?",
				'content_description' => "Let us know and we will get back to you!",
				'input_placeholder'   => "Valid Phone Number",
				'button_text'         => "Call me back ⚡️",
				'show_agreement'      => false,
				'agreement_text'      => "I read & agree the Privacy Policy",
				'agreement_url'       => '',

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => false,
				'display_branding'     => true,

				'title_color'               => '#000',
				'description_color'         => '#000',
				'content_title_color'       => '#000',
				'content_description_color' => '#000',
				'background_color'          => '#fff',
				'button_background_color'   => '#000',
				'button_color'              => '#fff',
				'border_radius'             => 'rounded',

				'data_send_is_enabled' => 0,
				'data_send_webhook'    => '',
				'data_send_email'      => '',
			],

			'COUNTDOWN_COLLECTOR' => [
				"name" => "Countdown Collector",
				"icon" => "fa fa-clock",

				'title'             => "Building a website 💻",
				'description'       => "Free Webinar by us.",
				'content_title'     => "Hurry up! Registrations are closing soon.",
				'input_placeholder' => "Valid Email",
				'button_text'       => "Sign up ✅️",
				'end_date'          => ( new \DateTime() )->modify( '+5 hours' )->format( 'Y-m-d H:i:s' ),
				'show_agreement'    => false,
				'agreement_text'    => "I read & agree the Privacy Policy",
				'agreement_url'     => '',

				"days"    => "days",
				"hours"   => "hours",
				"minutes" => "minutes",
				"seconds" => "seconds",

				'trigger_all_pages'        => true,
				'triggers'                 => [],
				'display_trigger'          => 'delay',
				'display_trigger_value'    => 2,
				'display_once_per_session' => false,
				'display_mobile'           => true,

				'display_duration'     => 5,
				'display_position'     => 'bottom_left',
				'display_close_button' => false,
				'display_branding'     => true,

				'title_color'             => '#000',
				'description_color'       => '#000',
				'content_title_color'     => '#000',
				'time_color'              => 'fff',
				'time_background_color'   => '#000',
				'background_color'        => '#fff',
				'button_background_color' => '#000',
				'button_color'            => '#fff',
				'border_radius'           => 'rounded',

				'data_send_is_enabled' => 0,
				'data_send_webhook'    => '',
				'data_send_email'      => '',
			],
		];
	}

	public static function get( $type ) {
		return require TOTO_INCLUDES . '/admin/views/notifications/' . strtolower( $type ) . '.php';
	}

	public static function get_enabled_methods( $type ) {

		$methods = [];

		if ( in_array( $type, [
			'INFORMATIONAL',
			'COUPON',
			'LIVE_COUNTER',
			'VIDEO',
			'SOCIAL_SHARE',
			'EMOJI_FEEDBACK',
			'COOKIE_NOTIFICATION',
			'SCORE_FEEDBACK'
		] ) ) {
			$methods = [ 'statistics', 'settings' ];
		}

		if ( in_array( $type, [
			'EMAIL_COLLECTOR',
			'LATEST_CONVERSION',
			'CONVERSIONS_COUNTER',
			'RANDOM_REVIEW',
			'REQUEST_COLLECTOR',
			'COUNTDOWN_COLLECTOR'
		] ) ) {
			$methods = [ 'statistics', 'settings', 'data' ];
		}

		return $methods;
	}


	public static function get_enabled_settings_tabs( $type ) {

		$settings_tabs = [];

		if ( in_array( $type, [
			'INFORMATIONAL',
			'COUPON',
			'LIVE_COUNTER',
			'VIDEO',
			'SOCIAL_SHARE',
			'EMOJI_FEEDBACK',
			'COOKIE_NOTIFICATION',
			'SCORE_FEEDBACK'
		] ) ) {
			$settings_tabs = [ 'basic', 'display', 'customize', 'triggers' ];
		}

		if ( in_array( $type, [
			'EMAIL_COLLECTOR',
			'LATEST_CONVERSION',
			'CONVERSIONS_COUNTER',
			'RANDOM_REVIEW',
			'REQUEST_COLLECTOR',
			'COUNTDOWN_COLLECTOR'
		] ) ) {
			$settings_tabs = [ 'basic', 'display', 'customize', 'triggers', 'data' ];
		}

		return $settings_tabs;
	}

}


