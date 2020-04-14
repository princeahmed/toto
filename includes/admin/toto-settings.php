<?php

defined( 'ABSPATH' ) || exit();

class Toto_Settings {
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
				'title' => __( 'General Settings', 'toto' )
			],

			[
				'id'    => 'branding',
				'icon'  => 'dashicons dashicons-shield',
				'title' => __( 'Branding Settings', 'toto' )
			],

			[
				'id'    => 'statistics_reporting',
				'icon'  => 'dashicons dashicons-chart-bar',
				'title' => __( 'Statistics & Reporting', 'toto' )
			],

		];
	}

	public function settings_fields() {
		return [

			//General
			[
				'id'       => 'modules',
				'label'    => __( 'Modules', 'toto' ),
				'desc'     => __( 'Enable/ Disable the modules that you need.', 'toto' ),
				'type'     => 'function',
				'settings' => [
					'function' => 'toto_enable_disable_modules_html',
				],
				'block'    => true,
				'section'  => 'general',
				'std'      => array_keys( Toto_Notifications::get_config() ),
			],

			//Branding
			array(
				'id'      => 'show_hide_branding',
				'label'   => __( 'Show/ Hide Branding', 'toto' ),
				'desc'    => __( 'Show/ Hide, Powered by text from notification.', 'toto' ),
				'std'     => 'on',
				'type'    => 'on_off',
				'block'   => true,
				'section' => 'branding',

			),

			array(
				'id'        => 'branding_name',
				'block'     => true,
				'label'     => __( 'Branding Name', 'toto' ),
				'desc'      => __( 'Enter the branding name.', 'toto' ),
				'std'       => 'toto',
				'type'      => 'text',
				'section'   => 'branding',
				'operator'  => 'or',
				'condition' => 'show_hide_branding:is(on)',
			),

			array(
				'id'        => 'branding_url',
				'block'     => true,
				'label'     => __( 'Branding URL', 'toto' ),
				'desc'      => __( 'Enter the branding URL.', 'toto' ),
				'std'       => 'https://wordpress.org/plugin/toto-social-proof-notification',
				'type'      => 'text',
				'section'   => 'branding',
				'operator'  => 'or',
				'condition' => 'show_hide_branding:is(on)',
			),

			//Statistics & Reporting Settings
			array(
				'id'      => 'enable_disable_statistics',
				'label'   => __( 'Enable/ Disable Statistics', 'toto' ),
				'desc'    => __( 'Enable/ Disable, Statistics Report.', 'toto' ),
				'std'     => 'on',
				'type'    => 'on_off',
				'block'   => true,
				'section' => 'statistics_reporting',
			),

			array(
				'id'        => 'enable_disable_reporting',
				'label'     => __( 'Enable/ Disable Email Reporting', 'toto' ),
				'desc'      => __( 'Enable/ disable, statistics email report.', 'toto' ),
				'std'       => 'on',
				'type'      => 'on_off',
				'block'     => true,
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_statistics:is(on)',
			),

			array(
				'id'        => 'reporting_frequency',
				'label'     => __( 'Reporting Frequency', 'toto' ),
				'desc'      => __( 'Select the reporting frequency, when you want to receive the email report.', 'toto' ),
				'std'       => 'daily',
				'type'      => 'select',
				'block'     => true,
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_reporting:is(on)',
				'choices'   => [
					'daily'   => __( 'Once Daily', 'toto' ),
					'weekly'  => __( 'Once Weekly', 'toto' ),
					'monthly' => __( 'Once Monthly', 'toto' ),
				]
			),

			array(
				'id'        => 'reporting_frequency_day',
				'label'     => __( 'Select Reporting Day', 'toto' ),
				'desc'      => __( 'Select the day of the Week, when you want to receive the email report.', 'toto' ),
				'std'       => 'sun',
				'type'      => 'select',
				'block'     => true,
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'reporting_frequency:is(weekly)',
				'choices'   => [
					'sun' => __( 'Sunday', 'toto' ),
					'mon' => __( 'Monday', 'toto' ),
					'tue' => __( 'Tuesday', 'toto' ),
					'wed' => __( 'Wednesday', 'toto' ),
					'thu' => __( 'Thursday', 'toto' ),
					'fri' => __( 'Friday', 'toto' ),
					'sat' => __( 'Saturday', 'toto' ),
				]
			),

			array(
				'id'        => 'reporting_email',
				'block'     => true,
				'label'     => __( 'Reporting Email', 'toto' ),
				'desc'      => __( 'Enter the email, where the statistics report will be send.', 'toto' ),
				'std'       => get_option( 'admin_email' ),
				'type'      => 'text',
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_reporting:is(on),',
			),

			array(
				'id'        => 'reporting_email_subject',
				'block'     => true,
				'label'     => __( 'Reporting Email Subject', 'toto' ),
				'desc'      => __( 'Enter the reporting email subject.', 'toto' ),
				'std'       => sprintf( __( 'Daily Engagement Statistics of "%s".', 'toto' ), get_bloginfo( 'name' ) ),
				'type'      => 'text',
				'section'   => 'statistics_reporting',
				'operator'  => 'or',
				'condition' => 'enable_disable_reporting:is(on),',
			),

			array(
				'id'        => 'reporting_test',
				'block'     => true,
				'label'     => __( 'Reporting Test', 'toto' ),
				'desc'      => __( 'Test email report now.', 'toto' ),
				'std'       => '',
				'type'      => 'function',
				'settings'  => [
					'function' => 'toto_reporting_test_btn',
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
			$label = __( 'Show', 'toto' );
		} elseif ( in_array( $field_id, [ 'enable_disable_statistics', 'enable_disable_reporting' ] ) ) {
			$label = __( 'Enable', 'toto' );
		}

		return $label;
	}

	public function switch_off_label( $label, $field_id ) {
		if ( in_array( $field_id, [ 'show_hide_branding' ] ) ) {
			$label = __( 'Hide', 'toto' );
		} elseif ( in_array( $field_id, [ 'enable_disable_statistics', 'enable_disable_reporting' ] ) ) {
			$label = __( 'Disable', 'toto' );
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
		return __( 'TOTO - ' . TOTO_VERSION, 'toto' );
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
		return '<a href="http://wordpress.org/plugins/toto" target="_blank"> <img style="position: relative; height: auto;margin-top: 3px;" src="' . TOTO_ASSETS . '/images/toto-logo.png"> </a>';
	}

	/**
	 * Add settings menu to Main menu
	 */
	public function settings_menu() {
		return 'edit.php?post_type=toto_notification';
	}

	/**
	 * Chage prince_settings_id
	 *
	 * @return string
	 */
	public function prince_settings_id() {
		return 'toto_settings';
	}

	/**
	 * Chage prince_options_id option key
	 *
	 * @return string
	 */
	public function prince_options_id() {
		return 'toto_options';
	}

	public function update_modules( $options ) {

	}

}

new Toto_Settings();

function toto_reporting_test_btn() {
	printf( '<a href="#" class="button button-primary button-large">%s</a>', __( 'Test Report', 'toto' ) );
}

function toto_enable_disable_modules_html() {

	$default        = array_keys( Toto_Notifications::get_config() );
	$active_modules = toto_get_options( 'active_modules', $default );

	?>
    <div class="toto-modules">
		<?php foreach ( Toto_Notifications::get_config() as $type => $config ) { ?>
            <div class="toto-module">

                <h3 class="toto-module-title"><?php echo $config['name']; ?></h3>

                <div class="toto-module-icon">
                    <i class="<?php echo $config['icon']; ?>"></i>
                </div>

                <div class="toto-switcher">
                    <input type="checkbox" name="toto_options[active_modules][]" id="<?php echo $type; ?>" value="<?php echo $type; ?>"
						<?php echo in_array( $type, $active_modules ) ? 'checked' : ''; ?> />

                    <div>
                        <label for="<?php echo $type; ?>"></label>
                    </div>
                </div>

            </div>
		<?php } ?>

    </div>
<?php }
