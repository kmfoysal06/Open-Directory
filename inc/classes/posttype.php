<?php
/**
 * Custom Post Type Based on Directory Settings By User
 * @package Open Directory
 * @version 1.00
 */

namespace OPENDIRECTORY\Inc\Classes;

/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) exit;

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
            add_action("init", [$this, "directory_posttype"]);
        }
        add_action("init", [$this, "add_listing_page"]);
        add_action("init", [$this, "add_insert_page"]);
    }
    public function retrieve_directory_settings() {
        $this->opendirectory_options = get_option("opendirectory_options");
        $this->opendirectory_enabled = (isset($this->opendirectory_options['enable']) && $this->opendirectory_options['enable'] === 'on') ? true : false;
        $this->opendirectory_name = $this->opendirectory_options['name'] ?? '';
        $this->opendirectory_insert_rules = $this->opendirectory_options['insert_rule'] ?? 'unknown';
        $this->opendirectory_privacy = $this->opendirectory_options['privacy'] ?? 'everyone';
        $this->opendirectory_slug = !empty($this->opendirectory_name) ? sanitize_title('odir_' . $this->opendirectory_name) : 'odir';
    }
    // public function 
    public function directory_posttype() {
        register_post_type($this->opendirectory_slug,[ 
            'labels'      => array(
                'name'          => $this->opendirectory_name,
            ),
                'public'      => false,
                'has_archive' => false, 
            ]);
        }
    public function add_listing_page() {
        $list_page_name = $this->opendirectory_name . " List";
        $list_page_slug = $this->opendirectory_slug . "_list" ;
        $this->new_page($list_page_name, $list_page_slug  , '[opendirectory type="list"]');
    }
    public function add_insert_page() {
        $insert_page_name = $this->opendirectory_name . " insert";
        $insert_page_slug = $this->opendirectory_slug . "_insert" ;
        $this->new_page($insert_page_name, $insert_page_slug  , '[opendirectory type="insert"]');
    }
    public function new_page($pageName, $slug, $content) {
        if(get_page_by_path("/" . $slug) === null) {
            $createPage = array(
              'post_title'    => sanitize_text_field($pageName),
              'post_content'  => sanitize_text_field($content),
              'post_status'   => 'publish',
              'post_author'   => 1,
              'post_type'     => 'page',
              'post_name'     => $slug
            );
            wp_insert_post( $createPage );
             flush_rewrite_rules();
        }else {
            $existingPage = get_page_by_path("/" . $slug);
            $post_content = apply_filters('the_content', $existingPage->post_content); 

            if($post_content !== $content) {
                $post_id = $existingPage->ID;
                wp_update_post([
                    'ID' => $post_id,
                    'post_content' => sanitize_text_field($content)
                ]);
            }
        }
    }
 }