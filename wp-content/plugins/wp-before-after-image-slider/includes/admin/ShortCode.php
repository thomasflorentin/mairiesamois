<?php // phpcs:ignore WordPress.Files.FileName

/**
 * Short code register class.
 */

namespace COCA\WP_Before_After_Image_Slider\Admin;

defined( 'ABSPATH' ) || exit;

use function COCA\WP_Before_After_Image_Slider\coca_bais_disabled_pro_feature_notice as disabled_pro_feature_notice;
use function COCA\WP_Before_After_Image_Slider\coca_bais_get_slider_type as get_slider_type;

/**
 * Short code register class.
 *
 * This class registers shortcode as per requirements.
 */
class ShortCode {
	/**
	 * The instance of the current class.
	 *
	 * @var ?self $instance
	 */
	private static ?self $instance = null;  // phpcs:ignore Squiz.Commenting.VariableComment.Missing

	/**
	 * The post-type name.
	 *
	 * @var string $post_type
	 */
	protected static string $post_type = 'coca_bais';

	/**
	 * The constructor class for Shortcode.
	 */
	public function __construct() {
		add_shortcode( self::$post_type, array( $this, 'coca_bais_render_shortcode' ) );
		add_filter( 'coca_bais_shortcode_rendered_html', array( $this, 'coca_bais_shortcode_rendered_html' ), 10, 2 );
	}

	/**
	 * Validate the raw content for the image comparison label.
	 *
	 * @param string $content The raw content for the label.
	 *
	 * @return string The rendered content.
	 */
	public static function validate_label( string $content ): string {
		if ( empty( $content ) ) {
			return $content;
		}

		// remove all tags from the label.
		$clean_html = wp_strip_all_tags( $content, true );

		// replace quotes.
		$clean_html = str_replace( '/"/g', '\\\"', $clean_html );
		$clean_html = str_replace( "/'/g", '\\\'', $clean_html );
		$clean_html = str_replace( '/\\\\/g', '\\', $clean_html );

		// return actual content for label.
		return $clean_html;
	}

	/**
	 * The callback function to run when the shortcode is found.
	 *
	 * @param array $attrs An array of attributes.
	 *
	 * @return string The rendered content.
	 */
	public function coca_bais_render_shortcode( array $attrs ): string {
		// Collect all attributes.
		$pairs      = array(
			'id'                 => '',
			'image_before_id'    => '',
			'image_after_id'     => '',
			'image_middle_id'    => '',
			'image_indicator_id' => '',
		);
		$attributes = shortcode_atts( $pairs, $attrs, self::$post_type );

		if ( ! empty( $attributes['id'] ) ) {
			// Collect custom post by id from ti's shortcode.
			$post = get_post( $attributes['id'] );

			// Verify the current post with its type, and status.
			if ( $post && self::$post_type === $post->post_type && 'publish' === $post->post_status ) {
				$raw_meta   = get_post_meta( $post->ID, '_coca_bais_meta_data', true );
				$meta_data  = isset( $raw_meta ) && is_array( $raw_meta ) ? $raw_meta : array();
				$attributes = array_merge( $attributes, $meta_data );

				// Enqueue script and style as per requirements.
				do_action( 'coca_bais_shortcode_enqueue_scripts', $attributes );

				// Collect slider type.
				$slider_type = get_slider_type( $attributes );

				// Pre-render output for shortcode depends on attributes.
				$warning_html = '';
				if ( 'default' !== $slider_type && current_user_can( 'manage_options' ) ) {
					$warning_html = sprintf(
						'<div class="coca-bais-shortcode shortcode-%1s">%2$s</div>',
						esc_attr( $attributes['id'] ),
						disabled_pro_feature_notice()
					);
				}

				// Show rendered html.
				return apply_filters( 'coca_bais_shortcode_rendered_html', $warning_html, $attributes );
			}
		}

		return '';
	}

	/**
	 * The callback function to run when the shortcode is found.
	 *
	 * @param string $content The shortcode content.
	 * @param array  $attributes An array of attributes.
	 *
	 * @return string The rendered content.
	 */
	public function coca_bais_shortcode_rendered_html( string $content, array $attributes ): string {
		// Verify slider type.
		if ( 'default' === get_slider_type( $attributes ) ) {
			if ( ( ! empty( $attributes['image_before_id'] ) && ! empty( $attributes['image_after_id'] ) ) ||
				( ! empty( $attributes['before_image']['id'] ) && ! empty( $attributes['after_image']['id'] ) ) ) {
				$defaults         = array(
					'orientation'           => $attributes['orientation'],
					'move_slider_on_hover'  => 'hover' === $attributes['trigger_type'],
					'move_with_handle_only' => 'drag' === $attributes['trigger_type'],
					'click_to_move'         => 'drag' === $attributes['trigger_type'],
					'no_overlay'            => ( isset( $attributes['show_overlay'] ) && ! $attributes['show_overlay'] ),
					'show_labels'           => ( isset( $attributes['show_labels'] ) && $attributes['show_labels'] ),
					'before_label'          => self::validate_label( $attributes['before_image_label'] ),
					'after_label'           => self::validate_label( $attributes['after_image_label'] ),
				);
				$image_size       = $attributes['image_size'];
				$shortcode_id     = sprintf( 'shortcode-%1$s', esc_html( $attributes['id'] ) );
				$default_classes  = array( 'coca-bais-shortcode', $shortcode_id );
				$image_attributes = array( 'class' => "attachment-$image_size size-$image_size coca-bais-image" );

				// Load the unlocked features by Pro Plugin.
				$wrapper_classes  = apply_filters( 'coca_bais_shortcode_wrapper_classes', $default_classes, $attributes );
				$css_output       = apply_filters( 'coca_bais_shortcode_styles', '', $attributes );
				$popup_output     = apply_filters( 'coca_bais_shortcode_popup', '', $attributes );
				$compare_settings = apply_filters( 'coca_bais_shortcode_compare_settings', $defaults, $attributes );
				$attributes       = apply_filters( 'coca_bais_shortcode_attributes', array_merge( $attributes, $compare_settings ) );

				// Collect all images for slider.
				$image_before_id   = ! empty( $attributes['image_before_id'] ) ? $attributes['image_before_id'] : $attributes['before_image']['id'];
				$image_after_id    = ! empty( $attributes['image_after_id'] ) ? $attributes['image_after_id'] : $attributes['after_image']['id'];
				$before_image_html = wp_get_attachment_image( $image_before_id, $image_size, false, $image_attributes );
				$after_image_html  = wp_get_attachment_image( $image_after_id, $image_size, false, $image_attributes );

				$content = sprintf(
					'<div class="%4$s"><div class="shortcode-container"><div class="coca-bais-container" id="%7$s" data-settings="%1$s" style="opacity: 0; max-width: 100%%;">%2$s%3$s%5$s</div>%6$s</div></div>',
					esc_attr( wp_json_encode( $compare_settings ) ),
					wp_kses_post( $before_image_html ),
					wp_kses_post( $after_image_html ),
					esc_attr( implode( ' ', $wrapper_classes ) ),
					$popup_output,
					$css_output,
					esc_attr( $shortcode_id )
				);
			} else {
				$err_message  = sprintf(
					'<div class="coca-bais-shortcode shortcode-%1s"><div class="components-notice is-warning"><div class="components-notice__content">',
					esc_attr( $attributes['id'] )
				);
				$err_message .= sprintf(
					'<div class="coca-notice">%s</div>',
					esc_html__( 'You need to add both before and after image.', 'wp-before-after-image-slider' )
				);
				$err_message .= '</div></div></div>';

				// Update the content for return.
				$content = $err_message;
			}
		}

		return $content;
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
