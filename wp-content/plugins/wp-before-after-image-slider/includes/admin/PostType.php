<?php // phpcs:ignore WordPress.Files.FileName Squiz.Commenting.FileComment.Missing

namespace COCA\WP_Before_After_Image_Slider\Admin;

use function COCA\WP_Before_After_Image_Slider\coca_bais_insert_array_element;

/**
 * Post-Type register class.
 *
 * This class registers all post-types as per requirements.
 */
class PostType {

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
	 * The taxonomy name.
	 *
	 * @var string $post_type
	 */
	protected static string $taxonomy_type = 'coca_bais_category';

	/**
	 * The constructor class for Post Type.
	 */
	public function __construct() {
		// register the post-types for slider.
		add_action( 'init', array( $this, 'register_custom_post_type' ), 0 );
		add_filter( "manage_{$this::$post_type}_posts_columns", array( $this, 'custom_columns' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'custom_columns_output' ), 10, 2 );
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
	 * Get the post-type name.
	 *
	 * @return string
	 */
	public static function get_post_type(): string {
		return self::$post_type;
	}

	/**
	 * Register Custom Post Type.
	 *
	 * @return void
	 */
	public function register_custom_post_type() {
		register_post_type( self::$post_type, $this->get_post_type_arguments() );
	}

	/**
	 * Arguments that use to register for post-type.
	 *
	 * @return array
	 */
	public function get_post_type_arguments(): array {
		$labels = array(
			'name'                  => _x( 'Before After Sliders', 'Post Type General Name', 'wp-before-after-image-slider' ),
			'singular_name'         => _x( 'Before After Slider', 'Post Type Singular Name', 'wp-before-after-image-slider' ),
			'menu_name'             => esc_html__( 'Before After Sliders', 'wp-before-after-image-slider' ),
			'name_admin_bar'        => esc_html__( 'Before After Slider', 'wp-before-after-image-slider' ),
			'archives'              => esc_html__( 'Slider Archives', 'wp-before-after-image-slider' ),
			'attributes'            => esc_html__( 'Slider Attributes', 'wp-before-after-image-slider' ),
			'parent_item_colon'     => esc_html__( 'Parent Slider:', 'wp-before-after-image-slider' ),
			'all_items'             => esc_html__( 'All Sliders', 'wp-before-after-image-slider' ),
			'add_new_item'          => esc_html__( 'Add New Slider', 'wp-before-after-image-slider' ),
			'add_new'               => esc_html__( 'Add New', 'wp-before-after-image-slider' ),
			'new_item'              => esc_html__( 'New Slider', 'wp-before-after-image-slider' ),
			'edit_item'             => esc_html__( 'Edit Slider', 'wp-before-after-image-slider' ),
			'update_item'           => esc_html__( 'Update Slider', 'wp-before-after-image-slider' ),
			'view_item'             => esc_html__( 'View Slider', 'wp-before-after-image-slider' ),
			'view_items'            => esc_html__( 'View Sliders', 'wp-before-after-image-slider' ),
			'search_items'          => esc_html__( 'Search Slider', 'wp-before-after-image-slider' ),
			'not_found'             => esc_html__( 'Not found', 'wp-before-after-image-slider' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'wp-before-after-image-slider' ),
			'featured_image'        => esc_html__( 'Featured Image', 'wp-before-after-image-slider' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'wp-before-after-image-slider' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'wp-before-after-image-slider' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'wp-before-after-image-slider' ),
			'insert_into_item'      => esc_html__( 'Insert into Before After Slider', 'wp-before-after-image-slider' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this Before After Slider', 'wp-before-after-image-slider' ),
			'items_list'            => esc_html__( 'Sliders list', 'wp-before-after-image-slider' ),
			'items_list_navigation' => esc_html__( 'Sliders list navigation', 'wp-before-after-image-slider' ),
			'filter_items_list'     => esc_html__( 'Filter Sliders list', 'wp-before-after-image-slider' ),
		);

		// Arguments used to register the post-type.
		return array(
			'label'               => esc_html__( 'Before After Slider', 'wp-before-after-image-slider' ),
			'description'         => esc_html__( 'A Before After Slider post type', 'wp-before-after-image-slider' ),
			'labels'              => $labels,
			'supports'            => apply_filters( 'coca_bais_post_type_supports', array( 'title', 'revisions' ) ),
			'hierarchical'        => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-image-flip-horizontal',
			'show_in_nav_menus'   => false,
			'delete_with_user'    => true,
			'has_archive'         => false,
			'rewrite'             => false,
			'exclude_from_search' => true,
			'can_export'          => true,
			'public'              => apply_filters( 'coca_bais_public_view_enable', false ),
			'publicly_queryable'  => apply_filters( 'coca_bais_publicly_queryable_enable', false ),
			'capability_type'     => 'post',
		);
	}

	/**
	 * Helper method to generate a muted YouTube embed iframe.
	 *
	 * @param string $youtube_id The YouTube video ID.
	 * @return string HTML for the YouTube iframe with mute parameter.
	 */
	private function get_youtube_embed( $youtube_id ) {
		return '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . esc_attr( $youtube_id ) . '?mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
	}

	/**
	 * Add custom columns with image, shortcode int wp list table.
	 *
	 * @param array $columns The existed columns list.
	 *
	 * @return array
	 */
	public function custom_columns( array $columns = array() ): array {
		// Insert some columns after the title column.
		return coca_bais_insert_array_element(
			$columns,
			'title',
			array(
				'shortcode'    => esc_html__( 'Shortcode', 'wp-before-after-image-slider' ),
				'before_image' => esc_html__( 'Before Image/Video', 'wp-before-after-image-slider' ),
				'after_image'  => esc_html__( 'After Image/Video', 'wp-before-after-image-slider' ),
			)
		);
	}

	/**
	 * Show the image (before, after or indicator) for the current post.
	 *
	 * @param string     $column_name Current column name.
	 * @param string|int $id The current post id.
	 *
	 * @return void
	 */
	public function custom_columns_output( string $column_name, $id ) {
		$post_type = get_post_type( $id );
		$raw_meta  = get_post_meta( $id, '_coca_bais_meta_data', true );

		$meta_data = ! empty( $raw_meta ) ? $raw_meta : array();

		// Shortcode column in posts.
		if ( self::$post_type === $post_type && 'shortcode' === $column_name ) {
			// the shortcode for current post.
			$current_shortcode = sprintf( '[coca_bais id="%s"]', esc_attr( $id ) );

			printf(
				'<input type="text" name="%2$s" class="%2$s" value=\'%1$s\' readonly style="width: 100%%;"/>',
				esc_attr( $current_shortcode ),
				'coca_bais_slider_shortcode'
			);
		}

		// Before Image/Video column in posts.
		if ( self::$post_type === $post_type && 'before_image' === $column_name ) {
			$slider_type = isset( $meta_data['slider_type'] ) ? $meta_data['slider_type'] : 'default';

			// Force video display for all sliders with video type.
			if ( 'video' === $slider_type ) {
				$video_source_type = isset( $meta_data['video_source_type'] ) ? $meta_data['video_source_type'] : '';
				if ( 'youtube' === $video_source_type && isset( $meta_data['video_before_youtube'] ) && ! empty( $meta_data['video_before_youtube'] ) ) {
					$youtube_url = $meta_data['video_before_youtube'];
					$youtube_id  = '';
					if ( preg_match( '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtube_url, $match ) ) {
						$youtube_id = $match[1];
					}

					if ( ! empty( $youtube_id ) ) {
						echo '<div class="video-preview youtube-preview">';
						echo '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . esc_attr( $youtube_id ) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
						echo '</div>';
					} else {
						echo '<div class="video-preview"><span class="dashicons dashicons-youtube"></span> ' .
							esc_html__( 'YouTube Video', 'wp-before-after-image-slider' ) . '</div>';
					}
				} elseif ( 'upload' === $video_source_type && isset( $meta_data['video_before_file'] ) && ! empty( $meta_data['video_before_file'] ) && isset( $meta_data['video_before_file']['url'] ) ) {
					$video_url = $meta_data['video_before_file']['url'];
					$thumbnail = '';
					if ( isset( $meta_data['video_before_file']['image'] ) && isset( $meta_data['video_before_file']['image']['src'] ) ) {
						$thumbnail = $meta_data['video_before_file']['image']['src'];
					}

					echo '<div class="video-preview uploaded-video-preview">';
					echo '<video width="100%" height="100%" controls>';
					echo '<source src="' . esc_url( $video_url ) . '" type="video/mp4">';
					echo 'Your browser does not support the video tag.';
					echo '</video>';
					echo '</div>';
				} else {
					echo '<div class="video-preview"><span class="dashicons dashicons-video-alt3"></span> ' .
						esc_html__( 'Video is Empty', 'wp-before-after-image-slider' ) . '</div>';
				}
			} elseif ( ! empty( $meta_data['before_image']['id'] ) ) {
				list( $attachment_src ) = wp_get_attachment_image_src( sanitize_text_field( $meta_data['before_image']['id'] ) );
				printf(
					'<img src="%1$s" class="attachment-full size-full" alt="before image" loading="lazy">',
					esc_url( $attachment_src )
				);
			} else {
				printf(
					'<span aria-hidden="true">—</span><span class="screen-reader-text">%s.</span>',
					esc_html__( 'No Media', 'wp-before-after-image-slider' )
				);
			}
		}

		// After Image/Video column in posts.
		if ( self::$post_type === $post_type && 'after_image' === $column_name ) {
			$slider_type = isset( $meta_data['slider_type'] ) ? $meta_data['slider_type'] : 'default';

			// Force video display for all sliders with video type.
			if ( 'video' === $slider_type ) {
				$video_source_type = isset( $meta_data['video_source_type'] ) ? $meta_data['video_source_type'] : '';
				if ( 'youtube' === $video_source_type && isset( $meta_data['video_after_youtube'] ) && ! empty( $meta_data['video_after_youtube'] ) ) {
					$youtube_url = $meta_data['video_after_youtube'];
					$youtube_id  = '';
					if ( preg_match( '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtube_url, $match ) ) {
						$youtube_id = $match[1];
					}

					if ( ! empty( $youtube_id ) ) {
						echo '<div class="video-preview youtube-preview">';
						echo '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . esc_attr( $youtube_id ) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
						echo '</div>';
					} else {
						echo '<div class="video-preview"><span class="dashicons dashicons-youtube"></span> ' .
							esc_html__( 'YouTube Video', 'wp-before-after-image-slider' ) . '</div>';
					}
				} elseif ( 'upload' === $video_source_type && isset( $meta_data['video_after_file'] ) && ! empty( $meta_data['video_after_file'] ) && isset( $meta_data['video_after_file']['url'] ) ) {
					$video_url = $meta_data['video_after_file']['url'];

					// Get video thumbnail if available.
					$thumbnail = '';
					if ( isset( $meta_data['video_after_file']['image'] ) && isset( $meta_data['video_after_file']['image']['src'] ) ) {
						$thumbnail = $meta_data['video_after_file']['image']['src'];
					}

					echo '<div class="video-preview uploaded-video-preview">';
					echo '<video width="100%" height="100%" controls>';
					echo '<source src="' . esc_url( $video_url ) . '" type="video/mp4">';
					echo 'Your browser does not support the video tag.';
					echo '</video>';
					echo '</div>';
				} else {
					echo '<div class="video-preview"><span class="dashicons dashicons-video-alt3"></span> ' .
						esc_html__( 'Video is Empty', 'wp-before-after-image-slider' ) . '</div>';
				}
			} elseif ( ! empty( $meta_data['after_image']['id'] ) ) {
				list( $attachment_src ) = wp_get_attachment_image_src( sanitize_text_field( $meta_data['after_image']['id'] ) );
				printf(
					'<img src="%1$s" class="attachment-full size-full" alt="after image" loading="lazy">',
					esc_url( $attachment_src )
				);
			} else {
				printf(
					'<span aria-hidden="true">—</span><span class="screen-reader-text">%s.</span>',
					esc_html__( 'No Media', 'wp-before-after-image-slider' )
				);
			}
		}
	}
}
