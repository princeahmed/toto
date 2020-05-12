<?php

defined( 'ABSPATH' ) || exit();

class Trust_Plus_Settings {
	public function __construct() {
		add_action( 'admin_init', [ $this, 'render_settings' ] );
		add_filter( 'prince_on_off_switch_on_label', [ $this, 'switch_on_label' ], 10, 2 );
		add_filter( 'prince_on_off_switch_off_label', [ $this, 'switch_off_label' ], 10, 2 );

		add_filter( 'prince_header_version_text', [ $this, 'settings_version_text' ] );
		add_filter( 'prince_header_logo_link', [ $this, 'settings_page_logo' ] );
		add_filter( 'prince_settings_parent_slug', [ $this, 'settings_menu' ] );

		add_filter( 'prince_settings_id', [ $this, 'prince_settings_id' ] );
		add_filter( 'prince_options_id', [ $this, 'prince_options_id' ] );

		add_action( 'prince_after_settings_save', [ $this, 'update_modules' ] );
	}

	public function settings_sections() {
		return [
			[
				'id'    => 'general',
				'icon'  => 'dashicons dashicons-admin-generic',
				'title' => __( 'General Settings', 'social-proof-fomo-notification' )
			],

			[
				'id'    => 'branding',
				'icon'  => 'dashicons dashicons-shield',
				'title' => __( 'Branding Settings', 'social-proof-fomo-notification' )
			],

			[
				'id'    => 'statistics_reporting',
				'icon'  => 'dashicons dashicons-chart-bar',
				'title' => __( 'Statistics & Reporting', 'social-proof-fomo-notification' )
			],

		];
	}

	public function settings_fields() {
		return [

			//General
			[
				'id'       => 'modules',
				'label'    => __( 'Modules', 'social-proof-fomo-notification' ),
				'desc'     => __( 'Enable/ Disable the modules that you need.', 'social-proof-fomo-notification' ),
				'type'     => 'function',
				'settings' => [
					'function' => 'trust_plus_enable_disable_modules_html',
				],
				'block'    => true,
				'section'  => 'general',
				'std'      => array_keys( Trust_Plus_Notifications::get_config() ),
			],

			//Branding
			array(
				'id'      => 'show_hide_branding',
				'label'   => __( 'Show/ Hide Branding', 'social-proof-fomo-notification' ),
				'desc'    => __( 'Show/ Hide, Powered by text from notification.', 'social-proof-fomo-notification' ),
				'std'     => 'on',
				'type'    => 'on_off',
				'block'   => true,
				'section' => 'branding',

			),

			array(
				'id'        => 'branding_name',
				'block'     => true,
				'label'     => __( 'Branding Name', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Enter the branding name.', 'social-proof-fomo-notification' ),
				'std'       => 'social-proof-fomo-notification',
				'type'      => 'text',
				'section'   => 'branding',
				'operator'  => 'or',
				'condition' => 'show_hide_branding:is(on)',
			),

			array(
				'id'        => 'branding_url',
				'block'     => true,
				'label'     => __( 'Branding URL', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Enter the branding URL.', 'social-proof-fomo-notification' ),
				'std'       => 'https://wordpress.org/plugin/trust-plus-social-proof-notification',
				'type'      => 'text',
				'section'   => 'branding',
				'operator'  => 'or',
				'condition' => 'show_hide_branding:is(on)',
			),

			//Statistics & Reporting Settings
			array(
				'id'      => 'enable_disable_statistics',
				'label'   => __( 'Enable/ Disable Statistics', 'social-proof-fomo-notification' ),
				'desc'    => __( 'Enable/ Disable, Statistics Report.', 'social-proof-fomo-notification' ),
				'std'     => 'on',
				'type'    => 'on_off',
				'block'   => true,
				'section' => 'statistics_reporting',
			),

			array(
				'id'        => 'enable_disable_reporting',
				'label'     => __( 'Enable/ Disable Email Reporting', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Enable/ disable, statistics email report.', 'social-proof-fomo-notification' ),
				'std'       => 'on',
				'type'      => 'on_off',
				'block'     => true,
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_statistics:is(on)',
			),

			array(
				'id'        => 'reporting_frequency',
				'label'     => __( 'Reporting Frequency', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Select the reporting frequency, when you want to receive the email report.', 'social-proof-fomo-notification' ),
				'std'       => 'daily',
				'type'      => 'select',
				'block'     => true,
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_reporting:is(on)',
				'choices'   => [
					'daily'   => __( 'Once Daily', 'social-proof-fomo-notification' ),
					'weekly'  => __( 'Once Weekly', 'social-proof-fomo-notification' ),
					'monthly' => __( 'Once Monthly', 'social-proof-fomo-notification' ),
				]
			),

			array(
				'id'        => 'reporting_frequency_day',
				'label'     => __( 'Select Reporting Day', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Select the day of the Week, when you want to receive the email report.', 'social-proof-fomo-notification' ),
				'std'       => 'sun',
				'type'      => 'select',
				'block'     => true,
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'reporting_frequency:is(weekly)',
				'choices'   => [
					'sun' => __( 'Sunday', 'social-proof-fomo-notification' ),
					'mon' => __( 'Monday', 'social-proof-fomo-notification' ),
					'tue' => __( 'Tuesday', 'social-proof-fomo-notification' ),
					'wed' => __( 'Wednesday', 'social-proof-fomo-notification' ),
					'thu' => __( 'Thursday', 'social-proof-fomo-notification' ),
					'fri' => __( 'Friday', 'social-proof-fomo-notification' ),
					'sat' => __( 'Saturday', 'social-proof-fomo-notification' ),
				]
			),

			array(
				'id'        => 'reporting_email',
				'block'     => true,
				'label'     => __( 'Reporting Email', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Enter the email, where the statistics report will be send.', 'social-proof-fomo-notification' ),
				'std'       => get_option( 'admin_email' ),
				'type'      => 'text',
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_reporting:is(on),',
			),

			array(
				'id'        => 'reporting_email_subject',
				'block'     => true,
				'label'     => __( 'Reporting Email Subject', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Enter the reporting email subject.', 'social-proof-fomo-notification' ),
				'std'       => sprintf( __( 'Daily Engagement Statistics of "%s".', 'social-proof-fomo-notification' ), get_bloginfo( 'name' ) ),
				'type'      => 'text',
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_reporting:is(on),',
			),

			array(
				'id'        => 'reporting_test',
				'block'     => true,
				'label'     => __( 'Reporting Test', 'social-proof-fomo-notification' ),
				'desc'      => __( 'Test email report now.', 'social-proof-fomo-notification' ),
				'std'       => '',
				'type'      => 'function',
				'settings'  => [
					'function' => 'trust_plus_reporting_test_btn',
				],
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_reporting:is(on),',
			),

		];
	}

	public function render_settings() {

		if ( ! function_exists( 'prince_settings_id' ) || ! is_admin() ) {
			return;
		}

		$saved_settings = get_option( prince_settings_id(), array() );

		$custom_settings = array(

			'sections' => $this->settings_sections(),

			'settings' => $this->settings_fields(),
		);

		/* allow settings to be filtered before saving */
		$custom_settings = apply_filters( prince_settings_id() . '_args', $custom_settings );

		/* settings are not the same update the DB */
		if ( $saved_settings !== $custom_settings ) {
			update_option( prince_settings_id(), $custom_settings );
		}

		global $prince_has_custom_settings;
		$prince_has_custom_settings = true;

	}

	public function switch_on_label( $label, $field_id ) {
		if ( in_array( $field_id, [ 'show_hide_branding' ] ) ) {
			$label = __( 'Show', 'social-proof-fomo-notification' );
		} elseif ( in_array( $field_id, [ 'enable_disable_statistics', 'enable_disable_reporting' ] ) ) {
			$label = __( 'Enable', 'social-proof-fomo-notification' );
		}

		return $label;
	}

	public function switch_off_label( $label, $field_id ) {
		if ( in_array( $field_id, [ 'show_hide_branding' ] ) ) {
			$label = __( 'Hide', 'social-proof-fomo-notification' );
		} elseif ( in_array( $field_id, [ 'enable_disable_statistics', 'enable_disable_reporting' ] ) ) {
			$label = __( 'Disable', 'social-proof-fomo-notification' );
		}

		return $label;
	}

	/**
	 * Settings page version text
	 *
	 * @param $text
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public function settings_version_text( $text ) {
		return __( 'TOTO - ' . TRUST_PLUS_VERSION, 'social-proof-fomo-notification' );
	}

	/**
	 * Settings page logo
	 *
	 * @param $html
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public function settings_page_logo( $html ) {
		//todo change logo url
		return '<a href="http://wordpress.org/plugins/trust_plus" target="_blank"> <img style="position: relative; height: auto;margin-top: 3px;" src="' . TRUST_PLUS_ASSETS . '/images/trust-plus-logo.png"> </a>';
	}

	/**
	 * Add settings menu to Main menu
	 */
	public function settings_menu() {
		return 'edit.php?post_type=trust_plus';
	}

	/**
	 * Chage prince_settings_id
	 *
	 * @return string
	 */
	public function prince_settings_id() {
		return 'trust_plus_settings';
	}

	/**
	 * Chage prince_options_id option key
	 *
	 * @return string
	 */
	public function prince_options_id() {
		return 'trust_plus_options';
	}

	public function update_modules( $options ) {

	}

}

new Trust_Plus_Settings();

function trust_plus_reporting_test_btn() {
	printf( '<a href="#" class="button button-primary button-large">%s</a>', __( 'Test Report', 'social-proof-fomo-notification' ) );
}

function trust_plus_enable_disable_modules_html() {

	$default        = array_keys( Trust_Plus_Notifications::get_config() );
	$active_modules = trust_plus_get_options( 'active_modules', $default );

	?>
    <div class="trust-plus-modules">
		<?php foreach ( Trust_Plus_Notifications::get_config() as $type => $config ) { ?>
            <div class="trust-plus-module">

                <h3 class="trust-plus-module-title"><?php echo $config['name']; ?></h3>

                <div class="trust-plus-module-icon">
                    <i class="<?php echo $config['icon']; ?>"></i>
                </div>

                <div class="trust-plus-switcher">
                    <input type="checkbox" name="trust_plus_options[active_modules][]" id="<?php echo $type; ?>" value="<?php echo $type; ?>"
						<?php echo in_array( $type, $active_modules ) ? 'checked' : ''; ?> />

                    <div>
                        <label for="<?php echo $type; ?>"></label>
                    </div>
                </div>

            </div>
		<?php } ?>

    </div>
<?php }
