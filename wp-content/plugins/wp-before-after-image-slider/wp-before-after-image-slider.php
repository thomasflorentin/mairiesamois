<?php // phpcs:ignore WordPress.Files.FileName

/**
 * WP Before After Image Slider
 *
 * phpcs:disable Universal.Files.SeparateFunctionsFromOO.Mixed
 *
 * @package           COCA\WP_Before_After_Image_Slider
 * @author            Code Canel
 * @copyright         2023 Code Canel
 * @license           GPLv2 or later
 *
 * @wordpress-plugin
 * Plugin Name:         WP Before After Image Slider
 * Plugin URI:          https://codecanel.com/wp-before-after-image-slider/
 * Description:         Craft dynamic before and after image sliders effortlessly. Engage viewers with seamless visual transitions. Compatible with top page builders like Elementor, Divi, and Gutenberg.
 * Version:             2.0.8
 * Requires at least:   6.0
 * Tested up to:        6.8
 * Requires PHP:        7.4
 * Author:              Code Canel
 * Author URI:          https://codecanel.com/
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         wp-before-after-image-slider
 * Domain Path:         /languages
 */

namespace COCA\WP_Before_After_Image_Slider;

defined( 'ABSPATH' ) || exit;

/**
 * Free Plugin Launcher Class.
 */
final class Plugin {
	/**
	 * The instance of the current class.
	 *
	 * @var ?self
	 */
	private static ?self $instance = null;  // phpcs:ignore Squiz.Commenting.VariableComment.Missing

	/**
	 * The version number.
	 *
	 * @var string
	 */
	private string $version = '2.0.8';

	/**
	 * The version number.
	 *
	 * @var string
	 */
	private string $output_path = '';

	/**
	 * Get the instance of the plugin.
	 *
	 * @return ?self
	 */
	public static function get_instance(): ?self {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new self();

			// Define constants.
			self::$instance->define_all_constants();
			self::$instance->include_all_files();

			// Set the plugin asset url.
			self::$instance->output_path = COCA_BAIS_ASSET_URL;

			// Load all features.
			self::$instance->register_all_hooks();
			self::$instance->load_admin_features();

			// load plugin languages.
			load_plugin_textdomain( 'wp-before-after-image-slider' );
		}

		return self::$instance;
	}

	/**
	 * Define require constants.
	 *
	 * @return void
	 */
	private function define_all_constants() {
		define( 'COCA_BAIS_VERSION', $this->version );
		define( 'COCA_BAIS_FILE', __FILE__ );
		if ( ! defined( 'COCA_BAIS_PATH' ) ) {
			define( 'COCA_BAIS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		}
		if ( ! defined( 'COCA_BAIS_URL' ) ) {
			define( 'COCA_BAIS_URL', plugin_dir_url( COCA_BAIS_FILE ) );
		}
		if ( ! defined( 'COCA_BAIS_ASSET_URL' ) ) {
			define( 'COCA_BAIS_ASSET_URL', plugins_url( 'assets', COCA_BAIS_FILE ) );
		}
	}

	/**
	 * Include all files
	 *
	 * @return void
	 */
	private function include_all_files() {
		require_once COCA_BAIS_PATH . 'includes/admin/MetaBoxes.php';
		require_once COCA_BAIS_PATH . 'includes/admin/Panel.php';
		require_once COCA_BAIS_PATH . 'includes/admin/PostType.php';
		require_once COCA_BAIS_PATH . 'includes/admin/RestApiRoutes.php';
		require_once COCA_BAIS_PATH . 'includes/admin/ShortCode.php';
		require_once COCA_BAIS_PATH . 'includes/admin/Dashboard.php';
	}

	/**
	 * The hook registerer.
	 *
	 * @return void
	 */
	private function register_all_hooks() {
		// Register hooks for plugin activation.
		register_activation_hook( COCA_BAIS_FILE, array( $this, 'activate' ) );

		// Register action links for plugin.
		add_filter( 'plugin_action_links', array( $this, 'register_action_links' ), 10, 2 );

		// Register widgets for Element Plugin.
		add_action( 'elementor/widgets/register', array( $this, 'register_elementor_widgets' ) );

		// Register scripts and styles.
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_dependencies' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_default_dependencies' ), 10000, );
		add_action( 'coca_bais_shortcode_enqueue_scripts', array( $this, 'register_shortcode_dependencies' ) );

		// Additional hooks.
		// Update style attributes for images.
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'get_attachment_image_attributes' ), 1000000000 );
		add_filter( 'image_size_names_choose', array( $this, 'image_size_names_choose' ) );
		add_action( 'elementor/widget/before_render_content', array( $this, 'widget_before_render_content' ) );

		// Update content for widget when the free feature is used.
		$widget_rendered_html_callback = array(
			'\COCA\WP_Before_After_Image_Slider\Widgets\BeforeAfterImageSlider',
			'coca_bais_widget_rendered_html',
		);
		add_filter( 'coca_bais_widget_rendered_html', $widget_rendered_html_callback, 10, 2 );
	}

	/**
	 * Activate the plugin.
	 */
	public function activate() {
		$installed = get_option( 'coca_bais_installed' );
		if ( ! $installed ) {
			update_option( 'coca_bais_installed', time() );
			// Set the redirect flag ONLY on first installation.
			update_option( 'coca_bais_do_activation_redirect', true );
		}
		update_option( 'coca_bais_version', $this->version );
	}

	/**
	 * Filters the list of attachment image attributes.
	 *
	 * @param string[] $attr Array of attribute values for the image markup, keyed by attribute name.
	 *
	 * @return string[] The filtered attributes for the image markup.
	 */
	public function get_attachment_image_attributes( array $attr ): array {
		if ( isset( $attr['class'], $attr['style'] ) && str_contains( $attr['class'], 'coca-bais-image' ) ) {
			$attr['style'] = preg_replace( '/height:[^;]+;/', '', $attr['style'] );
		}

		return $attr;
	}

	/**
	 * Set normal, human-readable name for custom media sizes.
	 *
	 * @param string[] $sizes The name list for all media sizes.
	 *
	 * @return  string[]
	 */
	public function image_size_names_choose( array $sizes ): array {
		return array_merge(
			$sizes,
			array(
				'1536x1536' => esc_html__( '2x Medium Large', 'wp-before-after-image-slider' ),
				'2048x2048' => esc_html__( '2x Large', 'wp-before-after-image-slider' ),
			)
		);
	}

	/**
	 * Fix a broken image source before the Elementor widget is being rendered.
	 *
	 * @param \Elementor\Widget_Base $widget The current widget.
	 *
	 * @return void
	 */
	public function widget_before_render_content( \Elementor\Widget_Base $widget ) {
		if ( 'coca_before_after_image_slider' === $widget->get_name() ) {
			add_filter( 'wp_get_attachment_image_src', array( $this, 'attachment_image_src' ), 10, 3 );
		}
	}

	/**
	 * The attachment image source result.
	 *
	 * @param array|false  $image Array of image data, or boolean false if no image is available.
	 * @param int          $attachment_id Image attachment ID.
	 * @param string|int[] $size Requested image size.
	 *
	 * @return array|false Array of image data, or boolean false if no image is available.
	 */
	public function attachment_image_src($image, int $attachment_id, $size){ // phpcs:ignore
		if ( is_array( $image ) && in_array( $size, array( '1536x1536', '2048x2048' ), true ) ) {
			$is_matched   = preg_match( '/(\d+x\d+)/', $image[0], $matches );
			$dynamic_size = $is_matched ? $matches[1] : $size;

			// Collect width and height from dynamic size.
			list($width, $height) = explode( 'x', $dynamic_size );

			return array( $image[0], $width, $height );
		}

		return $image;
	}

	/**
	 * Filters the action links displayed for each plugin in the Plugins list table.
	 *
	 * @param string[] $action_links An array of plugin action links.
	 * @param string   $plugin_file Path to the plugin file relative to the plugins' directory.
	 */
	public function register_action_links( array $action_links, string $plugin_file ): array {
		if ( plugin_basename( COCA_BAIS_FILE ) === $plugin_file ) {
			$page_url      = admin_url( 'edit.php?post_type=coca_bais' );
			$settings_link = '<a href="' . $page_url . '">' . esc_html__( 'Get started now!', 'wp-before-after-image-slider' ) . '</a>';
			array_unshift( $action_links, $settings_link );
		}

		return $action_links;
	}

	/**
	 * Register new widgets for Elementor.
	 *
	 * @param \Elementor\Widgets_Manager $manager The widgets' manager.
	 */
	public function register_elementor_widgets( \Elementor\Widgets_Manager $manager ) {
		require_once COCA_BAIS_PATH . 'includes/widgets/BeforeAfterImageSlider.php';

		$manager->register( new Widgets\BeforeAfterImageSlider() );
	}

	/**
	 * Register scripts and styles for the admin panel.
	 *
	 * @param string $hook_suffix The current admin page.
	 *
	 * @return void
	 */
	public function register_admin_dependencies( string $hook_suffix ) {
		$allowed_hooks = array( 'edit.php', 'post-new.php', 'post.php' );
		if ( ( 'coca_bais_page_license' === $hook_suffix ) || ( in_array( $hook_suffix, $allowed_hooks, true ) && 'coca_bais' === get_post_type() ) ) {
			// The common script and styles for widgets.
			$default_asset   = array(
				'dependencies' => array(),
				'version'      => $this->version,
			);
			$panel_asset     = $default_asset;
			$save_post_asset = $default_asset;

			if ( file_exists( plugin_dir_path( __FILE__ ) . 'assets/admin/js/panel.asset.php' ) ) {
				$panel_asset = include plugin_dir_path( __FILE__ ) . 'assets/admin/js/panel.asset.php';
			}
			if ( file_exists( plugin_dir_path( __FILE__ ) . 'assets/admin/js/save-post.asset.php' ) ) {
				$save_post_asset = include plugin_dir_path( __FILE__ ) . 'assets/admin/js/save-post.asset.php';
			}

			$panel_deps     = isset( $panel_asset['dependencies'] ) ? $panel_asset['dependencies'] : array();
			$save_post_deps = isset( $save_post_asset['dependencies'] ) ? $save_post_asset['dependencies'] : array();
			$panel_css_deps = array( 'wp-block-editor', 'wp-components', 'coca-bais-image-picker' );
			$in_footer      = array(
				'in_footer' => true,
				'strategy'  => 'defer',
			);

			wp_enqueue_script( 'coca-bais-admin-panel', "$this->output_path/admin/js/panel.js", $panel_deps, $this->version, $in_footer );
			wp_enqueue_script( 'coca-bais-admin-save-post', "$this->output_path/admin/js/save-post.js", $save_post_deps, $this->version, $in_footer );
			wp_enqueue_script( 'coca-bais-admin-copy-shortcode', "$this->output_path/admin/js/copy-shortcode.js", array(), $this->version, $in_footer );
			wp_enqueue_style( 'coca-bais-image-picker', "$this->output_path/common/css/image-picker.css", array(), $this->version );
			wp_enqueue_style( 'coca-bais-admin-components', "$this->output_path/admin/css/components.css", array(), $this->version );
			wp_enqueue_style( 'coca-bais-admin-panel', "$this->output_path/admin/css/panel.css", $panel_css_deps, $this->version );

			// Script localization.
			load_script_textdomain( 'coca-bais-admin-panel', 'wp-before-after-image-slider' );

			// Localize data.
			// If is the new version - with image size.
			$default_image_sizes   = get_intermediate_image_sizes();
			$default_image_sizes[] = 'full';
			$image_sizes           = apply_filters( 'coca_bais_image_sizes', $default_image_sizes );
			wp_localize_script( 'coca-bais-admin-panel', 'COCA_MEDIA_SIZES', $image_sizes );

			// Check the pro-version to enable all premium features.
			wp_localize_script( 'coca-bais-admin-panel', 'COCA_BAIS_ASSETS', coca_bais_global_assets() );

			// Check the pro-version to enable all premium features.
			$pro_settings = array(
				'is_pro_active'    => apply_filters( 'coca_bais_pro_enabled', false ),
				'is_triple_active' => apply_filters( 'coca_bais_three_image_slider_enabled', false ),
			);
			wp_localize_script( 'coca-bais-admin-panel', 'COCA_BAIS_PRO', $pro_settings );

			if ( in_array( $hook_suffix, $allowed_hooks, true ) && 'coca_bais' === get_post_type() ) {
				// query the media scripts.
				wp_enqueue_media();

				// The metadata for current slider post.
				$coca_meta_data = get_post_meta( get_the_ID(), '_coca_bais_meta_data', true );
				$coca_meta_data = ! empty( $coca_meta_data ) && is_array( $coca_meta_data ) ? $coca_meta_data : array();
				$coca_meta_data = apply_filters( 'coca_bais_editor_post_meta', $coca_meta_data );
				wp_localize_script( 'coca-bais-admin-panel', 'COCA_BAIS_META_DATA', $coca_meta_data );
			}
		}
	}

	/**
	 * Register scripts and styles for registered shortcode and widgets.
	 *
	 * @return array
	 */
	public function register_common_dependencies(): array {
		// The variables for widgets.
		$core_deps_scripts    = array( 'jquery' );
		$default_deps_scripts = array( 'jquery', 'coca-bais-widgets-common', 'coca-bais-lib-move', 'coca-bais-lib-imageloaded', 'coca-bais-lib-image-compare' );
		$default_deps_styles  = array( 'coca-bais-lib-image-compare' );
		$is_in_footer         = array(
			'in_footer' => true,
			'strategy'  => 'defer',
		);

		// The common script and styles for shortcode and widgets.
		wp_register_script( 'coca-bais-widgets-common', "$this->output_path/common/js/jquery.widgets-common.js", array(), $this->version, $is_in_footer );
		wp_register_script( 'coca-bais-lib-image-compare', "$this->output_path/common/js/jquery.image-compare.js", array(), $this->version, $is_in_footer );
		wp_register_style( 'coca-bais-lib-image-compare', "$this->output_path/common/css/image-compare.css", array(), $this->version );
		// The third-party libraries for shortcode and widgets.
		$assets_base = plugin_dir_url( COCA_BAIS_FILE ) . 'assets/';
		wp_register_script( 'coca-bais-lib-move', $assets_base . 'lib/js/jquery.event.move.js', array( 'jquery' ), $this->version, true );
		wp_register_script( 'coca-bais-lib-imageloaded', $assets_base . 'lib/js/imagesloaded.pkgd.min.js', array(), $this->version, $is_in_footer );

		return array(
			'core_scripts'    => $core_deps_scripts,
			'default_scripts' => $default_deps_scripts,
			'default_styles'  => $default_deps_styles,
			'is_in_footer'    => $is_in_footer,
		);
	}

	/**
	 * Register scripts and styles for registered widgets.
	 *
	 * @return void
	 */
	public function register_default_dependencies() {
		// The variables for widgets.
		$common_deps     = $this->register_common_dependencies();
		$default_scripts = isset( $common_deps['default_scripts'] ) ? $common_deps['default_scripts'] : array();
		$default_styles  = isset( $common_deps['default_styles'] ) ? $common_deps['default_styles'] : array();
		$is_in_footer    = isset( $common_deps['is_in_footer'] ) ? $common_deps['is_in_footer'] : false;

		// Elementor Widget: Scripts and styles.
		wp_register_script( 'coca-bais-widget-default', "$this->output_path/widgets/js/bais-default.js", $default_scripts, $this->version, $is_in_footer );
		wp_register_style( 'coca-bais-widget-default', "$this->output_path/widgets/css/bais-default.css", $default_styles, $this->version );
	}

	/**
	 * Register scripts and styles for registered shortcode.
	 *
	 * @return void
	 */
	public function register_shortcode_dependencies() {
		// The variables for shortcode.
		$common_deps     = $this->register_common_dependencies();
		$default_scripts = isset( $common_deps['default_scripts'] ) ? $common_deps['default_scripts'] : array();
		$default_styles  = isset( $common_deps['default_styles'] ) ? $common_deps['default_styles'] : array();
		$is_in_footer    = isset( $common_deps['is_in_footer'] ) ? $common_deps['is_in_footer'] : false;

		// Shortcode: Scripts and styles.
		wp_enqueue_script( 'coca-bais-shortcode-default', "$this->output_path/shortcodes/js/bais-default.js", $default_scripts, $this->version, $is_in_footer );
		wp_enqueue_style( 'coca-bais-shortcode-default', "$this->output_path/shortcodes/css/bais-default.css", $default_styles, $this->version );
	}

	/**
	 * Load admin features.
	 *
	 * @return void
	 */
	private function load_admin_features() {
		Admin\PostType::get_instance();
		Admin\MetaBoxes::get_instance();
		Admin\Panel::get_instance();
		Admin\RestApiRoutes::get_instance();
		Admin\ShortCode::get_instance();
		Admin\Dashboard::get_instance();
	}
}

if ( ! function_exists( 'coca_bais_get_slider_type' ) ) :
	/**
	 * Get current slider type.
	 *
	 * @param array $attributes Data attributes.
	 *
	 * @return  string
	 */
	function coca_bais_get_slider_type( array $attributes ): string {
		return ! empty( $attributes['slider_type'] ) ? $attributes['slider_type'] : 'default';
	}
endif;

if ( ! function_exists( 'coca_bais_disabled_pro_feature_notice' ) ) :
	/**
	 * Set the notice for disabled pro feature for plugin.
	 *
	 * @return  string
	 */
	function coca_bais_disabled_pro_feature_notice(): string {
		// Notice for disabled pro-feature.
		$default_message    = esc_html__( 'The viewing of this premium feature is currently disabled. To gain access, you must activate the license of WP Before After Image Slider Pro Plugin.', 'wp-before-after-image-slider' );
		$pro_feature_notice = apply_filters( 'coca_bais_disabled_pro_feature_notice', $default_message );
		$warning            = sprintf(
			'<div class="components-notice is-warning"><div class="components-notice__content"><div class="coca-notice">%s</div></div></div>',
			$pro_feature_notice
		);

		return is_user_logged_in() && ! empty( $pro_feature_notice ) ? $warning : '';
	}
endif;

if ( ! function_exists( 'coca_bais_insert_array_element' ) ) :
	/**
	 * It takes an array, a specific key, and a new element, and inserts the new element after the
	 * specific key
	 *
	 * @param array  $arr The array where you want to insert the new element.
	 * @param string $specific_key The key of the array element you want to insert after.
	 * @param array  $new_element The new element to be inserted.
	 *
	 * @return array
	 */
	function coca_bais_insert_array_element( array $arr, string $specific_key, array $new_element ): array {
		if ( ! array_key_exists( $specific_key, $arr ) ) {
			return $arr;
		}

		$array_keys = array_keys( $arr );
		$start      = (int) array_search( $specific_key, $array_keys, true ) + 1; // Offset.

		$spliced_arr = array_splice( $arr, $start );

		foreach ( $new_element as $key => $value ) {
			$arr[ $key ] = $value;
		}

		return array_merge( $arr, $spliced_arr );
	}
endif;

if ( ! function_exists( 'coca_bais_global_assets' ) ) :
	/**
	 * Get all assets for global requirements.
	 *
	 * @return array[]
	 */
	function coca_bais_global_assets(): array {
		// Always use free plugin's base URL.
		$base_url = plugin_dir_url( dirname( COCA_BAIS_FILE ) . '/before-after-image-slider.php' );
		return array(
			'orientation'       => array(
				'hr' => $base_url . 'assets/lib/images/Horizontal.png',
				'vr' => $base_url . 'assets/lib/images/Vertical.png',
			),
			'templates'         => array(
				'st01' => $base_url . 'assets/lib/images/1.png',
				'st02' => $base_url . 'assets/lib/images/2.png',
				'st03' => $base_url . 'assets/lib/images/3.png',
				'st04' => $base_url . 'assets/lib/images/4.png',
				'st05' => $base_url . 'assets/lib/images/5.png',
				'st06' => $base_url . 'assets/lib/images/6.png',
				'st07' => $base_url . 'assets/lib/images/7.png',
				'st08' => $base_url . 'assets/lib/images/8.png',
			),
			'icons'             => array(
				'premium' => $base_url . 'assets/lib/images/premium-icon.svg',
			),
			'dashboard'         => array(
				'video'            => $base_url . 'assets/lib/images/video-banner.png',
				'feature_image'    => $base_url . 'assets/lib/images/feature-image.png',
				'dashboard_banner' => $base_url . 'assets/lib/images/dashboard-banner.png',
			),
			'placeholder_image' => array(
				'placeholder_image' => $base_url . 'assets/lib/images/placeholder.svg',
			),
			'placeholder_video' => array(
				'placeholder_video' => $base_url . 'assets/lib/images/video-placeholder.svg',
			),
		);
	}
endif;

// Admin css.
add_action( 'admin_head', __NAMESPACE__ . '\coca_bais_inline_css_all_admin' );
/**
 * Add inline CSS styles for admin area.
 *
 * @return void
 */
function coca_bais_inline_css_all_admin() {
	?>
	<style>
		.notice-warning .coca-bais-major-update-warning__separator {
			border: 1px solid #ffb900;
		}
		.coca-bais-major-update-warning__separator {
			margin: 15px -12px;
		}
		.coca-bais-major-update-warning {
			display: flex;
			margin-block-end: 5px;
			max-width: 1000px;
		}
		.notice-warning .coca-bais-major-update-warning__icon {
			color: #f56e28;
		}
		.coca-bais-major-update-warning__icon {
			font-size: 17px;
			margin-inline-end: 9px;
			margin-inline-start: 2px;
		}
		.coca-bais-major-update-warning__title {
			font-weight: 600;
			margin-block-end: 10px;
		}
		.coca-bais-major-update-warning+p {
			display: none !important;
		};
	</style>
	<?php
}

// Add custom update message for the plugin.
add_filter( 'in_plugin_update_message-wp-before-after-image-slider-pro/wp-before-after-image-slider-pro.php', __NAMESPACE__ . '\wpbais_append_custom_update_message', 1000, 2 );
/**
 * Append custom update message for the plugin.
 *
 * @param array  $plugin_data An array of plugin metadata.
 * @param object $response An object of metadata about the available plugin update.
 * @return void
 */
function wpbais_append_custom_update_message( $plugin_data, $response ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
	?>
	<hr class="coca-bais-major-update-warning__separator" />
	<div class="coca-bais-major-update-warning">
		<div class="coca-bais-major-update-warning__icon">
			<i class="eicon-info-circle"></i>
		</div>
		<div>
			<div class="coca-bais-major-update-warning__title">
				<?php echo esc_html__( 'Compatibility Alert!', 'wp-before-after-image-slider-pro' ); ?>
			</div>
			<div class="coca-bais-major-update-warning__message">
				We have released a new UI update. You are using an older version of Before After Image Slider. Please update to the latest version to access new UI and ensure full compatibility.
			</div>
		</div>
	</div>
	<?php
}

// Add the admin_init action hook for redirect with high priority.
add_action( 'admin_init', __NAMESPACE__ . '\coca_bais_redirect_after_activation', 1 );

/**
 * Redirect to dashboard after plugin activation.
 */
function coca_bais_redirect_after_activation() {
	if ( get_option( 'coca_bais_do_activation_redirect', false ) ) {
		delete_option( 'coca_bais_do_activation_redirect' );
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Standard WP activation flow, just checking if parameter exists
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}
		wp_safe_redirect( admin_url( 'edit.php?post_type=coca_bais&page=bais-dashboard' ) );
		exit;
	}
}

// take off.
Plugin::get_instance();
