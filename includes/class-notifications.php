<?php

defined( 'ABSPATH' ) || exit;

class Toto_Notifications {

	public static function get_config( $type = false, $post_id = false ) {

		$settings = (object) get_post_meta( $post_id, '_settings', true );

		$all = [
			'INFORMATIONAL' => [
				"name" => "Informational",
				"icon" => "fa fa-info-circle",

				'title'                    => ! empty( $settings->title ) ? $settings->title : __( 'Flash Sale! 🔥', 'toto' ),
				'description'              => ! empty( $settings->description ) ? $settings->description : __( 'Limited sale until tonight, right now!', 'toto' ),
				'image'                    => ! empty( $settings->image ) ? $settings->image : 'https://img.icons8.com/nolan/2x/cutting-coupon.png',
				'url'                      => ! empty( $settings->url ) ? $settings->url : '',
				'trigger_on'               => ! empty( $settings->trigger_on ) ? $settings->trigger_on : 'all',
				'trigger_locations'        => ! empty( $settings->trigger_locations ) ? $settings->trigger_locations : [],
				'trigger_all_pages'        => isset( $settings->trigger_all_pages ) ? $settings->trigger_all_pages : true,
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

				'notification_id' => $post_id,
			],

			'COUPON' => [
				"name" => "Coupon",
				"icon" => "fa fa-piggy-bank",

				'title'                    => ! empty( $settings->title ) ? $settings->title : '35% OFF 🔥!',
				'description'              => ! empty( $settings->description ) ? $settings->description : 'Limited summer sale coupon code!',
				'image'                    => ! empty( $settings->image ) ? $settings->image : 'https://img.icons8.com/nolan/2x/cutting-coupon.png',
				'coupon_code'              => ! empty( $settings->coupon_code ) ? $settings->coupon_code : 'COUPON20',
				'button_url'               => ! empty( $settings->button_url ) ? $settings->button_url : '',
				'button_text'              => ! empty( $settings->button_text ) ? $settings->button_text : 'Get Coupon',
				'footer_text'              => ! empty( $settings->footer_text ) ? $settings->footer_text : 'No, I don\'t want to save money',
				'trigger_all_pages'        => isset( $settings->trigger_all_pages ) ? $settings->trigger_all_pages : true,
				'triggers'                 => ! empty( $settings->triggers ) ? $settings->triggers : [],
				'display_trigger'          => ! empty( $settings->display_trigger ) ? $settings->display_trigger : 'delay',
				'display_trigger_value'    => ! empty( $settings->display_trigger_value ) ? $settings->display_trigger_value : 2,
				'display_once_per_session' => isset( $settings->display_once_per_session ) ? $settings->display_once_per_session : false,
				'display_mobile'           => isset( $settings->display_mobile ) ? $settings->display_mobile : true,
				'display_duration'         => ! empty( $settings->display_duration ) ? $settings->display_duration : 5,
				'display_position'         => ! empty( $settings->display_position ) ? $settings->display_position : 'bottom_left',
				'display_close_button'     => isset( $settings->display_close_button ) ? $settings->display_close_button : true,
				'display_branding'         => isset( $settings->display_branding ) ? $settings->display_branding : true,
				'title_color'              => ! empty( $settings->title_color ) ? $settings->title_color : '#000',
				'description_color'        => ! empty( $settings->description_color ) ? $settings->description_color : '#000',
				'background_color'         => ! empty( $settings->background_color ) ? $settings->background_color : '#fff',
				'button_background_color'  => ! empty( $settings->button_background_color ) ? $settings->button_background_color : '#000',
				'button_color'             => ! empty( $settings->button_color ) ? $settings->button_color : '#fff',
				'pulse_background_color'   => ! empty( $settings->pulse_background_color ) ? $settings->pulse_background_color : '#17bf21',
				'border_radius'            => ! empty( $settings->border_radius ) ? $settings->border_radius : 'rounded',

				'notification_id' => $post_id,
			],

			'LIVE_COUNTER' => [
				"name" => "Live Counter",
				"icon" => "fa fa-globe",

				'description'              => ! empty( $settings->description ) ? $settings->description : 'Active visitors now.',
				'last_activity'            => ! empty( $settings->last_activity ) ? $settings->last_activity : 15,
				'url'                      => ! empty( $settings->url ) ? $settings->url : '',
				"image"                    => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/nolan/2x/cutting-coupon.png",
				"number"                   => ! empty( $settings->number ) ? $settings->number : "15",
				'trigger_all_pages'        => isset( $settings->trigger_all_pages ) ? $settings->trigger_all_pages : true,
				'triggers'                 => ! empty( $settings->triggers ) ? $settings->triggers : [],
				'display_trigger'          => ! empty( $settings->display_trigger ) ? $settings->display_trigger : 'delay',
				'display_trigger_value'    => ! empty( $settings->display_trigger_value ) ? $settings->display_trigger_value : 2,
				'display_duration'         => ! empty( $settings->display_duration ) ? $settings->display_duration : 5,
				'display_position'         => ! empty( $settings->display_position ) ? $settings->display_position : 'bottom_left',
				'display_minimum_activity' => ! empty( $settings->display_minimum_activity ) ? $settings->display_minimum_activity : 0,
				'display_once_per_session' => isset( $settings->display_once_per_session ) ? $settings->display_once_per_session : false,
				'display_close_button'     => isset( $settings->display_close_button ) ? $settings->display_close_button : true,
				'display_branding'         => isset( $settings->display_branding ) ? $settings->display_branding : true,
				'display_mobile'           => isset( $settings->display_mobile ) ? $settings->display_mobile : true,
				'number_color'             => ! empty( $settings->number_color ) ? $settings->number_color : '#fff',
				'number_background_color'  => ! empty( $settings->number_background_color ) ? $settings->number_background_color : '#000',
				'description_color'        => ! empty( $settings->description_color ) ? $settings->description_color : '#000',
				'background_color'         => ! empty( $settings->background_color ) ? $settings->background_color : '#fff',
				'border_radius'            => ! empty( $settings->border_radius ) ? $settings->border_radius : 'rounded',
				'pulse_background_color'   => ! empty( $settings->pulse_background_color ) ? $settings->pulse_background_color : '#17bf21',

				'notification_id' => $post_id,
			],

			'EMAIL_COLLECTOR' => [
				"name" => "Email Collector",
				"icon" => "fa fa-envelope-open",

				'title'                    => ! empty( $settings->title ) ? $settings->title : "Sign up 🔥",
				'description'              => ! empty( $settings->description ) ? $settings->description : "We do not send out spam emails & you can unsubscribe at any point.",
				'email_placeholder'        => ! empty( $settings->email_placeholder ) ? $settings->email_placeholder : "Your valid email",
				'button_text'              => ! empty( $settings->button_text ) ? $settings->button_text : "Sign me up ✅",
				'show_agreement'           => isset( $settings->show_agreement ) ? $settings->show_agreement : false,
				'agreement_text'           => ! empty( $settings->agreement_text ) ? $settings->agreement_text : "I read & agree the Privacy Policy",
				'agreement_url'            => ! empty( $settings->agreement_url ) ? $settings->agreement_url : '',
				'trigger_all_pages'        => isset( $settings->trigger_all_pages ) ? $settings->trigger_all_pages : true,
				'triggers'                 => ! empty( $settings->triggers ) ? $settings->triggers : [],
				'display_trigger'          => ! empty( $settings->display_trigger ) ? $settings->display_trigger : 'delay',
				'display_trigger_value'    => ! empty( $settings->display_trigger_value ) ? $settings->display_trigger_value : 2,
				'display_once_per_session' => isset( $settings->display_once_per_session ) ? $settings->display_once_per_session : false,
				'display_mobile'           => isset( $settings->display_mobile ) ? $settings->display_mobile : true,
				'display_duration'         => ! empty( $settings->display_duration ) ? $settings->display_duration : 5,
				'display_position'         => ! empty( $settings->display_position ) ? $settings->display_position : 'bottom_left',
				'display_close_button'     => isset( $settings->display_close_button ) ? $settings->display_close_button : true,
				'display_branding'         => isset( $settings->display_branding ) ? $settings->display_branding : true,
				'title_color'              => ! empty( $settings->title_color ) ? $settings->title_color : '#000',
				'description_color'        => ! empty( $settings->description_color ) ? $settings->description_color : '#000',
				'background_color'         => ! empty( $settings->background_color ) ? $settings->background_color : '#fff',
				'button_background_color'  => ! empty( $settings->button_background_color ) ? $settings->button_background_color : '#272727',
				'button_color'             => ! empty( $settings->button_color ) ? $settings->button_color : '#fff',
				'border_radius'            => ! empty( $settings->border_radius ) ? $settings->border_radius : 'rounded',
				'data_send_is_enabled'     => ! empty( $settings->data_send_is_enabled ) ? $settings->data_send_is_enabled : 0,
				'data_send_webhook'        => ! empty( $settings->data_send_webhook ) ? $settings->data_send_webhook : '',
				'data_send_email'          => ! empty( $settings->data_send_email ) ? $settings->data_send_email : '',

				'notification_id' => $post_id,
			],

			'LATEST_CONVERSION' => [
				"name" => "Latest Conversion",
				"icon" => "fa fa-funnel-dollar",

				'title'                    => ! empty( $settings->title ) ? $settings->title : "A cool person",
				'description'              => ! empty( $settings->description ) ? $settings->description : "Signed up for the newsletter.",
				'image'                    => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/color/2x/webhook.png",
				'time_ago'                 => ! empty( $settings->time_ago ) ? $settings->time_ago : "10 mins ago",
				'url'                      => ! empty( $settings->url ) ? $settings->url : '',
				'conversions_count'        => ! empty( $settings->conversions_count ) ? $settings->conversions_count : 1,
				'trigger_all_pages'        => isset( $settings->trigger_all_pages ) ? $settings->trigger_all_pages : true,
				'triggers'                 => ! empty( $settings->triggers ) ? $settings->triggers : [],
				'display_trigger'          => ! empty( $settings->display_trigger ) ? $settings->display_trigger : 'delay',
				'display_trigger_value'    => ! empty( $settings->display_trigger_value ) ? $settings->display_trigger_value : 2,
				'display_once_per_session' => isset( $settings->display_once_per_session ) ? $settings->display_once_per_session : false,
				'display_mobile'           => isset( $settings->display_mobile ) ? $settings->display_mobile : true,
				'display_minimum_activity' => ! empty( $settings->display_minimum_activity ) ? $settings->display_minimum_activity : 0,
				'display_duration'         => ! empty( $settings->display_duration ) ? $settings->display_duration : 5,
				'display_position'         => ! empty( $settings->display_position ) ? $settings->display_position : 'bottom_left',
				'display_close_button'     => isset( $settings->display_close_button ) ? $settings->display_close_button : true,
				'display_branding'         => isset( $settings->display_branding ) ? $settings->display_branding : true,
				'title_color'              => ! empty( $settings->title_color ) ? $settings->title_color : '#000',
				'description_color'        => ! empty( $settings->description_color ) ? $settings->description_color : '#000',
				'background_color'         => ! empty( $settings->background_color ) ? $settings->background_color : '#fff',
				'border_radius'            => ! empty( $settings->border_radius ) ? $settings->border_radius : 'rounded',
				'data_trigger_auto'        => isset( $settings->data_trigger_auto ) ? $settings->data_trigger_auto : false,
				'data_triggers_auto'       => ! empty( $settings->data_triggers_auto ) ? $settings->data_triggers_auto : [],

				'notification_id' => $post_id,
			],

			'CONVERSIONS_COUNTER' => [
				"name" => "Conversions Counter",
				"icon" => "fa fa-comment-dollar",

				'title'                    => ! empty( $settings->title ) ? $settings->title : "People bought the product",
				'image'                    => ! empty( $settings->image ) ? $settings->image : "https://img.icons8.com/officel/2x/return-purchase.png",
				'number'                   => ! empty( $settings->number ) ? $settings->number : "5",
				'time'                     => ! empty( $settings->time ) ? $settings->time : "In the last %s hours",
				'last_activity'            => ! empty( $settings->last_activity ) ? $settings->last_activity : 2,
				'url'                      => ! empty( $settings->url ) ? $settings->url : '',
				'trigger_all_pages'        => isset( $settings->trigger_all_pages ) ? $settings->trigger_all_pages : true,
				'triggers'                 => ! empty( $settings->triggers ) ? $settings->triggers : [],
				'display_trigger'          => ! empty( $settings->display_trigger ) ? $settings->display_trigger : 'delay',
				'display_trigger_value'    => ! empty( $settings->display_trigger_value ) ? $settings->display_trigger_value : 2,
				'display_duration'         => ! empty( $settings->display_duration ) ? $settings->display_duration : 5,
				'display_position'         => ! empty( $settings->display_position ) ? $settings->display_position : 'bottom_left',
				'display_minimum_activity' => ! empty( $settings->display_minimum_activity ) ? $settings->display_minimum_activity : 0,
				'display_once_per_session' => isset( $settings->display_once_per_session ) ? $settings->display_once_per_session : false,
				'display_close_button'     => isset( $settings->display_close_button ) ? $settings->display_close_button : false,
				'display_branding'         => isset( $settings->display_branding ) ? $settings->display_branding : true,
				'display_mobile'           => isset( $settings->display_mobile ) ? $settings->display_mobile : true,
				'number_color'             => ! empty( $settings->number_color ) ? $settings->number_color : '#fff',
				'number_background_color'  => ! empty( $settings->number_background_color ) ? $settings->number_background_color : '#000',
				'title_color'              => ! empty( $settings->title_color ) ? $settings->title_color : '#000',
				'background_color'         => ! empty( $settings->background_color ) ? $settings->background_color : '#fff',
				'border_radius'            => ! empty( $settings->border_radius ) ? $settings->border_radius : 'rounded',
				'data_trigger_auto'        => isset( $settings->data_trigger_auto ) ? $settings->data_trigger_auto : false,
				'data_triggers_auto'       => ! empty( $settings->data_triggers_auto ) ? $settings->data_triggers_auto : [],

				'notification_id' => $post_id,
			],

			'VIDEO' => [
				"name" => "Video",
				"icon" => "fa fa-video",

				'title'                    => ! empty( $settings->title ) ? $settings->title : "Demo of the product 🔥",
				'video'                    => ! empty( $settings->video ) ? $settings->video : "https://www.youtube.com/embed/zWZa05uaiNA",
				'button_url'               => ! empty( $settings->button_url ) ? $settings->button_url : '',
				'button_text'              => ! empty( $settings->button_text ) ? $settings->button_text : "Sign up 🙌",
				'trigger_all_pages'        => ! empty( $settings->trigger_all_pages ) ? $settings->trigger_all_pages : true,
				'triggers'                 => ! empty( $settings->triggers ) ? $settings->triggers : [],
				'display_trigger'          => ! empty( $settings->display_trigger ) ? $settings->display_trigger : 'delay',
				'display_trigger_value'    => ! empty( $settings->display_trigger_value ) ? $settings->display_trigger_value : 2,
				'display_once_per_session' => ! empty( $settings->display_once_per_session ) ? $settings->display_once_per_session : false,
				'display_mobile'           => ! empty( $settings->display_mobile ) ? $settings->display_mobile : true,
				'display_duration'         => ! empty( $settings->display_duration ) ? $settings->display_duration : 5,
				'display_position'         => ! empty( $settings->display_position ) ? $settings->display_position : 'bottom_left',
				'display_close_button'     => ! empty( $settings->display_close_button ) ? $settings->display_close_button : true,
				'display_branding'         => ! empty( $settings->display_branding ) ? $settings->display_branding : true,
				'title_color'              => ! empty( $settings->title_color ) ? $settings->title_color : '#000',
				'background_color'         => ! empty( $settings->background_color ) ? $settings->background_color : '#fff',
				'button_background_color'  => ! empty( $settings->button_background_color ) ? $settings->button_background_color : '#000',
				'button_color'             => ! empty( $settings->button_color ) ? $settings->button_color : '#fff',
				'border_radius'            => ! empty( $settings->border_radius ) ? $settings->border_radius : 'rounded',

				'notification_id' => $post_id,
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

		return $type ? $all[ $type ] : $all;
	}

	public static function get_view( $type, $post_id = false ) {
		$notification = (object) self::get_config( $type, $post_id );

		return require TOTO_INCLUDES . '/admin/views/notifications/view/' . strtolower( $type ) . '.php';
	}

	public static function preview( $type, $post_id = false ) {
		$notification = self::get_view( $type, $post_id );

		echo preg_replace( [ '/<form/', '/<\/form>/', '/required=\"required\"/' ], [
			'<div',
			'</div>',
			''
		], $notification->html );
	}

	public static function preview_handler( $type ) {
		$handlers = [
			'INFORMATIONAL' => [
				'title'                => 'title',
				'description'          => 'description',
				'image'                => 'image',
				'title_color'          => 'title',
				'description_color'    => 'description',
				'background_color'     => 'wrapper',
				'border_radius'        => 'wrapper',
				'display_close_button' => 'close',
			],

			'COUPON' => [
				'title'                   => 'title',
				'description'             => 'description',
				'image'                   => 'image',
				'coupon_code'             => 'coupon-code',
				'button_text'             => 'button',
				'footer_text'             => 'footer',
				'title_color'             => 'title',
				'description_color'       => 'description',
				'background_color'        => 'wrapper',
				'button_background_color' => 'button',
				'button_color'            => 'button',
				'border_radius'           => 'wrapper',
				'display_close_button'    => 'close',
			],

			'LIVE_COUNTER' => [
				'description'             => 'description',
				'number_color'            => 'number',
				'number_background_color' => 'number',
				'description_color'       => 'description',
				'background_color'        => 'wrapper',
				'pulse_background_color'  => 'toto-toast-pulse',
				'border_radius'           => 'wrapper',
				'display_close_button'    => 'close',
			],

			'EMAIL_COLLECTOR' => [
				'title'                   => 'title',
				'description'             => 'description',
				'email_placeholder'       => 'email-placeholder',
				'button_text'             => 'button',
				'agreement_text'          => 'toto-agreement-checkbox-text',
				'show_agreement'          => 'toto-agreement-checkbox',
				'title_color'             => 'title',
				'description_color'       => 'description',
				'background_color'        => 'wrapper',
				'button_background_color' => 'button',
				'button_color'            => 'button',
				'border_radius'           => 'wrapper',
				'display_close_button'    => 'close',
			],

		];

		$scripts = '';
		foreach ( $handlers[ $type ] as $key => $target ) {

			$selector = strtolower( str_replace( '_', '-', $type ) );

			ob_start();
			if ( ! in_array( $key, [
				'title_color',
				'description_color',
				'background_color',
				'button_background_color',
				'button_color',
				'number_background_color',
				'number_color',
				'pulse_background_color',
			] ) ) { ?>
                $('#settings_<?php echo $key; ?>').on('change paste keyup', function() {
				<?php
				if ( in_array( $key, [
					'title',
					'description',
					'coupon_code',
					'button_text',
					'footer_text',
				] ) ) {
					printf( '$("#notification_preview .toto-%1$s-%2$s").text($(this).val());', $selector, $target );
				} elseif ( in_array( $key, [ 'image' ] ) ) {
					printf( '$("#notification_preview .toto-%1$s-%2$s").attr("src", $(this).val());', $selector, $target );
				} elseif ( in_array( $key, [ 'border_radius' ] ) ) {
					printf( '$("#notification_preview .toto-%s").removeClass("toto-wrapper-round toto-wrapper-rounded  toto-wrapper-straight").addClass(`toto-wrapper-${$(this).val()}`);', $target );
				} elseif ( in_array( $key, [ 'email_placeholder' ] ) ) {
					printf( '$("#notification_preview .toto-%1$s-%2$s").attr("placeholder", $(this).val());', $selector, $target );
				} elseif ( in_array( $key, [ 'show_agreement' ] ) ) {
					printf( '$("#notification_preview .%s").toggle();', $target );
				} elseif ( in_array( $key, [ 'agreement_text' ] ) ) {
					printf( '$("#notification_preview .%s").text($(this).val());', $target );
				} elseif ( in_array( $key, [ 'display_close_button' ] ) ) {
					printf( '$("#notification_preview .toto-%s").toggle();', $target );
				}

				?>
                });
			<?php } else { ?>
                $('#settings_<?php echo $key; ?>').wpColorPicker({                change: (e, ui)=>{                setTimeout(function(){
				<?php
				if ( in_array( $key, [ 'title_color', 'description_color', 'button_color', 'number_color', ] ) ) {
					printf( '$("#notification_preview .toto-%1$s-%2$s").css("color", e.target.value);', $selector, $target );
				} elseif ( in_array( $key, [ 'button_background_color', 'number_background_color', ] ) ) {
					printf( '$("#notification_preview .toto-%1$s-%2$s").css("background-color", e.target.value);', $selector, $target );
				} elseif ( in_array( $key, [ 'background_color', ] ) ) {
					printf( '$("#notification_preview .toto-%s").css("background-color", e.target.value);', $target );
				} elseif ( in_array( $key, [ 'pulse_background_color', ] ) ) {
					printf( '$("#notification_preview .%s").css("background-color", e.target.value);', $target );
				}
				?>
                }, 100);    }                });

			<?php }
			$scripts .= ob_get_clean();
		}

		echo "<script id='preview_handler'>;(function($) {
		  $(document).ready(function() {
		    {$scripts}
		  });
		})(jQuery)</script>";

	}

	/**
     * Check if the notification type supports data collection
     *
	 * @param $type
	 *
	 * @return bool
	 */
	public static function is_data_supports( $type ) {

		if ( in_array( $type, [
			'EMAIL_COLLECTOR',
			'LATEST_CONVERSION',
			'CONVERSIONS_COUNTER',
			'RANDOM_REVIEW',
			'REQUEST_COLLECTOR',
			'COUNTDOWN_COLLECTOR'
		] ) ) {
			return true;
		}

		return false;
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
			$settings_tabs = [ 'content', 'triggers', 'display', 'customize' ];
		}

		if ( in_array( $type, [
			'EMAIL_COLLECTOR',
			'LATEST_CONVERSION',
			'CONVERSIONS_COUNTER',
			'RANDOM_REVIEW',
			'REQUEST_COLLECTOR',
			'COUNTDOWN_COLLECTOR'
		] ) ) {
			$settings_tabs = [ 'content', 'triggers', 'display', 'customize', 'data' ];
		}

		return $settings_tabs;
	}

	public static function settings_fields( $type, $field = false, $post_id = false ) {
		$notification = self::get_config( $type, $post_id );

		$fields = require TOTO_INCLUDES . '/admin/views/notifications/settings/fields.php';

		return $field ? $fields->$field : $fields;
	}

	public static function setting_tabs( $type ) {
		$default_triggers = [ 'trigger', 'display_trigger', 'display_once_per_session', 'display_mobile', ];

		$default_display = [ 'display_duration', 'display_position', 'display_close_button', 'display_branding', ];

		$fields = [
			'INFORMATIONAL' => [
				'content'   => [ 'title', 'description', 'image', 'url', ],
				'triggers'  => $default_triggers,
				'display'   => $default_display,
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
				'triggers'  => $default_triggers,
				'display'   => $default_display,
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
				'triggers'  => array_merge( $default_triggers, [ 'minimum_activity' ] ),
				'display'   => $default_display,
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
				'triggers'  => $default_triggers,
				'display'   => $default_display,
				'customize' => [
					'title_color',
					'description_color',
					'background_color',
					'button_background_color',
					'button_color',
					'border_radius',
				],
				'data'      => [ 'data_send_is_enabled', ],
			],
		];

		return $fields[ $type ];

	}

	public static function active_notifications() {
		$args = [
			'post_type'   => 'toto_notification',
			'post_status' => 'publish',
			//'meta_key'    => '_status',
			//'meta_value'  => 'enable',
		];

		$posts = get_posts( $args );

		$scripts = '';

		if ( ! empty( $posts ) ) {
			$post_ids = wp_list_pluck( $posts, 'ID' );

			foreach ( $post_ids as $post_id ) {
				$type = get_post_meta( $post_id, '_notification_type', true );

				$scripts .= Toto_Notifications::get_view( $type, $post_id )->javascript;
			}

		}

		printf( '<script>%1$s</script>', $scripts );

	}

}


