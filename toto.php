<?php

/**
 * Plugin Name: Toto
 * Plugin URI:  https://princeboss.com
 * Description: Make WordPress plugin Quickly.
 * Version:     1.0.0
 * Author:      Prince
 * Author URI:  http://princeboss.com
 * Text Domain: toto
 * Domain Path: /languages/
 */

defined( 'ABSPATH' ) || exit();


/**
 * Main initiation class
 *
 * @since 1.0.0
 */
final class Toto {

	public $version = '1.0.0';

	public $min_php = '5.6.0';

	public $name = 'Toto';

	protected static $instance = null;

	public function __construct() {

		if ( $this->check_environment() ) {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
			do_action( 'toto_loaded' );
		}

	}

	public function check_environment() {

		$return = true;

		if ( version_compare( PHP_VERSION, $this->min_php, '<=' ) ) {
			$return = false;

			$notice = sprintf( /* translators: %s: Min PHP version */ esc_html__( 'Unsupported PHP version Min required PHP Version: "%s"', 'wp-plugin-boilerplate' ), $this->min_php );
		}

		if ( ! $return ) {
			// Add notice and deactivate the plugin
			add_action( 'admin_notices', function () use ( $notice ) { ?>
                <div class="notice is-dismissible notice-error">
                    <p><?php echo $notice; ?></p>
                </div>
			<?php } );

			if ( ! function_exists( 'deactivate_plugins' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			deactivate_plugins( plugin_basename( __FILE__ ) );
		}

		return $return;

	}

	public function define_constants() {
		define( 'TOTO_VERSION', $this->version );
		define( 'TOTO_FILE', __FILE__ );
		define( 'TOTO_PATH', dirname( TOTO_FILE ) );
		define( 'TOTO_INCLUDES', TOTO_PATH . '/includes' );
		define( 'TOTO_URL', plugins_url( '', TOTO_FILE ) );
		define( 'TOTO_ASSETS', TOTO_URL . '/assets' );
		define( 'TOTO_TEMPLATES', TOTO_PATH . '/templates' );
	}

	public function includes() {

		/* core includes */
		include_once TOTO_INCLUDES . '/class-cpt.php';
		include_once TOTO_INCLUDES . '/class-shortcodes.php';
		include_once TOTO_INCLUDES . '/class-enqueue.php';
		include_once TOTO_INCLUDES . '/class-form-handler.php';
		include_once TOTO_INCLUDES . '/class-ajax.php';
		include_once TOTO_INCLUDES . '/functions.php';
		include_once TOTO_INCLUDES . '/prince-settings/prince-loader.php';

		/* admin includes */
		if ( is_admin() ) {
			include_once TOTO_INCLUDES . '/admin/class-admin.php';
		}

	}

	public function init_hooks() {

		/* Localize our plugin */
		add_action( 'init', [ $this, 'localization_setup' ] );

		/* action_links */
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_action_links' ] );

	}

	public function localization_setup() {
		load_plugin_textdomain( 'wp-plugin-boilerplate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	public function plugin_action_links( $links ) {
		$links[] = '<a href="' . admin_url( 'edit.php?post_type=post_type&page=settings' ) . '">' . __( 'Settings', 'wp-plugin-boilerplate' ) . '</a>';

		return $links;
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

function toto() {
	return Toto::instance();
}

toto();
