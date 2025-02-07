<?php
/**
 * Plugin Name: Open Directory
 * Author: Kazi Mohammad Foysal
 * Version: 1.0
 * Description: Open Directory is a WordPress Plugin That Provide Users a Route to Host A Directory Listing of Anything.
 */
/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) exit;

/**
 * Constants
 */
define("OPENDIRECTORY_PATH", untrailingslashit(plugin_dir_path(__FILE__)));
define("OPENDIRECTORY_URL", untrailingslashit(plugin_dir_url(__FILE__)));

/**
 * Include Autoloader
 */
require_once OPENDIRECTORY_PATH . "/inc/helper/autoload.php";
/**
 * Include template tags
 */
require_once OPENDIRECTORY_PATH . "/inc/helper/template-tags.php";

function opendirectory_get_instance() {
	return \OPENDIRECTORY\Inc\Classes\Opendir::get_instance();
}

opendirectory_get_instance();