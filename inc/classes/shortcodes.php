<?php
/**
 * All Shortcodes Used Here
 * @package Open Directory
 * @version 1.00
 */

namespace OPENDIRECTORY\Inc\Classes;

/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) exit;

use OPENDIRECTORY\Inc\Traits\Singleton;
 class Shortcodes {
     use Singleton;

     public function __construct() {
        // $this->retrieve_directory_settings();
        $this->register_shortcodes();
        PostType::get_instance()->retrieve_directory_settings();
    }
    public function register_shortcodes() {
        add_shortcode("opendirectory", [$this, "opendirectory_shortcode"]);
    }
    public function retrieve_directory_settings() {
        // $this->opendirectory_options = get_option("opendirectory_options");
        // $this->opendirectory_enabled = (isset($this->opendirectory_options['enable']) && $this->opendirectory_options['enable'] === 'on') ? true : false;
        // $this->opendirectory_name = $this->opendirectory_options['name'] ?? '';
        // $this->opendirectory_insert_rules = $this->opendirectory_options['insert_rule'] ?? 'unknown';
        // $this->opendirectory_privacy = $this->opendirectory_options['privacy'] ?? 'everyone';
        // $this->opendirectory_slug = !empty($this->opendirectory_name) ? sanitize_title('odir_' . $this->opendirectory_name) : 'odir';
    }
    public function opendirectory_shortcode($attr) {
    	if($attr['type'] === 'list') {
    		ob_start();
    		include OPENDIRECTORY_PATH . "/templates/directory.php";
    		$output =  ob_get_clean();
    		return $output;
    	}

    	if($attr['type'] === 'insert') {
    		ob_start();
    		include OPENDIRECTORY_PATH . "/templates/insert-form.php";
    		$output =  ob_get_clean();
    		return $output;
    	}
    }
 }