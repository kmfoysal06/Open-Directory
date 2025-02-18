<?php
/**
 *  Basic Frontend Template for Opendirectory Listing and Insert Page
 * @package Open Directory
 * @since 1.0
 *  */

/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) {
    exit;
}


get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        ob_start();
        the_content();
        $post_content = ob_get_clean();

        ?>
<div class="opendir-page-container">

    <div class="post-content"><?php echo wp_kses($post_content, [
            'div' => [
                'class' => []
            ],
            'h2' => [
                'class' => []
            ],
            'h1' => [],
            'label' => [
                'for' => []
            ],
            'input' => [
                'name' => [],
                'class' => [],
                'id' => [],
                'required' => [],
                'placeholder' => [],
                'type' => [],
                'autocomplete' => []
            ],
            'textarea' => [
                'name' => [],
                'class' => [],
                'id' => [],
                'required' => [],
                'placeholder' => [],
                'rows' => []
            ],
            'button' => [
                'type' => [],
                'class' => [],
            ],
            'form' => [
                'method' => []
            ],
            "a" => [
                "href" => []
            ]
        ]); ?></div>
</div>
<span class="opendirectory_alert"></span>
<?php
    endwhile;
else:
    ?>
<p>No posts found</p>
<?php
endif;
get_footer();
?>
