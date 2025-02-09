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

		wp_register_style("opendirectory_listing_page", OPENDIRECTORY_URL . "/assets/build/css/listing.css", [], filemtime(OPENDIRECTORY_PATH . "/assets/build/css/listing.css"), 'all' );
		wp_register_script("opendirectory_insert_item", OPENDIRECTORY_URL . "/assets/build/js/insert.js", [], filemtime(OPENDIRECTORY_PATH . "/assets/build/js/insert.js"), true );

		wp_localize_script("opendirectory_insert_item", "odir_ajax", [
			'nonce'     => wp_create_nonce("odir_add_item"),
			'url'       => admin_url("admin-ajax.php"),
			'logged_in' => is_user_logged_in(),
			'is_admin'  => current_user_can('administrator'),
			'username'  => wp_get_current_user()->user_login
		]);

		global $post;
		if(is_page()) {
			if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'opendirectory') ) {
					wp_enqueue_style( 'opendirectory_listing_page');

					if(strpos($post->post_content, 'insert')) {
						wp_enqueue_script("opendirectory_insert_item");
					}
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