<?php // phpcs:ignore WordPress.Files.FileName Squiz.Commenting.FileComment.Missing
namespace COCA\WP_Before_After_Image_Slider\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Dashboard class
 *
 * @package COCA\WP_Before_After_Image_Slider
 * @since   1.1.1
 */
class Dashboard {

	/**
	 * The instance of the current class.
	 *
	 * @var ?self $instance
	 */
	private static ?self $instance = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
	}

	/**
	 * Register admin menu
	 *
	 * @return void
	 */
	public function register_admin_menu() {
		add_submenu_page(
			'edit.php?post_type=coca_bais',
			__( 'Dashboard', 'wp-before-after-image-slider' ),
			__( 'Dashboard', 'wp-before-after-image-slider' ),
			'manage_options',
			'bais-dashboard',
			array( $this, 'render_dashboard_page' )
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_dashboard_assets' ) );
	}

	/**
	 * Enqueue dashboard assets
	 *
	 * @param string $hook Hook suffix for the current admin page.
	 * @return void
	 */
	public function enqueue_dashboard_assets( $hook ) {
		if ( 'coca_bais_page_bais-dashboard' !== $hook ) {
			return;
		}

		// Make sure jQuery is loaded first in the header.
		wp_enqueue_script( 'jquery', false, array(), COCA_BAIS_VERSION, false );

		// Enqueue React app scripts and styles.
		wp_enqueue_script(
			'coca-bais-dashboard',
			plugins_url( 'assets/admin/js/dashboard.js', COCA_BAIS_FILE ),
			array( 'jquery', 'wp-element', 'wp-components', 'wp-api-fetch' ),
			COCA_BAIS_VERSION,
			true
		);

		wp_enqueue_style(
			'coca-bais-dashboard-style',
			plugins_url( 'assets/admin/css/dashboard.css', COCA_BAIS_FILE ),
			array( 'wp-components' ),
			COCA_BAIS_VERSION
		);

		// Localize script with data.
		wp_localize_script(
			'coca-bais-dashboard',
			'cocaBaisDashboard',
			array(
				'nonce'        => wp_create_nonce( 'wp_rest' ),
				'apiUrl'       => rest_url( 'wp/v2/' ),
				'adminUrl'     => admin_url(),
				'pluginUrl'    => plugins_url( '/', COCA_BAIS_FILE ),
				'postType'     => 'coca_bais',
				'proStatus'    => apply_filters( 'coca_bais_pro_enabled', false ),
				// Add jQuery flag to confirm it's available.
				'jQueryLoaded' => true,
			)
		);

		// Add the global assets for the dashboard.
		if ( function_exists( 'coca_bais_global_assets' ) ) {
			wp_localize_script( 'coca-bais-dashboard', 'COCA_BAIS_ASSETS', coca_bais_global_assets() );
		}

		// Add inline script to check jQuery availability.
		wp_add_inline_script( 'coca-bais-dashboard', 'window.cocaBaisJQuery = jQuery;', 'before' );
	}

	/**
	 * Render dashboard page
	 *
	 * @return void
	 */
	public function render_dashboard_page() {
		?>
		<div class="wrap">
			<div id="coca-bais-dashboard-app"></div>
		</div>
		<?php
	}

	/**
	 * Get the instance of the class.
	 *
	 * @return ?self
	 */
	public static function get_instance(): ?self {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
