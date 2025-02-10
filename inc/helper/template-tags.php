<?php
/**
 * Template Tag Template
 * @package Open Directory
 * @since 1.00
 */

/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) exit;

/**
 * Compare Select Input to check the selected input before
 */
function opendirectory_compare_select($saved, $current) {
    if($saved === $current) {
        return 'selected';
    }
}