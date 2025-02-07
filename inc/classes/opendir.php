<?php
/**
 * Main Class File For The Whole Plugin
 * @package Open Directory
 * @since 1.0
 */
namespace OPENDIRECTORY\Inc\Classes;
use OPENDIRECTORY\Inc\Traits\Singleton;
Class Opendir {
	use Singleton;
	public function __construct() {
		Assets::get_instance();
		Setup::get_instance();

		$this->setup_hooks();
	}

	public function setup_hooks() {
		add_action("admin_menu", [$this, "add_menu"]);
		add_action("admin_menu", [$this, "add_submenu"]);
	}

	public function add_menu() {
        add_menu_page(
            'Open Directory',
            "Open Directory",
            "manage_options",
            "OPENDIRECTORY_page",
            [$this, "information_html"],
            "dashicons-portfolio"
        );
    }
    public function add_submenu() {
        add_submenu_page(
            "OPENDIRECTORY_page",
            "Customize Directory",
            "Customize Directory",
            "manage_options",
            "OPENDIRECTORY_menu",
            [$this, "settings_html"]
        );
    }

    public function information_html() {
        require_once OPENDIRECTORY_PATH . "/templates/info.php";
    }

    public function settings_html() {
    	require_once OPENDIRECTORY_PATH . "/templates/settings.php";
    }

}