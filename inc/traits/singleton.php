<?php
/**
 * Trait Singleton Template
 * @package Open Directory
 * @since 1.0
 */

namespace OPENDIRECTORY\Inc\Traits;

trait Singleton{
    public function __construct(){}
    public function __clone(){}
    final public static function get_instance(){
        static $instance = [];
        $called_class = get_called_class();
        if(!isset($instance[$called_class])){
            $instance[$called_class] = new $called_class;
            do_action(sprintf("opendirectory_theme_singleton_init%s",$called_class));
        }
        return $instance[$called_class];
    }
}