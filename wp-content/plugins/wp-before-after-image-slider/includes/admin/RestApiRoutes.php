<?php // phpcs:ignore WordPress.Files.FileName

/**
 * REST API Route register class.
 */

namespace COCA\WP_Before_After_Image_Slider\Admin;

use WP_Error;
use WP_HTTP_Response;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

/**
 * The Rest api route register class.
 *
 * @var ?self $instance
 */
class RestApiRoutes {

	/**
	 * The instance of the current class.
	 *
	 * @var ?self $instance
	 */
	private static ?self $instance = null;  // phpcs:ignore Squiz.Commenting.VariableComment.Missing

	/**
	 * The constructor class.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * The route register.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			'coca-bais/v1',
			'/save-post-meta',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'save_post_meta' ),
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Save the data into post-meta.
	 *
	 * @param WP_REST_Request $request The client request object.
	 *
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function save_post_meta( WP_REST_Request $request ) {
		$params  = $request->get_params();
		$post_id = isset( $params['post_id'] ) ? esc_html( $params['post_id'] ) : get_the_ID();

		if ( ! get_post_meta( $post_id, '_coca_bais_meta_data' ) ) {
			if ( add_post_meta( $post_id, '_coca_bais_meta_data', $params ) ) {
				return rest_ensure_response(
					array(
						'code'    => 'SUCCESS',
						'message' => esc_html__( 'The post meta added.', 'wp-before-after-image-slider' ),
					)
				);
			}
		} elseif ( update_post_meta( $post_id, '_coca_bais_meta_data', $params ) ) {
			return rest_ensure_response(
				array(
					'code'    => 'SUCCESS',
					'message' => esc_html__( 'The post meta updated.', 'wp-before-after-image-slider' ),
				)
			);
		}

		return rest_ensure_response(
			array(
				'code'    => 'NOTICE',
				'message' => esc_html__( 'Already updated!', 'wp-before-after-image-slider' ),
			)
		);
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
