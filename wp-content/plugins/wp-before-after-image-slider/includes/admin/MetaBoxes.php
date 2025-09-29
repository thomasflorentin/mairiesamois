<?php // phpcs:ignore WordPress.Files.FileName Squiz.Commenting.FileComment.Missing

namespace COCA\WP_Before_After_Image_Slider\Admin;

/**
 * Meta Box register class.
 *
 * This class registers all meta boxes as per requirements.
 */
class MetaBoxes {

	/**
	 * The instance of the current class.
	 *
	 * @var ?self
	 */
	private static ?self $instance = null;  // phpcs:ignore Squiz.Commenting.VariableComment.Missing

	/**
	 * The constructor for Meta Box Class
	 */
	public function __construct() {
		// Register Meta box.
		add_action( 'add_meta_boxes', array( $this, 'register_all_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'set_html_copy_success' ) );
	}

	/**
	 * Get the instance of the plugin.
	 *
	 * @return ?self
	 */
	public static function get_instance(): ?self {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Register all meta boxes as per requirements.
	 *
	 * @return void
	 */
	public function register_all_meta_boxes() {
		// the shortcode meta-box.
		add_meta_box(
			'coca_bais_show_shortcode_metabox',
			esc_html__( 'Shortcode', 'wp-before-after-image-slider' ),
			array( $this, 'meta_box_edit_page_coca_show_shortcode' ),
			PostType::get_post_type(),
			'side',
			'high'
		);
	}

	/**
	 * Show the shortcode for the current post.
	 *
	 * @return void
	 */
	public function meta_box_edit_page_coca_show_shortcode() {
		global $post;

		// the shortcode for current post.
		if ( ! empty( $post->ID ) ) {
			$current_shortcode = sprintf( '[coca_bais id="%s"]', esc_attr( $post->ID ) );

			printf(
				'<input type="text" name="%2$s" class="%2$s" value=\'%1$s\' readonly style="width: 100%%;"/>',
				esc_attr( $current_shortcode ),
				'coca_bais_slider_shortcode'
			);
		}
	}

	/**
	 * Set Success text for copy shortcode feature.
	 *
	 * @return void
	 */
	public function set_html_copy_success() {
		printf(
			'<div id="coca_bais_copy_html" style="display: none;">%s</div>',
			esc_html__( 'Shortcode Copied!', 'wp-before-after-image-slider' )
		);
	}
}
