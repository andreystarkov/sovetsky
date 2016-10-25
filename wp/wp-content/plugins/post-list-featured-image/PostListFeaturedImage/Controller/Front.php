<?php
namespace PostListFeaturedImage\Controller;

use PostListFeaturedImage\Lib\Debugger;
use PostListFeaturedImage\Lib\Helper;

if ( !defined( 'ABSPATH' ) || preg_match(
		'#' . basename( __FILE__ ) . '#',
		$_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}

class Front {

	protected static $instance;

	public static function instance() {
		null === self::$instance && self::$instance = new self;

		return self::$instance;
	}

	public function __construct() {

	}

	public function init() {
		$this->shortcodes();
		//$this->action_hooks();
		//$this->filter_hooks();
	}

	protected function action_hooks() {

	}

	protected function filter_hooks() {

	}

	protected function shortcodes() {
		add_shortcode( 'featured_img', array( $this, 'sc_featured_image' ) );
	}

	//<editor-fold desc="ACTION HOOK HANDLERS">
	/**********************************************
	 *              Action Hooks
	 **********************************************/
	//</editor-fold>

	//<editor-fold desc="FILTER HOOK HANDLERS">
	/**********************************************
	 *              Filter Hooks
	 **********************************************/
	//</editor-fold>

	//<editor-fold desc="SHORTCODE HANDLERS">
	/**
	 * [featured_img] shortcode handler
	 *
	 * @todo Finalize
	 *
	 * @param array  $atts
	 * @param string $content
	 * @param string $tag
	 *
	 * @return string The img html tag.
	 */
	public function sc_featured_image( $atts = array(), $content = '', $tag = '' ) {
		/**
		 * @var \WP_Post $post
		 */
		global $post;

		/**
		 * @var int          $post_id
		 * @var string|array $size
		 * @var string       $alt
		 * @var string|array $attr
		 */
		$args = array(
			'post_id'        => 0,
			'size'           => 'thumbnail',
			'alt'            => '',
			'attr'           => ''
		);

		$args = shortcode_atts( $args, $atts );

		extract( $args );

		$post_id = absint( $post_id );
		if ( !$post_id ) {
			$post_id = $post->ID;
		}
		$attachment_id = get_post_thumbnail_id( $post_id );

		if ( empty( $alt ) ) {
			$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
		}

		$image = wp_get_attachment_image_src( $attachment_id, $size );

		$html = '';
		if ( $image ) {
			$_attr = '';
			if ( !empty( $attr ) ) {
				$attr = htmlspecialchars_decode( $attr );
				$attr = wp_parse_args( $attr );
				foreach ( $attr as $attr_name => $attr_value ) {
					if ( in_array( $attr_name, array( 'src', 'alt' ) ) ) {
						continue;
					}

					$_attr .= sprintf( ' %s="%s"', $attr_name, esc_attr( $attr_value ) );
				}
			}
			$html = sprintf(
				'<img src="%s" alt="%s" width="%d" height="%d"%s>',
				$image[0],
				$alt,
				$image[1],
				$image[2],
				$_attr
			);
		}

		return apply_filters( 'plfi_sc_featured_image_html', $html, $args );
	}
	//</editor-fold>
}
