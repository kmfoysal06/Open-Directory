<?php
/**
 *  Basic Frontend Template for Opendirectory Listing and Insert Page
 * @package Open Directory
 * @since 1.0
 *  */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
<div class="opendir-page-container">
    <div class="post-content"><?php echo apply_filters('the_content', wp_kses_post(get_the_content())); ?></div>
</div>
<?php
    endwhile;
else:
    ?>
<p>No posts found</p>
<?php
endif;
get_footer();
?>