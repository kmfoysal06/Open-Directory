<?php
/**
 * Setup plugin features
 * @package Open Directory
 * @since 1.0
 */
namespace OPENDIRECTORY\Inc\Classes;
use OPENDIRECTORY\Inc\Traits\Singleton;
Class Setup {
	use Singleton;
	public function __construct() {
		$this->setup_hook();
	}
	public function setup_hook() {
		add_action("admin_menu", [$this, "add_menu"]);
		add_action("admin_menu", [$this, "add_submenu"]);

		add_action("admin_init", [$this, "save_settings"]);
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
	public function save_settings() {
		if (isset($_POST['opendirectory_submit'])) {
            if(!isset($_POST['opendirectory_nonce']) || empty($_POST['opendirectory_nonce'])){
                return;
            }
            $data_input_nonce = sanitize_text_field(wp_unslash($_POST['opendirectory_nonce']));
            if (!wp_verify_nonce($data_input_nonce, 'opendirectory__nonce')) {
                return;
            }
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            if (!current_user_can('manage_options')) {
                return;
            }

            if(!isset($_POST['opendirectory']) || empty($_POST['opendirectory'])){
                return;
            }

            $modified_data = $this->sanitize_array(wp_unslash($_POST['opendirectory']));

            // check for name is valid and it should between 2 to 20 words
            if (!preg_match("/^[a-zA-Z\s]{2,30}$/", $modified_data['name'])) {
                add_action('admin_notices', function () {
                    echo '<div class="notice notice-error is-dismissible"><p>'.esc_html("Name is not valid! It should be between 2 to 20 words").'</p></div>';
                });
                return;
            }

            if (update_option('opendirectory_options', $modified_data)) {
                // Display success message
                add_action('admin_notices', function () {
                    echo '<div class="notice notice-success is-dismissible"><p>'.esc_html('Data saved successfully!').'</p></div>';
                });
            }
        }
	}
	/**
     * Sanitize The Array
     * @param array $input_array
     */
    public function sanitize_array($input_array)
    {
        if (is_array($input_array)) {
            return array_map([$this, 'sanitize_array'], $input_array);
        } else {
            return is_scalar($input_array) ? sanitize_text_field($input_array) : $input_array;
        }
    }
}