<?php

/**
 * @package Open Directory
 * @since 1.0
 * Plugin Name: Open Directory
 * Description: Open Directory is a WordPress Plugin That Provide Users a Route to Host A Directory Listing of Anything.
 * Author: Kazi Mohammad Foysal
 * Author URI: https://profiles.wordpress.org/kmfoysal06
 * Tags: opendirectory, directory listing
 * Requires at least: 5.0
 * Version: 1.2.1
 * Stable tag: 1.2.1
 * Tested up to: 6.7
 * Requires PHP: 7.0
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */


/**
 * Exit if accessed directly
 */
if (!defined("ABSPATH")) {
    exit;
}

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

function opendirectory_get_instance()
{
    return \OPENDIRECTORY\Inc\Classes\Opendir::get_instance();
}

opendirectory_get_instance();
