<?php
/**
 * Custom Post Type Based on Directory Settings By User
 * @package Open Directory
 * @version 1.00
 */

namespace OPENDIRECTORY\Inc\Classes;
use OPENDIRECTORY\Inc\Traits\Singleton;
 class PostType {
     use Singleton;
     public $opendirectory_options = [];
     public $opendirectory_enabled = false;
     public $opendirectory_name = '';
     public $opendirectory_slug = '';
     public $opendirectory_insert_rules = 'unknown';
     public $opendirectory_privacy = 'everyone';

     public function __construct() {
        $this->retrieve_directory_settings();
        $this->setup_hook();
    }
    public function setup_hook() {
        if($this->opendirectory_enabled && !empty($this->opendirectory_name) && !empty($this->opendirectory_slug)) {
            $this->directory_posttype('a', "A");
        }
    }
    public function retrieve_directory_settings() {
        $this->opendirectory_options = get_option("opendirectory_options");
        $this->opendirectory_enabled = ($this->opendirectory_options['enable'] && $this->opendirectory_options['enable'] === 'on') ? true : false;
        $this->opendirectory_name = $this->opendirectory_options['name'] ?? '';
        $this->opendirectory_insert_rules = $this->opendirectory_options['insert_rule'] ?? 'unknown';
        $this->opendirectory_privacy = $this->opendirectory_options['privacy'] ?? 'everyone';
        $this->opendirectory_slug = !empty($this->opendirectory_name) ? sanitize_title($this->opendirectory_name) : '';
    }
    // public function 
    public function directory_posttype($slug = 'od', $name = 'Open Directory') {
        register_post_type('a',[ 
            'labels'      => array(
                'name'          => 'A',
            ),
                'public'      => true, //will be false later
                'has_archive' => false, 
            ]);
        }
 }