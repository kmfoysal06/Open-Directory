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
if (!defined("ABSPATH")) {
    exit;
}

use OPENDIRECTORY\Inc\Traits\Singleton;

class Shortcodes
{
    use Singleton;

    public function __construct()
    {
        // $this->retrieve_directory_settings();
        $this->register_shortcodes();
        PostType::get_instance()->retrieve_directory_settings();
    }
    public function register_shortcodes()
    {
        add_shortcode("opendirectory", [$this, "opendirectory_shortcode"]);
    }
    public function opendirectory_shortcode($attr)
    {
        if ($attr['type'] === 'list') {
            ob_start();
            include OPENDIRECTORY_PATH . "/templates/directory.php";
            $output =  ob_get_clean();
            return $output;
        }

        if ($attr['type'] === 'insert') {
            ob_start();
            include OPENDIRECTORY_PATH . "/templates/insert-form.php";
            $output =  ob_get_clean();
            return $output;
        }
    }
}
