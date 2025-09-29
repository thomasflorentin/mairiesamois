<?php // phpcs:ignore WordPress.Files.FileName Squiz.Commenting.FileComment.Missing

namespace COCA\WP_Before_After_Image_Slider\Admin;

use WP_Post;

/**
 * Panel register class.
 *
 * This class register edit post panel as per requirements.
 */
class Panel {
	/**
	 * The instance of the current class.
	 *
	 * @var ?self $instance
	 */
	private static ?self $instance = null;  // phpcs:ignore Squiz.Commenting.VariableComment.Missing

	/**
	 * The constructor class for Panel.
	 */
	public function __construct() {
		add_action( 'edit_form_after_title', array( $this, 'set_html_edit_panel_root' ) );
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
	 * Set root html for edit panel.
	 *
	 * @param WP_Post $post An instance of WP_Post class.
	 *
	 * @return void
	 */
	public function set_html_edit_panel_root( WP_Post $post ) {
		if ( 'coca_bais' !== get_post_type( $post ) ) {
			return;
		}

		printf(
			'<div id="%s__edit_panel_root"></div> <!-- end edit panel --><!-- Al Amin Ahamed (alaminahamed.com) -->',
			esc_attr( PostType::get_post_type() )
		);
	}
}
