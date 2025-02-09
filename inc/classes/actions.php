<?php
/**
 * All Action Will Be Regestered Here
 * @package Open Directory
 * @version 1.00
 */

namespace OPENDIRECTORY\Inc\Classes;
use OPENDIRECTORY\Inc\Traits\Singleton;
 class Actions {
     use Singleton;

    public function __construct() {
    	$this->setup_hook();
    }
    public function setup_hook() {
        add_action("wp_ajax_opendirectory_add_item", [$this, "insert_item"]);
        add_action("wp_ajax_nopriv_opendirectory_add_item", [$this, "insert_item"]);
    }
    public function insert_item() {
    	check_ajax_referer("odir_add_item", "nonce");
    	
    	/**
    	 * Process to Create Post
    	 */
    	$username  = $_POST['username'];
    	$postdata  = $_POST['post'] ?? '';
    	$logged_in = $_POST['logged_in'] ?? false;
    	$is_admin  = $_POST['is_admin'] ?? false;

    	if(PostType::get_instance()->opendirectory_insert_rules !== 'unknown') {
    		if(empty($username)) {
    			wp_send_json_error();	
    		}
    	}

    	if(PostType::get_instance()->opendirectory_insert_rules === 'nobody') {
    		wp_send_json_error();
    	}

    	if(PostType::get_instance()->opendirectory_insert_rules === 'admin' && !$is_admin) {
    		wp_send_json_error();
    	}

    	if(PostType::get_instance()->opendirectory_insert_rules === 'user' && !$is_user) {
    		wp_send_json_error();
    	}

        $post_id = wp_insert_post( [
          'post_title'    => sanitize_text_field($postdata),
	      'post_status'   => 'publish',
	      'post_author'   => 1,
	      'post_type'     => PostType::get_instance()->opendirectory_slug,
        ] );

        if(is_wp_error($post_id)) {
        	wp_send_json_error();
        }else{
        	update_post_meta($post_id, "odir_usrename", ($username ?? "unknown"));
        	wp_send_json_success();
        }

        die;
    }
 }