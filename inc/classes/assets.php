<?php
/**
 * Assets Loader Class
 * @package Open Directory
 * @since 1.0
 */
namespace OPENDIRECTORY\Inc\Classes;
use OPENDIRECTORY\Inc\Traits\Singleton;
Class Assets {
	use Singleton;
	public function __construct() {
		$this->setup_hooks();
	}
	public function setup_hooks() {
		add_action("admin_enqueue_scripts", [$this, 'admin_style']);
		add_action("wp_enqueue_scripts", [$this, 'public_styles']);
	}
	public function public_styles() {
		/**
		 * Styles for Directory List and Insert Page
		 */
		global $post;
		wp_register_style("opendirectory_listing_page", OPENDIRECTORY_URL . "/assets/build/css/listing.css", [], filemtime(OPENDIRECTORY_PATH . "/assets/build/css/listing.css"), 'all' );
		if(is_page()) {
			if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'opendirectory') ) {
					wp_enqueue_style( 'opendirectory_listing_page');
				}
		}
	}
	public function admin_style() {
		if($this->is_my_pages()) {
			wp_enqueue_style("opendirectory_admin_css", OPENDIRECTORY_URL . "/assets/build/css/admin.css", [], filemtime(OPENDIRECTORY_PATH . "/assets/build/css/admin.css"));
		}
	}
	public function is_my_pages() {
		global $pagenow;
		$option_pages = ['OPENDIRECTORY_menu', 'OPENDIRECTORY_page'];
		return $pagenow && isset($_GET['page']) && in_array($_GET['page'], $option_pages);
	}
}