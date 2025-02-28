<?php

/**
 * Main Class File For The Whole Plugin
 * @package Open Directory
 * @since 1.0
 */

namespace OPENDIRECTORY\Inc\Classes;

/**
 * Exit if accessed directly
 */
if (!defined("ABSPATH")) {
    exit;
}

use OPENDIRECTORY\Inc\Traits\Singleton;

class Opendir
{
    use Singleton;
    public function __construct()
    {
        Assets::get_instance();
        Setup::get_instance();
        PostType::get_instance();
        Shortcodes::get_instance();
        Actions::get_instance();

        $this->setup_hooks();
    }

    public function setup_hooks()
    {

    }

}
